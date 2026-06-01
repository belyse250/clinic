<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class RestaurantUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'restaurant_users';
    protected $primaryKey = 'user_id';
    public $timestamps = true;

    protected $fillable = [
        'username',
        'password',
        'name',
        'role',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }
}
