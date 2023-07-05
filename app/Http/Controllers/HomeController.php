<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BarangMasuk;
use App\Models\Category;
use App\Models\Codes;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        $user = User::count();
        $kategori = Category::count();
        $code = Codes::count();
        $barangMasuk = BarangMasuk::count();
        $barangKeluar = BarangMasuk::count();
        return view('dashboardAdmin',
        [
            "title" => "Dashboard Admin",
            'user' => $user,
            'kategori' => $kategori,
            'code' => $code,
            'barangMasuk' => $barangMasuk,
            'barangKeluar' => $barangKeluar,
        ]);
    }
    // public function user()
    // {
    //     return view('dashboardUser',
    //     [
    //         "title" => "Dashboard User"
    //     ]);
    // }

    // public function dataAdmin (){
    //     $dataAdmin = User::find(1);
    //         return view('dataAdmin', compact('dataAdmin'));
        
    // }
}

