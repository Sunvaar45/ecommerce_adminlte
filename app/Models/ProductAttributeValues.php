<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttributeValues extends Model
{
    use HasFactory;

    protected $table = 'product_attribute_values';

    protected $fillable = [
        'product_id',
        'attribute_id',
        'value',
        'sort_order',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function attribute()
    {
        return $this->belongsTo(Attributes::class, 'attribute_id');
    }
}
