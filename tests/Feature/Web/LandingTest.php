<?php

namespace Tests\Feature\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LandingTest extends TestCase
{
    /** @test */
    public function halaman_landing_dapat_dibuka()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Selamat Datang di Internify');
    }

    /** @test */
    public function lihat_halaman_tempat_magang()
    {
        $response = $this->get('/tempatmagang');
        $response->assertStatus(200);
        $response->assertSee('JV Partner Indonesia');
    }

    /** @test */
    public function lihat_halaman_dosen_pembimbing()
    {
        $response = $this->get('/daftardosen');
        $response->assertStatus(200);
        $response->assertSee('Dosen Pembimbing');
    }

    /** @test */
    public function masuk_ke_halaman_login()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Login');
    }

    /** @test */
    public function masuk_ke_halaman_chatbot()
    {
        $response = $this->get('/chat');
        $response->assertStatus(200);
        $response->assertSee('Selamat Datang di Internify.AI');
    }
}
