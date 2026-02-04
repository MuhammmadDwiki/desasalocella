<?php

namespace Tests\Feature\RekapitulasiRT;

use App\Models\RekapitulasiRT;
use App\Models\RT;
use App\Models\User;
use App\Notifications\LaporanStatusChanged;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class WorkflowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function moderator_can_submit_draft_to_pending()
    {
        // Arrange
        Notification::fake();
        $rt = RT::factory()->create();
        $moderator = User::factory()->moderator($rt->id_rt)->create();
        $rekapRT = RekapitulasiRT::factory()->draft()->create([
            'submitted_by' => $moderator->id,
            'id_rt' => $rt->id_rt,
        ]);

        // Act
        $response = $this->actingAs($moderator)
            ->post(route('rekapitulasi-rt.submit', $rekapRT->id_rekap_rt));

        // Assert
        $response->assertRedirect();
        $response->assertSessionHas('success');

        $rekapRT->refresh();
        $this->assertEquals('pending', $rekapRT->status);
        $this->assertNotNull($rekapRT->submitted_at);

        // Verify notification sent to super admin
        $superAdmin = User::where('role', 'super_admin')->first();
        if ($superAdmin) {
            Notification::assertSentTo($superAdmin, LaporanStatusChanged::class);
        }
    }

    /** @test */
    public function super_admin_can_approve_pending_rekap()
    {
        // Arrange
        Notification::fake();
        $admin = User::factory()->superAdmin()->create();
        $moderator = User::factory()->moderator()->create();
        $rekapRT = RekapitulasiRT::factory()->pending()->create([
            'submitted_by' => $moderator->id,
        ]);

        // Act
        $response = $this->actingAs($admin)
            ->post(route('rekapitulasi-rt.validate', $rekapRT->id_rekap_rt));

        // Assert
        $response->assertRedirect();
        $response->assertSessionHas('success');

        $rekapRT->refresh();
        $this->assertEquals('approved', $rekapRT->status);
        $this->assertNotNull($rekapRT->validated_at);

        // Verify notification sent to submitter
        Notification::assertSentTo($moderator, LaporanStatusChanged::class);
    }

    /** @test */
    public function super_admin_can_reject_pending_rekap()
    {
        // Arrange
        Notification::fake();
        $admin = User::factory()->superAdmin()->create();
        $moderator = User::factory()->moderator()->create();
        $rekapRT = RekapitulasiRT::factory()->pending()->create([
            'submitted_by' => $moderator->id,
        ]);

        $rejectionMessage = 'Data tidak lengkap, mohon perbaiki';

        // Act
        $response = $this->actingAs($admin)
            ->post(route('rekapitulasi-rt.reject', $rekapRT->id_rekap_rt), [
                'message' => $rejectionMessage,
            ]);

        // Assert
        $response->assertRedirect();

        $rekapRT->refresh();
        $this->assertEquals('rejected', $rekapRT->status);
        $this->assertEquals($rejectionMessage, $rekapRT->catatan_validasi);
        $this->assertNotNull($rekapRT->validated_at);

        // Verify notification sent to submitter
        Notification::assertSentTo($moderator, LaporanStatusChanged::class);
    }

    /** @test */
    public function cannot_submit_already_pending_rekap()
    {
        // Arrange
        $moderator = User::factory()->moderator()->create();
        $rekapRT = RekapitulasiRT::factory()->pending()->create([
            'submitted_by' => $moderator->id,
        ]);

        $originalSubmittedAt = $rekapRT->submitted_at;

        // Act
        $response = $this->actingAs($moderator)
            ->post(route('rekapitulasi-rt.submit', $rekapRT->id_rekap_rt));

        // Assert - should succeed but not change anything
        $rekapRT->refresh();
        $this->assertEquals('pending', $rekapRT->status);
        $this->assertEquals($originalSubmittedAt->timestamp, $rekapRT->submitted_at->timestamp);
    }

    /** @test */
    public function approved_rekap_cannot_be_submitted_again()
    {
        // Arrange
        $moderator = User::factory()->moderator()->create();
        $rekapRT = RekapitulasiRT::factory()->approved()->create([
            'submitted_by' => $moderator->id,
        ]);

        // Act
        $response = $this->actingAs($moderator)
            ->post(route('rekapitulasi-rt.submit', $rekapRT->id_rekap_rt));

        // Assert
        $rekapRT->refresh();
        $this->assertEquals('approved', $rekapRT->status);
    }
}
