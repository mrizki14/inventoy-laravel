<?php

namespace App\Models;

use App\Models\Category;
use App\Models\BarangMasuk;
use Illuminate\Support\Str;
use App\Models\BarangKeluar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

class Codes extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'jumlah_barang',
        'harga',
        'id_categories'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class, 'id_categories', 'id');
    }

    public function barangMasuks () {
        return $this->hasMany(BarangMasuk::class, 'codes_id', 'id');
    }
    public function barangKeluars () {
        return $this->hasMany(BarangKeluar::class, 'codes_id', 'id');
    }

    public function getStockAkhirAttribute()
    {
        $stockAwal = $this->jumlah_barang;
        $stockMasuk = $this->barangMasuks->sum('qty');
        $stockKeluar = $this->barangKeluars->sum('qty');

        return $stockAwal + $stockMasuk - $stockKeluar;
    }

    // public function geStockMasukAttribute() {
    //     return BarangMasuk::where(function($query) {
    //         $query->where('codes_id', $this->attributes['id'])->whereRaw('qty');
    //     })->count();
    // }

}
