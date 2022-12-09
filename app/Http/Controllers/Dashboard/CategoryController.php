<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    
    public function index(Request $request)
    {
        $categories = Category::when($request->search,function($q) use($request){
            return $q->whereTranslationLike('name','%' .$request->search .'%');
        })->latest()->paginate(5);
        return view('dashboard.categories.index',compact('categories'));
    }

  
    public function create()
    {
        return view('dashboard.categories.create');
    }

   
    public function store(Request $request)
    {
        $rules = [];
        foreach(config('translatable.locales') as $locale){
            $rules += [$locale.'.name' =>['required',Rule::unique('category_translations','name')]];
        }

        $request->validate($rules);
        Category::create($request->all());
        return redirect()->route('dashboard.categories.index')->with('success',__('site.added_successfully'));

    }

  
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit',compact('category'));

    }

    
    public function update(Request $request, Category $category)
    {
        $rules = [];
        foreach(config('translatable.locales') as $locale){
            $rules += [$locale.'.name' =>['required',Rule::unique('category_translations','name')->ignore($category->id,'category_id')]];
        }

        $request->validate($rules);
           $category->update($request->all());
            return redirect()->route('dashboard.categories.index')->with('success',__('site.updated_successfully'));


    }

    
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('dashboard.categories.index')->with('success',__('site.deleted_successfully'));


    }
}
