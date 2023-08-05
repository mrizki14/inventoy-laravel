<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    protected $fillable = ['codes_id', 'tgl_keluar', 'qty'];

    public function codes()
    {
        return $this->belongsTo(Codes::class, 'codes_id','id');
    }
    protected $dispatchesEvents = [
        'created' => \App\Events\BarangTransaksiCreated::class,
    ];
}
