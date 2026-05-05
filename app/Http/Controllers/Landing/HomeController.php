<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.landing.home');
    }

    public function about()
    {
        return view('pages.landing.about');
    }

    public function contact()
    {
        return view('pages.landing.contact');
    }
}