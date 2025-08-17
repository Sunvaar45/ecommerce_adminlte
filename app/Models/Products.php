<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'has_discount',
        'discount_price',
        'stock',
        'color',
        'image_url',
        'category_id',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
