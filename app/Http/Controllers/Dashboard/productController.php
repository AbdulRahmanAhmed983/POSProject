<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helper\Trait\General;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
class productController extends Controller
{
    use General;

    public function index(Request $request)
    {   
        $categories = Category::all();
        $products = Product::when($request->search,function($query) use($request){
            return $query->whereTranslationLike('name','%' .$request->search .'%');
        })->when($request->category_id,function($q) use($request){
            return $q->where('category_id',$request->category_id);
        })->latest()->paginate(10);

        return view('dashboard.products.index',compact(['categories','products']));
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
            $filePath = "products/default.png";
            if ($request->has('image')) {
                    $filePath = $this->uploadImage('products',$request->image);
            }
            $request_data = $request->except(['_token']);
            $request_data['image'] = $filePath;
            $product = Product::create($request_data);
            return redirect()->route('dashboard.products.index')->with('success',__('site.added_successfully'));

    }

     
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit',compact(['product','categories']));
    }

  
    public function update(Request $request, Product $product)
    {
        $rules = ['category_id' =>'required'];
        foreach(config('translatable.locales') as $locale){
            $rules += [$locale.'.name' => ['required',Rule::unique('product_translations','name')->ignore($product->id,'product_id')]];
            $rules += [$locale.'.description' => 'required'];
        }
        $rules += [
            'purchase_price' => 'required',
            'sale_price' => 'required',
            'stock' => 'required'
    ];
            $request->validate($rules);
            $request_data = $request->all();
           if($request->image){
           if($product->image != 'default.png'){
                $path = Public_path($product->image);
                if(File::exists($path)){
                    File::delete($path);
                }               
            }
            $filePath = "";
            if ($request->has('image')) {
                    $filePath = $this->uploadImage('products',$request->image);
            }
            $request_data['image'] = $filePath;
        }
            $product->update($request_data);
            return redirect()->route('dashboard.products.index')->with('success',__('site.updated_successfully'));
    }

   
    public function destroy(Product $product)
    {
        if($product->image != 'default.png'){                 
             $path = Public_path($product->image);
             if(File::exists($path)){
                 File::delete($path);
             }
         }
                $product->delete();
                     return redirect()->route('dashboard.products.index')->with('success',__('site.deleted_successfully'));
    }
}
