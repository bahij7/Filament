<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["name", "price", "description", "isAvailable"];

    public function orders() : hasMany
    {
        return $this->hasMany(Orders::class, 'product_id');
    }
}
