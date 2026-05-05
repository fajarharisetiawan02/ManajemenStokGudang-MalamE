<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;

class ManagerBarangMasukController extends Controller
{
    public function index()
    {
        return view('pages.manager.barang-masuk');
    }
}