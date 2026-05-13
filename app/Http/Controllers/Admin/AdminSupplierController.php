<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminSupplierController extends Controller
{
    public function index()
    {
        if (!session()->has('suppliers')) {
            session([
                'suppliers' => [
                    [
                        'id' => uniqid(),
                        'nama' => 'PT Astra',
                        'telepon' => '0812-3456-7890',
                        'alamat' => 'Jakarta',
                        'status' => 1,
                    ],
                    [
                        'id' => uniqid(),
                        'nama' => 'PT Polibatam',
                        'telepon' => '0821-9876-5432',
                        'alamat' => 'Batam',
                        'status' => 1,
                    ],
                    [
                        'id' => uniqid(),
                        'nama' => 'CV Sumber Jaya',
                        'telepon' => '0852-1122-3344',
                        'alamat' => 'Bandung',
                        'status' => 0,
                    ],
                ]
            ]);
        }

        $suppliers = session('suppliers', []);
        return view('pages.admin.supplier', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        $suppliers = session('suppliers', []);

        $suppliers[] = [
            'id' => uniqid(),
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'status' => 1,
        ];

        session(['suppliers' => $suppliers]);

        return redirect()->back()->with('success', 'tambah');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
        ]);

        $suppliers = session('suppliers', []);

        foreach ($suppliers as &$item) {
            if ($item['id'] == $id) {
                $item['nama'] = $request->nama;
                $item['telepon'] = $request->telepon;
                $item['alamat'] = $request->alamat;
            }
        }

        session(['suppliers' => $suppliers]);

        return redirect()->back()->with('success', 'update');
    }

    public function destroy($id)
    {
        $suppliers = session('suppliers', []);

        $suppliers = array_values(array_filter($suppliers, function ($item) use ($id) {
            return $item['id'] != $id;
        }));

        session(['suppliers' => $suppliers]);

        return redirect()->back()->with('success', 'delete');
    }
}