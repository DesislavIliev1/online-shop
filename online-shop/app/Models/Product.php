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
        'user_id',
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
    

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

