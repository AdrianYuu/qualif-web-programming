<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('category.category', compact('categories'));
    }

    public function create()
    {
        return view('category.category-create');
    }

    public function store(Request $req)
    {
        $validationRules = [
            'name' => 'required|unique:categories|min:5|max:50|',
        ];  

        $validator = Validator::make($req->all(), $validationRules);

        if($validator->fails()){
            return redirect()->route('category_create')->withErrors($validator);
        }

        Category::create([
            'name' => $req->name,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);

        return redirect()->route('category');
    }

    public function edit($category_id)
    {
        $category = Category::findOrFail($category_id);
        return view('category.category-edit', compact('category'));
    }

    public function update(Request $req, $category_id)
    {
        $validationRules = [
            'name' => 'required|unique:categories|min:5|max:50',
        ];  

        $validator = Validator::make($req->all(), $validationRules);

        if($validator->fails()){
            return redirect()->route('category_edit', ['category_id' => $category_id])->withErrors($validator);
        }

        $category = Category::findOrFail($category_id);
        
        $category->update([
            'name' => $req->name,
        ]);

        return redirect()->route('category');
    }
}
