<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

    }

    public function register(Request $request){
        return $validatedData = $request->validate([
            'pelaksana' => 'required',
            'kotakab' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'target' => 'required|numeric',
            'tim' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);
    }
}
