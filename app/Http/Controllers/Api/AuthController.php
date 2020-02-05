<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserRole;
use App\Models\ProjectLocation;

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
        
       $validatedData = $request->validate([
            'pelaksana' => 'required',
            'kotakab' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'target' => 'required|numeric',
            'tim' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);

        try {

            $user = User::create([
                'pelaksana' => $validatedData['pelaksana'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            UserRole::create([
                'user_id' => $user->id,
                'role_id' => 2
            ]);

            ProjectLocation::create([
             'user_id' => $user->id,
             'kotakab_id' => $validatedData['kotakab'],
             'kecamatan_id' => $validatedData['kecamatan'],
             'desa_id' => $validatedData['desa'],
             'target' => $validatedData['target'],
             'tim' => $validatedData['tim']
            ]);

           return response()->json([
               'status' => '1',
               'message' => 'success'
           ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => '0',
                'error' => $e->getMessage()
            ]);
        }
    }
}
