<?php

namespace App\Models;

use App\Models\LogBarang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori',
    ];

    /**
     * Get all of the comments for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function codes()
    {
        return $this->hasMany(Code::class);
    }   
    public function logBarang()
    {
        return $this->hasMany(LogBarang::class);
    }   
}
