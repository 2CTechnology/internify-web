<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratPelaksanaanController extends Controller
{
    public function index()
    {
        $data = []; // bisa kamu isi nanti kalau sudah ada datanya
        $param['title'] = 'Surat Pelaksanaan';
        $param['header'] = 'Form Surat Pelaksanaan ';
        $param['data'] = $data;

        return view('backend.surat-pelaksanaan.index', $param);
    }
}
