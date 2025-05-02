<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EvaluasiMagangController extends Controller
{
public function index()
{
    {
        $data = []; // bisa kamu isi nanti kalau sudah ada datanya
        $param['title'] = 'Evaluasi Tempat Magang';
        $param['header'] = 'evaluasi magang';
        $param['data'] = $data;

        return view('backend.evaluasi-magang.index', $param);
    }
}
}
