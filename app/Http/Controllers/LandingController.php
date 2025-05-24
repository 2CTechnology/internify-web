<?php

namespace App\Http\Controllers;

use App\Models\FileTemplate;
use App\Models\TempatMagang;
use App\Models\User;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    //
    public function index() {
        $fileTemplate = FileTemplate::get();
        return view('user.pages.landing', compact('fileTemplate'));
    }
    public function daftardosen() {
        $data = User::where('role', 'Dosen')
            ->get();
        return view('user.pages.daftardosen', compact('data'));
    }
    public function tempatmagang() {
        $data = TempatMagang::get();
        return view('user.pages.tempatmagang', compact('data'));
    }
}
