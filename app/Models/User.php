<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'avatar',
        'name',
        'email',
        'phone',
        'role',
        'password',
        'address',
    ];

    // menghubungkan role id dengan id pada tabel role
    public function usergroup()
    {
        return $this->belongsTo(User_group::class, 'role', 'id');
    }
}
