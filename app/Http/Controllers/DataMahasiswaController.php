<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataMahasiswaController extends Controller
{
   
    public function index()
    {
        $data = []; // bisa kamu isi nanti kalau sudah ada datanya
        $param['title'] = 'Data Mahasiswa';
        $param['header'] = 'Daftar Data Mahasiswa Yang Diterima ';
        $param['data'] = $data;

        return view('backend.data-mahasiswa.index', $param);
    }
}
