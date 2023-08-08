<?php

namespace App\Listeners;

use App\Models\LogBarang;
use App\Events\BarangKeluarCreated;
use App\Events\BarangTransaksiCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BarangKeluarCreatedListener
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
     * @param  \App\Events\BarangKeluarCreated  $event
     * @return void
     */
    public function handle(BarangTransaksiCreated $event)
    {
        $barangKeluar = $event->barangTransaksi;

        // Create a new row in the 'log_barangs' table only if all columns are met
        if ($barangKeluar->codes_id && $barangKeluar->qty && $barangKeluar->tgl_keluar) {
            $stock_awal = -$barangKeluar->qty;
            $barang_keluar = $barangKeluar->qty;

            LogBarang::create([
                'codes_id' => $barangKeluar->codes_id,
                'stock_awal' => $stock_awal,
                'barang_keluar' => $barang_keluar,
                'tgl_keluar' => $barangKeluar->tgl_keluar,
            ]);
        }
    }
}
