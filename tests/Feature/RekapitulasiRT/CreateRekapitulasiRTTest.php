<?php

namespace Tests\Feature\RekapitulasiRT;

use App\Models\RekapitulasiPenduduk;
use App\Models\RekapitulasiRT;
use App\Models\RT;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateRekapitulasiRTTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function super_admin_creates_rekap_rt_with_approved_status()
    {
        // Arrange
        $admin = User::factory()->superAdmin()->create();
        $rt = RT::factory()->create();
        $rekap = RekapitulasiPenduduk::factory()->create();

        // Act
        $response = $this->actingAs($admin)->post(route('rekapitulasi-rt.store'), [
            'id_rekap' => $rekap->id_rekap,
            'id_rt' => $rt->id_rt,
            'jumlah_kk' => 50,
            'jumlah_penduduk_akhir' => 200,
        ]);

        // Assert
        $response->assertRedirect();
        $response->assertSessionHas('success');

        $createdRT = RekapitulasiRT::where('id_rt', $rt->id_rt)
            ->where('id_rekap', $rekap->id_rekap)
            ->first();

        $this->assertNotNull($createdRT);
        $this->assertEquals('approved', $createdRT->status);
        $this->assertNotNull($createdRT->validated_at);
        $this->assertEquals($admin->id, $createdRT->submitted_by);
    }

    /** @test */
    public function moderator_creates_rekap_rt_with_draft_status()
    {
        // Arrange
        $rt = RT::factory()->create();
        $moderator = User::factory()->moderator($rt->id_rt)->create();
        $rekap = RekapitulasiPenduduk::factory()->create();

        // Act
        $response = $this->actingAs($moderator)->post(route('rekapitulasi-rt.store'), [
            'id_rekap' => $rekap->id_rekap,
            'id_rt' => $rt->id_rt,
            'jumlah_kk' => 30,
            'jumlah_penduduk_akhir' => 120,
        ]);

        // Assert
        $response->assertRedirect();

        $createdRT = RekapitulasiRT::where('id_rt', $rt->id_rt)
            ->where('id_rekap', $rekap->id_rekap)
            ->first();

        $this->assertNotNull($createdRT);
        $this->assertEquals('draft', $createdRT->status);
        $this->assertNull($createdRT->validated_at);
        $this->assertEquals($moderator->id, $createdRT->submitted_by);
    }

    /** @test */
    public function cannot_create_duplicate_rt_for_same_rekap()
    {
        // Arrange
        $admin = User::factory()->superAdmin()->create();
        $rt = RT::factory()->create();
        $rekap = RekapitulasiPenduduk::factory()->create();

        // Create first RekapitulasiRT
        RekapitulasiRT::factory()->create([
            'id_rekap' => $rekap->id_rekap,
            'id_rt' => $rt->id_rt,
        ]);

        // Act - try to create duplicate
        $response = $this->actingAs($admin)->post(route('rekapitulasi-rt.store'), [
            'id_rekap' => $rekap->id_rekap,
            'id_rt' => $rt->id_rt,
            'jumlah_kk' => 50,
            'jumlah_penduduk_akhir' => 200,
        ]);

        // Assert - should fail validation
        $response->assertSessionHasErrors('id_rt');
    }

    /** @test */
    public function validates_required_fields()
    {
        // Arrange
        $admin = User::factory()->superAdmin()->create();

        // Act  
        $response = $this->actingAs($admin)->post(route('rekapitulasi-rt.store'), []);

        // Assert
        $response->assertSessionHasErrors(['id_rekap', 'id_rt', 'jumlah_kk', 'jumlah_penduduk_akhir']);
    }
}
