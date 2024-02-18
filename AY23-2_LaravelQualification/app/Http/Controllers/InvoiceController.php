<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        return view('invoice.invoice', compact('invoices'));
    }

    public function create($user_id)
    {
        $user = User::with('item')->findOrFail($user_id);
        $payments = Payment::all();
        return view('invoice.invoice-create', compact('user', 'payments'));
    }

    public function store(Request $req, $user_id)
    {
        $user = User::with('item')->findOrFail($user_id);

        $validationRules = [
            'payment_id' => 'required',
        ];

        $validator = Validator::make($req->all(), $validationRules);

        if($validator->fails()){
            return redirect()->route('invoice_create', ['user_id' => $user_id])->withErrors($validator);
        }

        $invoice_number = 'INV/'.rand(000000, 999999).'/'.date('Y');

        $total_price = 0;
        
        foreach($user->item as $item){
            $total_price += $item->price;
        }

        Invoice::create([
            'invoice_number' => $invoice_number,
            'user_id' => $user_id,
            'payment_id' => $req->payment_id,
            'total_price' => $total_price,
        ]);

        $items = Cart::where('user_id', '=', $user_id)->get('item_id');

        foreach($items as $i){
            $item = Item::findOrFail($i->item_id);
            Storage::delete('public/' . $item->image_url);
            Item::findOrFail($item->item_id)->delete();
        }

        return redirect()->route('home');
    }
}
