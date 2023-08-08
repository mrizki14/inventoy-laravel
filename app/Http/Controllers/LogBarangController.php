<?php

namespace App\Http\Controllers;

use App\Models\Codes;
use App\Models\LogBarang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LogBarangController extends Controller
{
    public function logBarang (Request $request) {

        $logBarang = LogBarang::with('code')->get();
        return view('log_barang',compact('logBarang' ),[
            "title" => "Data Barang",
            // 'stockMasuk' => $stockMasuk

        ]);
        
    }
    public function exportPdf () {
        $barangs = Codes::with(['barangMasuks', 'barangKeluars'])->get();   
        $pdf = Pdf::loadView('pdf.export-log-barang',['barangs' => $barangs, 'title' => ''])->setOptions(['defaultFont' => 'sans-serif']);
        return $pdf->download('log-barang.pdf');
    }
}
