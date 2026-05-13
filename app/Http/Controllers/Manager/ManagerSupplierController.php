<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;

class ManagerSupplierController extends Controller
{
    public function index()
    {
        $suppliers = [
            [
                'id' => 1,
                'nama' => 'PT Polibatam',
                'telepon' => '0812-3456-7890',
                'alamat' => 'Jakarta',
                'status' => 1,
            ],
            [
                'id' => 2,
                'nama' => 'PT Maju Mundur',
                'telepon' => '0821-9876-5432',
                'alamat' => 'Batam',
                'status' => 0,
            ],
        ];

        return view('pages.manager.supplier', compact('suppliers'));
    }
}