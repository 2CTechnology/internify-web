<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class AdminProdiTest extends TestCase
{

    /** @test */
    public function menu_data_mahasiswa_dapat_dibuka()
    {
        $user = User::where('role', 'Prodi')->first();
        $this->assertNotNull($user, 'User admin prodi tidak ditemukan, pastikan ada di db');
        $this->actingAs($user);
        $response = $this->get('/data-mahasiswa');
        $response->assertStatus(200);
        $response->assertSee('Data Mahasiswa');
    }

    /** @test */
    public function menu_surat_pelaksanaan_dapat_dibuka()
    {
        $user = User::where('role', 'Prodi')->first();
        $this->assertNotNull($user, 'User admin prodi tidak ditemukan, pastikan ada di db');
        $this->actingAs($user);
        $response = $this->get('/surat-pelaksanaan');
        $response->assertStatus(200);
        $response->assertSee('Surat Pelaksanaan');
    }
}
