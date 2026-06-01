<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'cust_id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'status',
    ];

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class, 'cust_id', 'cust_id');
    }

    // Get total spending for the customer
    public function totalSpending()
    {
        return $this->orders()
            ->where('status', 'completed')
            ->sum('total_amount');
    }
}
