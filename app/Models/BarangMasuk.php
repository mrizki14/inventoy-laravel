<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangMasuk extends Model
{
    use HasFactory, Searchable;

    protected $fillable = ['codes_id', 'qty', 'tgl_masuk'];
    

    public function codes()
    {
        return $this->belongsTo(Codes::class, 'codes_id','id');
    }
    
    protected $dispatchesEvents = [
        'created' => \App\Events\BarangTransaksiCreated::class,
    ];

}

