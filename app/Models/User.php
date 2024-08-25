<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'status',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    //verify user time
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];


}
