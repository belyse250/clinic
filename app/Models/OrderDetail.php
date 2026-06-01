<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    public $timestamps = true;

    protected $fillable = [
        'order_id',
        'item_id',
        'quantity',
        'unit_price',
        'subtotal',
        'special_instructions',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Relationships
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function menuItem()
    {
        return $this->belongsTo(Menu::class, 'item_id', 'item_id');
    }

    // Calculate subtotal
    public function calculateSubtotal()
    {
        $this->subtotal = $this->quantity * $this->unit_price;
        return $this->subtotal;
    }
}
