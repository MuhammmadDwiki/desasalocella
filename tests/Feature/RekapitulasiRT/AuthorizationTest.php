<?php

namespace Tests\Feature\RekapitulasiRT;

use App\Models\RekapitulasiRT;
use App\Models\RT;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function moderator_cannot_approve_rekap()
    {
        // Arrange
        $moderator = User::factory()->moderator()->create();
        $rekapRT = RekapitulasiRT::factory()->pending()->create();

        // Act
        $response = $this->actingAs($moderator)
            ->post(route('rekapitulasi-rt.validate', $rekapRT->id_rekap_rt));

        // Assert - moderator should not have permission
        // The controller checks for super_admin role
        $rekapRT->refresh();
        $this->assertEquals('pending', $rekapRT->status); // Should remain pending
    }

    /** @test */
    public function moderator_cannot_reject_rekap()
    {
        // Arrange
        $moderator = User::factory()->moderator()->create();
        $rekapRT = RekapitulasiRT::factory()->pending()->create();

        // Act
        $response = $this->actingAs($moderator)
            ->post(route('rekapitulasi-rt.reject', $rekapRT->id_rekap_rt), [
                'message' => 'Trying to reject',
            ]);

        // Assert
        $rekapRT->refresh();
        $this->assertEquals('pending', $rekapRT->status); // Should remain unchanged
    }

    /** @test */
    public function guest_cannot_access_rekap_rt_actions()
    {
        // Arrange
        $rekapRT = RekapitulasiRT::factory()->draft()->create();

        // Act & Assert - all should redirect to login
        $this->post(route('rekapitulasi-rt.submit', $rekapRT->id_rekap_rt))
            ->assertRedirect(route('login'));

        $this->post(route('rekapitulasi-rt.validate', $rekapRT->id_rekap_rt))
            ->assertRedirect(route('login'));

        $this->post(route('rekapitulasi-rt.reject', $rekapRT->id_rekap_rt))
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function moderator_can_only_submit_own_rt_rekap()
    {
        // Arrange
        $rt1 = RT::factory()->create();
        $rt2 = RT::factory()->create();

        $moderator1 = User::factory()->moderator($rt1->id_rt)->create();
        $moderator2 = User::factory()->moderator($rt2->id_rt)->create();

        $rekapRT = RekapitulasiRT::factory()->draft()->create([
            'id_rt' => $rt2->id_rt,
            'submitted_by' => $moderator2->id,
        ]);

        // Act - moderator1 tries to submit moderator2's rekap
        $this->actingAs($moderator1)
            ->post(route('rekapitulasi-rt.submit', $rekapRT->id_rekap_rt));

        // Assert - should fail (403 or remain unchanged)
        $rekapRT->refresh();
        $this->assertEquals('draft', $rekapRT->status);
    }
}
