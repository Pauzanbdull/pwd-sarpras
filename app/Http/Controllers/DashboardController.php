<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\KategoriBarang;

class DashboardController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $barangCount = Barang::count();
        $kategoriCount = KategoriBarang::count(); // Pastikan ini ada!

        return view('dashboard', compact('userCount', 'barangCount', 'kategoriCount'));
    }
}
