<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helper\Trait\General;

class productController extends Controller
{
    use General;

    public function index(Request $request)
    {
        $products = Product::when($request->search,function($q) use($request){
            return $q->where('name','like','%' .$request->search .'%');
        })->latest()->paginate(5);
        return view('dashboard.products.index',compact('products'));
    }

    
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create',compact('categories'));
 
    }

    
    public function store(Request $request)
    {
        $rules = ['category_id' =>'required'];
        foreach(config('translatable.locales') as $locale){
            $rules += [$locale.'.name' => 'required|unique:product_translations,name'];
            $rules += [$locale.'.description' => 'required'];
        }
        $rules += [
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required'
    ];
            $request->validate($rules);
            $filePath = "";
            if ($request->has('image')) {
                    $filePath = $this->uploadImage('products',$request->image);
            }
            $request_data = $request->except(['_token']);
            $request_data['image'] = $filePath;
            $product = Product::create($request_data);
            return redirect()->route('dashboard.products.index')->with('success',__('site.added_successfully'));

    }

   
        public function show(Product $product)
        {
            
        }

    
    public function edit(Product $product)
    {
        
    }

  
    public function update(Request $request, Product $product)
    {
        
    }

   
    public function destroy(Product $product)
    {
        
    }
}
