<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["name", "price", "description", "isAvailable"];

    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id');
    }
}
