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
        return view('home');
    }

    // ==========================
    // ABOUT
    // ==========================
    public function about()
    {
        return view('about');
    }

    // ==========================
    // PRODUCT
    // ==========================
    public function product()
    {
        return view('product');
    }

    // ==========================
    // CONTACT
    // ==========================
    public function contact()
    {
        return view('contact');
    }
}