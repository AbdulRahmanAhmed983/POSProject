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
    protected $appends = ['profit_percent'];
    protected $guarded = []; 

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function getImageAttribute($val)
    {
        return ($val !== null) ? ('images/' . $val) : "";

    }
    public  function getProfitPercentAttribute(){

        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 /$this->purchase_price;
        return number_format($profit_percent,2);   
    }

}
