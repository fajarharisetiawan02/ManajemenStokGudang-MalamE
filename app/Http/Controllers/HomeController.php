<?php

namespace App\Http\Controllers; 
use Illuminate\Http\Request;
class HomeController extends Controller
{
    public function index()
    {
    // $data = [
    //	'nama' => 'Budi',
    // 'pekerjaan' => 'Developer',
    //];
    // return view('home')->with($data);
    $nama = "Fajar";
    $pekerjaan = "programmer";
    $umur = "22";
    $tanggal_lahir = "Trenggalek, 03 Maret 2002";
    $tempat_tinggal = "Bengkong";
    $alamat = "Tanjung Buntung";
    return view('home', compact('nama', 'pekerjaan', 'umur', 'tanggal_lahir', 'tempat_tinggal', 'alamat'));
    }
public function contact()
{
return view('contact');
}
}
