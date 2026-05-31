<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class AdminSupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($request->search) {
            $query->where('nama_supplier', 'like', '%' . $request->search . '%');
        }

        if ($request->status == 'aktif') {
            $query->where('status', 1);
        }

        if ($request->status == 'nonaktif') {
            $query->where('status', 0);
        }

        $perPage = $request->per_page ?? 10;

        $suppliers = $query->paginate($perPage);

        return view('pages.admin.supplier', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'status' => 'required',
        ]);

        Supplier::create([
            'nama_supplier' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'tambah');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'telepon' => 'required',
            'alamat' => 'required',
            'status' => 'required',
        ]);

        $supplier = Supplier::findOrFail($id);

        $supplier->update([
            'nama_supplier' => $request->nama,
            'telepon' => $request->telepon,
            'alamat' => $request->alamat,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'update');
    }

    public function destroy($id)
    {
        Supplier::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'delete');
    }
}