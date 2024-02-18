<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index($user_id)
    {
        $user = User::with('item')->findOrFail($user_id);
        return view('cart.cart', compact('user'));
    }

    public function store($item_id)
    {
        $user_id = Auth::user()->user_id;

        Cart::create([
            'user_id' => $user_id,
            'item_id' => $item_id,
        ]);

        return redirect()->route('home');
    }

    public function delete($item_id)
    {
        $item = Item::findOrFail($item_id);
        return view('cart.cart-delete', compact('item'));
    }

    public function destroy($item_id)
    {
        $user_id = Auth::user()->user_id;
        $carts = Cart::where('item_id', $item_id);
        $carts->delete();
        return redirect()->route('cart', ['user_id' => $user_id]);
    }
}
