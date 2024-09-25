<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'category_id',
        'status',
        'price',
        'image',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        // 'status' => ProductStatus::class,
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];
}
