<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    //must be fill
    protected $fillable = [
        'name', 'email', 'password', 'phone_number',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    //verify user time
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function cartItems()
    {
        return $this->hasMany(Cart::class, 'user_id');
    }

    public function shippingAddresses()
    {
        return $this->hasMany(ShippingAddress::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
    

}
