<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // ==========================
    // HOME / LANDING PAGE
    // ==========================
    public function index()
    {
        return view('pages.landing.home');
    }

    // ==========================
    // ABOUT
    // ==========================
    public function about()
    {
        return view('pages.landing.about');
    }

    // ==========================
    // CONTACT
    // ==========================
    public function contact()
    {
        return view('pages.landing.contact');
    }
}