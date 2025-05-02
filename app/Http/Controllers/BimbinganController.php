<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BimbinganController extends Controller
{
    // Method untuk menampilkan halaman Bimbingan
    public function index()
    {
        {
            $data = []; // bisa kamu isi nanti kalau sudah ada datanya
            $param['title'] = 'Bimbingan';
            $param['header'] = 'bimbingan';
            $param['data'] = $data;
    
            return view('backend.bimbingan.index', $param);
        }
    }
}