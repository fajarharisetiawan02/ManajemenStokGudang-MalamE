<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // ==========================
    // HOME
    // ==========================
    public function index()
    {
        $nama = "Farhan";
        $pekerjaan = "Programmer";
        $umur = "19";
        $tanggal_lahir = "Batam, 21 Desember 2006";
        $tempat_tinggal = "Bengkong";
        $alamat = "Sadai";

        return view('home', compact(
            'nama',
            'pekerjaan',
            'umur',
            'tanggal_lahir',
            'tempat_tinggal',
            'alamat'
        ));
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