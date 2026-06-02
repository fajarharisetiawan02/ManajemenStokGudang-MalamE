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

        if ($request->filled('search')) {
            $query->where('nama_supplier', 'like', '%' . $request->search . '%');
        }

        $perPage = $request->per_page ?? 10;

        $suppliers = $query
            ->orderBy('id', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        return view('pages.admin.supplier', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'telepon'  => 'required|string|max:20',
            'email'    => 'nullable|email|max:255',
            'alamat'   => 'required|string',
        ]);

        Supplier::create([
            'nama_supplier' => $request->nama,
            'telepon'       => $request->telepon,
            'email'         => $request->email,
            'alamat'        => $request->alamat,
        ]);

        return redirect()
            ->back()
            ->with('success', 'tambah');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'telepon'  => 'required|string|max:20',
            'email'    => 'nullable|email|max:255',
            'alamat'   => 'required|string',
        ]);

        $supplier = Supplier::findOrFail($id);

        $supplier->update([
            'nama_supplier' => $request->nama,
            'telepon'       => $request->telepon,
            'email'         => $request->email,
            'alamat'        => $request->alamat,
        ]);

        return redirect()
            ->back()
            ->with('success', 'update');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();

        return redirect()
            ->back()
            ->with('success', 'delete');
    }
}