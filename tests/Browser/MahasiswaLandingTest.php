<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class MahasiswaLandingTest extends DuskTestCase
{
    
    /** @test */
    public function lihat_daftar_dosen_dan_detail()
    {
        $this->browse(function (Browser $browser)
        {
            $browser->visit('/')
                    ->click('@btn-daftar-dosen') // selector button untuk dusk
                    ->assertSee('Ex Dosen')
                    ->click('@btn-detail-dosen-1') // selector detail dosen
                    ->pause(1000) // tunggu modal muncul
                    ->assertSee('Detail Dosen');
        });
    }

    /** @test */
    public function lihat_daftar_tempat_magang_dan_detail()
    {
        $this->browse(function (Browser $browser)
        {
            $browser->visit('/')
                    ->click('@btn-daftar-tempat')
                    ->assertSee('JV Partner Indonesia')
                    ->click('@btn-detail-tempat-1')
                    ->pause(1000)
                    ->assertSee('Detail JV Partner Indonesia');
        });
    }

    /** @test */
    public function download_buku_panduan()
    {
        $this->browse(function (Browser $browser)
        {
            $browser->visit('/')
                    -> assertSee('Buku Panduan')
                    ->click('@download-panduan')
                    ->pause(2000); //  asumsi file terdownload karena tidak bisa preview dan assert langsung
        });
    }

    // Belum diinput ke dusk test karena chatbot belum berAPI
    public function interaksi_dengan_chatbot()
    {
        $this->browse(function (Browser $browser)
        {
            $browser->visit('/')
                    ->click('@btn-chatbot')
                    ->pause(1000)
                    ->type('@input-chatbot', 'Dokumen yang harus disiapkan ketika magang')
                    ->press('@btn-send-chatbot')
                    ->pause(1000)
                    ->assertSee('Dokumen yang perlu dipersiapkan');
        });
    }
}
