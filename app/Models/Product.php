<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use HasFactory , Translatable;

    protected $table = 'products';
    public $translatedAttributes = ['name','description'];
    protected $guarded = []; 

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function getImageAttribute($val)
    {
        return ($val !== null) ? ('images/' . $val) : "";

    }

}
