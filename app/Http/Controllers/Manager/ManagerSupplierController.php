<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ManagerSupplierController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::latest();

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'nama_supplier',
                    'like',
                    '%' . $request->search . '%'
                )
                ->orWhere(
                    'telepon',
                    'like',
                    '%' . $request->search . '%'
                );

            });

        }

        $perPage = (int) $request->input('per_page', 10);

        $suppliers = $query
            ->paginate($perPage)
            ->withQueryString();

        return view(
            'pages.manager.supplier',
            compact('suppliers')
        );
    }
}