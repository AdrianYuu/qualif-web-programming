<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.profile', compact('user'));
    }
    
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('profile.profile-edit', compact('user'));
    }

    public function update(Request $req, $user_id)
    {
        $user = User::findOrFail($user_id);

        $validationRules = [
            'name' => 'required|min:5|max:50',
            'email' => 'required|unique:users|email|max:50',
            'phone' => 'required|numeric',
            'password' => 'required|min:8|max:12|alpha_num:ascii',
            'address' => 'required|min:4|max:200',
        ];  

        $validator = Validator::make($req->all(), $validationRules);

        if($validator->fails()){
            return redirect()->route('profile_edit', ['user_id' => $user_id])->withErrors($validator);
        }

        $user->update([
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'password' => $req->password,
            'address' => $req->address,
        ]);
        
        return redirect()->route('profile', ['user_id' => $user_id]);
    }
}
