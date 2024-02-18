<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->user_id;
        $carts = Cart::where('user_id', $user_id)->get();
        $excluded_item_id = $carts->pluck('item_id');
        $items = Item::whereNotIn('item_id', $excluded_item_id)->paginate(8);
        $categories = Category::all();

        return view('home', compact('items', 'categories'));
    }

    public function search(Request $req)
    {
        $user_id = Auth::user()->user_id;
        $carts = Cart::where('user_id', $user_id)->get();
        $excluded_item_id = $carts->pluck('item_id');

        $items = Item::where('name', 'LIKE', '%'.$req->search.'%')
                      ->whereNotIn('item_id', $excluded_item_id) 
                      ->paginate(8);

        return view('home', compact('items'));
    }

    public function detail($item_id)
    {
        $item = Item::findOrFail($item_id);
        return view('item.item-detail', compact('item'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('item.item-create', compact('categories'));
    }

    public function store(Request $req)
    {
        $validationRules = [
            'name' => 'required|unique:items|min:5|max:50',
            'category_id' => 'required',
            'price' => 'required|min:1|numeric',
            'description' => 'required|min:5|max:200',
            'image' => 'required|mimes:jpg,png,jpeg', 
        ];

        $validator = Validator::make($req->all(), $validationRules);

        if($validator->fails()){
            return redirect()->route('item_create')->withErrors($validator);
        }

        $file = $req->file('image');
        $file_extension = $req->file('image')->getClientOriginalExtension();
        $image_name = $req->name . "." . $file_extension;
        $image_url = 'images/' . $image_name;

        Storage::putFileAs('public/images', $file, $image_name);

        Item::create([
            'name' => $req->name,
            'category_id' => $req->category_id,
            'price' => $req->price,
            'description' => $req->description,
            'image_url' => $image_url,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        return redirect()->route('home');
    }

    public function edit($item_id)
    {
        $item = Item::findOrFail($item_id);
        $categories = Category::where('category_id', '!=', $item->category->category_id)->get();
        return view('item.item-edit', compact('item', 'categories')); 
    }

    public function update(Request $req, $item_id)
    {
        $item = Item::findOrFail($item_id);

        $validationRules = [
            'name' => 'required|unique:items|min:5|max:50',
            'category_id' => 'required',
            'price' => 'required|min:1|numeric',
            'description' => 'required|min:5|max:200',
            'image' => '|mimes:jpg,png,jpeg', 
        ];

        $validator = Validator::make($req->all(), $validationRules);

        if($validator->fails()){
            return redirect()->route('item_edit', ['item_id' => $item_id])->withErrors($validator);
        }
        
        $old_image_url = $item->image_url;

        if($req->file('image')){
            Storage::delete('public/' . $old_image_url);
            
            $file = $req->file('image');
            $file_extension = $req->file('image')->getClientOriginalExtension();
            $image_name = $req->name . "." . $file_extension;
            $image_url = 'images/' . $image_name;

            Storage::putFileAs('public/images', $file, $image_name);
        } else{
            $file_extension = pathinfo('public/' . $item->image_url, PATHINFO_EXTENSION);
            $image_name = $req->name . "." . $file_extension;
            $image_url = 'images/' . $image_name;

            Storage::move('public/' . $old_image_url, 'public/' . $image_url);
        }

        $item->update([
            'name' => $req->name,
            'category_id' => $req->category_id,
            'price' => $req->price,
            'description' => $req->description,
            'image_url' => $image_url,
        ]);
         
        return redirect()->route('item_detail', ['item_id' => $item_id]);
    }

    public function delete($item_id)
    {
        $item = Item::findOrFail($item_id);
        return view('item.item-delete', compact('item'));
    }

    public function destroy($item_id)
    {
        $item = Item::findOrFail($item_id);
        Storage::delete('public/' . $item->image_url);
        $item->delete();
        return redirect()->route('home');
    }
}
