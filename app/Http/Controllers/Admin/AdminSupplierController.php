<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;

class AdminSupplierController extends Controller
{
    // =========================
    // TAMPIL DATA
    // =========================
    public function index()
    {
        $suppliers = session('suppliers', []);
        return view('pages.admin.supplier', compact('suppliers'));
    }

    // =========================
    // TAMBAH DATA
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required'
        ]);

        $suppliers = session('suppliers', []);

        $suppliers[] = [
            'id' => uniqid(),
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'status' => 1
        ];

        session(['suppliers' => $suppliers]);

        return redirect()->back()->with('success', 'tambah');
    }

    // =========================
    // UPDATE DATA
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required'
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

    // =========================
    // HAPUS DATA
    // =========================
    public function destroy($id)
    {
        $suppliers = session('suppliers', []);

        $suppliers = array_filter($suppliers, function ($item) use ($id) {
            return $item['id'] != $id;
        });

        session(['suppliers' => $suppliers]);

        return redirect()->back()->with('success', 'delete');
    }
}