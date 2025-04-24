<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeritaAcaraController extends Controller
{
    //
    public function index()
    {
        $data = []; // bisa kamu isi nanti kalau sudah ada datanya
        $param['title'] = 'Berita Acara';
        $param['header'] = 'Daftar Berita Acara';
        $param['data'] = $data;

        return view('backend.berita-acara.index', $param);
    }
}
