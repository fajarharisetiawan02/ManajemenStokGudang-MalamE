<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;

class ManagerLaporanController extends Controller
{
    public function index()
    {
        return view('pages.manager.laporan');
    }
}