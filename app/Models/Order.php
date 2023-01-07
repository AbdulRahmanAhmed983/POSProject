<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\Client;
class Order extends Model
{
    use HasFactory;
    protected $guarded = []; 


    public function client()
    {
        return $this->belongsTo(Client::class,'client_id','id');
    }

    public function products(){
        return $this->belongsToMany(Product::class,'product_order')->withPivot('quantity','price');
    }

  
}
