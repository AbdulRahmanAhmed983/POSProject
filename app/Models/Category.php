<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use App\Models\Product;

class Category extends Model implements TranslatableContract
{
    use HasFactory , Translatable;


     protected $table = 'categories';
     public $translatedAttributes = ['name'];
     protected $guarded = []; 

     public function products(){
        return $this->hasMany(Product::class);
     }

}
