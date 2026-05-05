<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;

class ManagerBarangKeluarController extends Controller
{
    public function index()
    {
        // sementara pakai data kosong / dummy
        $data = [];

        return view('pages.manager.barang-keluar', compact('data'));
    }
}