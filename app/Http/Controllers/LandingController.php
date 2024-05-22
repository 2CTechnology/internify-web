<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    //
    public function index() {
        return view('user.pages.landing');
    }
    public function daftardosen() {
        return view('user.pages.daftardosen');
    }
    public function tempatmagang() {
        return view('user.pages.tempatmagang');
    }
}
