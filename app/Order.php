<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Order extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
    ];

    /**
     * 
     * Relationships
     * 
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
