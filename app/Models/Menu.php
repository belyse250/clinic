<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'item_id';
    public $timestamps = true;

    protected $fillable = [
        'item_name',
        'description',
        'price',
        'category',
        'status',
    ];

    // Relationships
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'item_id', 'item_id');
    }
}
