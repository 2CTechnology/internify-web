<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class TemplateSuratController extends Controller
{
    public function previewBeritaAcara()
    {
        $data = [
            'hari' => 'Jumat',
            'tanggal' => '2025-04-25',
            'tempat' => 'PT. Teknologi Maju',
            'program_studi' => 'Teknik Informatika',
            'jurusan' => 'Teknologi Informasi',
            'mahasiswa' => ['Rizaldi Ramadhan', 'Alya Rahma', 'Nanda Putra', 'Dina Aprilia'],
            'pembimbing_nama' => 'Budi Santoso',
            'pembimbing_divisi' => 'Divisi IT',
            'pembimbing_jabatan' => 'Supervisor TI',
            'catatan' => 'Mahasiswa menunjukkan semangat kerja yang baik dan mampu beradaptasi dengan lingkungan kerja.',
            'dosen_pembimbing' => 'Dr. Sulastri, M.Kom',
        ];

        $pdf = Pdf::loadView('backend.dospem.template-surat', $data);
        return $pdf->stream('berita_acara_magang.pdf'); // untuk preview di browser
    }

    public function previewRekomendasi()
{
    $data = [
        'lokasi' => 'PT. Teknologi Maju',
        'tanggal' => '2025-04-25',
        'catatan' => [
            'Lingkungan kerja mendukung proses pembelajaran.',
            'Pembimbing kooperatif dan aktif.',
            'Fasilitas memadai untuk mahasiswa magang.',
            'Kegiatan magang sesuai dengan kompetensi program studi.'
        ],
    ];

    $pdf = Pdf::loadView('backend.dospem.template-rekomendasi', $data);
    return $pdf->stream('rekomendasi_lokasi_magang.pdf');
}
}
