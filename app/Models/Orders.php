<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Orders extends Model
{
    protected $fillable = ["client_id", "client_name", "client_phone", "product_id", "product_name", "product_price", "status"];
   
   
    public function client() : belongsTo
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }

    public function product() : belongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

}
