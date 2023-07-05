<?php

namespace App\Models;

use App\Models\User;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Role extends Model
{
    use HasFactory;

    // public function auth() {
    //     return $this->hasMany(Admin::class, User::class);

    // }
    protected $fillable = ['name'];

    public function user() {
        return $this->hasMany(User::class);
        
    }

}
