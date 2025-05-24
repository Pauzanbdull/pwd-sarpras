<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Barang;
class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalians = Pengembalian::with(['peminjam', 'barang'])->get();
    
        return view('pengembalian.index', compact('pengembalians'));
    }
}
