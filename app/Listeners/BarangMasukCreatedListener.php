<?php

namespace App\Listeners;

use App\Models\LogBarang;
use App\Events\BarangMasukCreated;
use App\Events\BarangTransaksiCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BarangMasukCreatedListener
{   
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\BarangTransaksiCreated   $event
     * @return void
     */
    public function handle(BarangTransaksiCreated $event)
    {
        $barangMasuk = $event->barangTransaksi;

        // Create a new row in the 'log_barangs' table only if all columns are met
        if ($barangMasuk->codes_id && $barangMasuk->qty && $barangMasuk->tgl_masuk) {
            $stock_awal = $barangMasuk->qty;
            $barang_masuk = $barangMasuk->qty;

            LogBarang::create([
                'codes_id' => $barangMasuk->codes_id,
                'stock_awal' => $stock_awal,
                'barang_masuk' => $barang_masuk,
                'tgl_masuk' => $barangMasuk->tgl_masuk,
            ]);
        }
    }
}
