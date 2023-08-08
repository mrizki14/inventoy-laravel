<?php

namespace App\Listeners;

use App\Models\LogBarang;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Events\BarangTransaksiCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use PhpParser\Node\NullableType;

class BarangTransaksiCreatedListener
{
    
   
public function handle(BarangTransaksiCreated $event)
    {
        $barangTransaksi = $event->barangTransaksi;

        // Create a new row in the 'log_barangs' table for each new entry
      

        
        $stock_awal = $barangTransaksi instanceof BarangMasuk ? $barangTransaksi->qty : -$barangTransaksi->qty;
        $barang_masuk = $barangTransaksi instanceof BarangMasuk ? $barangTransaksi->qty : 0;
        $barang_keluar = $barangTransaksi instanceof BarangKeluar ? $barangTransaksi->qty : 0;
        $tgl_masuk = $barangTransaksi instanceof BarangMasuk ? $barangTransaksi->tgl_masuk : 0;
        $tgl_keluar = $barangTransaksi instanceof BarangKeluar ? $barangTransaksi->tgl_keluar: 0;


        LogBarang::create([
            'codes_id' => $barangTransaksi->codes_id,
            'stock_awal' => $stock_awal,
            'barang_masuk' => $barang_masuk,
            'tgl_masuk' => $tgl_masuk,
            'barang_keluar' => $barang_keluar,
            'tgl_keluar' => $tgl_keluar,
        ]);
    }
}



   
