<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_process(Request $req)
    {
        $validationRules = [
            'name' => 'required|min:5|max:50',
            'email' => 'required|unique:users|email|max:50',
            'phone' => 'required|numeric',
            'password' => 'required|min:8|max:12|alpha_num:ascii',
            'address' => 'required|min:4|max:200',
        ];  

        $validator = Validator::make($req->all(), $validationRules);

        if($validator->fails()){
            return redirect()->route('register')->withErrors($validator);
        }

        User::create([
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'password' => bcrypt($req->password),
            'address' => $req->address,
            'role_id' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
        
        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function login_process(Request $req)
    {
        $credentials = [
            'email' => $req->email,
            'password' => $req->password
        ];

        if(!Auth::attempt($credentials)){
            return redirect()->route('login')->withErrors("Invalid Account");
        }

        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index');
    }
}
