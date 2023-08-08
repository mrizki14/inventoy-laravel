<?php

namespace App\Models;

use App\Models\Codes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogBarang extends Model
{
    use HasFactory;

    protected $fillable = ['codes_id', 'stock_awal', 'barang_masuk', 'tgl_masuk', 'barang_keluar',  'tgl_keluar'];

    public function code()
    {
        return $this->belongsTo(Codes::class, 'codes_id', 'id');
    }
}
