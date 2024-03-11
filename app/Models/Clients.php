<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable = ["name", "email", "phone", "address", "city", "status"];

    public function orders()
    {
        return $this->hasMany(Order::class, 'client_id');
    }
}