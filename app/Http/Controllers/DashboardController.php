<?php

// Nama : Fajar Hari Setiawan
// NIM  : 3312511140

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}