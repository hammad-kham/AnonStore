<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    use HasFactory;
    use Notifiable;


     //actually i have changes table name thats why i did this. model know migration exists
    protected $table = 'admins';

// Fillable fields
protected $fillable = [
    'name',
    'email',
    'password',
];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
