<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id'
        
    ];

    public function getName()
    {
        return $this->name;
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
