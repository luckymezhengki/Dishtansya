<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Order;

class Product extends Model
{
    protected $fillable = [
        'name',
        'available_stock',
    ];

    /**
     * 
     * Relationships
     * 
     */
    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
