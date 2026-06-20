<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalBarang     = Barang::count();
        $totalSupplier   = Supplier::count();
        $totalTransaksi  = BarangMasuk::count() + BarangKeluar::count();

        return view('pages.landing.home', compact(
            'totalBarang',
            'totalSupplier',
            'totalTransaksi'
        ));
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