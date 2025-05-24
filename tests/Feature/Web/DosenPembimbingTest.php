<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class DosenPembimbingTest extends TestCase
{

    /** @test */
    public function menu_berita_acara_dapat_dibuka()
    {
        $user = User::where('role', 'Dosen')->first();
        $this->assertNotNull($user, 'User dosen tidak ditemukan, pastikan ada di db');
        $this->actingAs($user);
        $response = $this->get('/berita-acara');
        $response->assertStatus(200);
        $response->assertSee('Daftar Berita Acara');
    }

    /** @test */
    public function menu_bimbingan_dapat_dibuka()
    {
        $user = User::where('role', 'Dosen')->first();
        $this->assertNotNull($user, 'User dosen tidak ditemukan, pastikan ada di db');
        $this->actingAs($user);
        $response = $this->get('/bimbingan');
        $response->assertStatus(200);
        $response->assertSee('Bimbingan');
    }

    /** @test */
    public function menu_evaluasi_magang_dapat_dibuka()
    {
        $user = User::where('role', 'Dosen')->first();
        $this->assertNotNull($user, 'User dosen tidak ditemukan, pastikan ada di db');
        $this->actingAs($user);
        $response = $this->get('/evaluasi-magang');
        $response->assertStatus(200);
        $response->assertSee('Evaluasi Magang');
    }

    /** @test */
    public function menu_laporan_magang_dapat_dibuka()
    {
        $user = User::where('role', 'Dosen')->first();
        $this->assertNotNull($user, 'User dosen tidak ditemukan, pastikan ada di db');
        $this->actingAs($user);
        $response = $this->get('/laporan-magang');
        $response->assertStatus(200);
        $response->assertSee('Laporan Magang');
    }
}
