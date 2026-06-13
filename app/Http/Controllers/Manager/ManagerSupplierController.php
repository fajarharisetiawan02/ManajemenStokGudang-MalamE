<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ManagerSupplierController extends Controller
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

        return view('pages.manager.supplier', compact('suppliers'));
    }
}