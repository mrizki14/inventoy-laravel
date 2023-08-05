<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use Laravel\Scout\Searchable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

   
    protected $fillable = [
        'name',
        'email',
        'password',
        // 'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role() {
        return $this->belongsTo(Role::class);
    }

    // public function roles() {
    //     return new Attribute(
    //         get: fn($value) => ['role_id'] [$value]
    //     );
    // }

    // use Searchable {
    //     Searchable::search as parentSearch;
    // }
    
    // public function toSearchableArray(){
    //     return [
    //         'name' => $this->name,
    //         'email' => $this->email,
    //         ''
    //     ];
    // }

    // public static function search($query = '', $callback = null)
    // {
    //     return static::parentSearch($query, $callback)->query(function ($builder) {
    //         $builder->join('roles', 'user.role_id', '=', 'role.id');
    //     });
    // }

}
