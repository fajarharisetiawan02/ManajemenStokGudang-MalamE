<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\NotifikasiRead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifikasiController extends Controller
{
    public function markRead(Request $request)
    {
        $user = Auth::user();

        $stokMenipis = Barang::where('stok', '<=', 10)->get();

        foreach ($stokMenipis as $barang) {
            NotifikasiRead::updateOrCreate(
                ['user_id' => $user->id, 'barang_id' => $barang->id],
                ['read_at' => now()]
            );
        }

        return response()->json(['success' => true]);
    }
}