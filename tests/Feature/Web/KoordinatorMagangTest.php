<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class KoordinatorMagangTest extends TestCase
{

    /** @test */
    public function menu_akun_mahasiswa_dapat_dibuka()
    {
        // Ambil user dari db berdasarkan role
        $user = User::where('role', 'Admin')->first();

        // memastikan usernya ada
        $this->assertNotNull($user, 'User admin/koordinator tidak ditemukan, pastikan ada di db');

        // Login sebagai koordinator
        $this->actingAs($user);

        // Akses halaman dashboard submenu akun mahasiswa
        $response = $this->get('/akun-mahasiswa');

        // Verifikasi berhasil akses
        $response->assertStatus(200);
        $response->assertSee('Akun Mahasiswa');
    }

    /** @test */
    public function menu_proposal_magang_dapat_dibuka()
    {
        $user = User::where('role', 'Admin')->first();
        $this->assertNotNull($user, 'User admin/koordinator tidak ditemukan, pastikan ada di db');
        $this->actingAs($user);
        $response = $this->get('/proposal');
        $response->assertStatus(200);
        $response->assertSee('Proposal Magang');
    }

    /** @test */
    public function menu_surat_balasan_dapat_dibuka()
    {
        $user = User::where('role', 'Admin')->first();
        $this->assertNotNull($user, 'User admin/koordinator tidak ditemukan, pastika ada di db');
        $this->actingAs($user);
        $response = $this->get('/surat-balasan');
        $response->assertStatus(200);
        $response->assertSee('Surat Balasan');
    }

    /** @test */
    public function menu_ploting_dosen_dapat_dibuka()
    {
        $user = User::where('role', 'Admin')->first();
        $this->assertNotNull($user, 'User admin/koordinator tidak ditemukan, pastikan ada di db');
        $this->actingAs($user);
        $response = $this->get('/ploting-dosen/ploting-dosen');
        $response->assertStatus(200);
        $response->assertSee('Ploting Dosen');
    }

    /** @test */
    public function menu_dospem_dapat_dibuka()
    {
        $user = User::where('role', 'Admin')->first();
        $this->assertNotNull($user, 'User admin/koordinator tidak ditemukan, pastikan ada di db');
        $this->actingAs($user);
        $response = $this->get('/dospem');
        $response->assertStatus(200);
        $response->assertSee('Dosen Pembimbing');
    }

    /** @test */
    public function menu_tempat_magang_dapat_dibuka()
    {
        $user = User::where('role', 'Admin')->first();
        $this->assertNotNull($user, 'User admin/koordinator tidak ditemukan, pastikan ada di db');
        $this->actingAs($user);
        $response = $this->get('/tempat-magang');
        $response->assertStatus(200);
        $response->assertSee('Tempat Magang');
    }

    /** @test */
    public function menu_buku_panduan_dapat_dibuka()
    {
        $user = User::where('role', 'Admin')->first();
        $this->assertNotNull($user, 'User admin/koordinator tidak ditemukan, pastikan ada di db');
        $this->actingAs($user);
        $response = $this->get('/file-template');
        $response->assertStatus(200);
        $response->assertSee('File Template');
    }

    /** @test */
    public function menu_program_studi_dapat_dibuka()
    {
        $user = User::where('role', 'Admin')->first();
        $this->assertNotNull($user, 'User admin/koordinator tidak ditemukan, pastikan ada di db');
        $this->actingAs($user);
        $response = $this->get('/prodi');
        $response->assertStatus(200);
        $response->assertSee('Program Studi');
    }
}
