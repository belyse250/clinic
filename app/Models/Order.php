<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    public $timestamps = true;

    protected $fillable = [
        'cust_id',
        'date',
        'time',
        'total_amount',
        'status',
        'notes',
        'user_id',
    ];

    protected $casts = [
        'date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cust_id', 'cust_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }

    public function staff()
    {
        return $this->belongsTo(RestaurantUser::class, 'user_id', 'user_id');
    }

    // Calculate total amount from order details
    public function calculateTotal()
    {
        $this->total_amount = $this->orderDetails()->sum('subtotal');
        return $this->total_amount;
    }
}
