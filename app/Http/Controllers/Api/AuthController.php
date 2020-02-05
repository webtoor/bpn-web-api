<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserRole;
use App\Models\ProjectLocation;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;

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


    public function login(Request $request){
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $resultUser = User::where('email', $validatedData['email'])->first();
        if($resultUser) {
            if (Hash::check($validatedData['password'], $resultUser->password)) {
                $user_role = $resultUser->role->role_id;
                $request->request->add([
                        "grant_type" => "password",
                        "client_id" => "1",
                        "client_secret" => "dK0dG45AMwufVABi2yUygEWKG0ODSQasvRfrred0",
                        "username"  => $request->json('email'),
                        "password"  => $request->json('password'),
                        "scope"     => "*"
                    ]);
                    $proxy = $request->create('/oauth/token', 'POST');
                    $response = Route::dispatch($proxy);

                    $json = (array) json_decode($response->getContent());
                    $json['user_id'] = $resultUser->id;
                    $json['email'] = $resultUser->email;
                    return $response->setContent(json_encode($json));
              
            }else{
                 // Password False
            return response()->json([
                "status" => "0",
                "error" => "invalid_credentials",
                "message" => "The user credentials were incorrect"
               ]);
            }
        }else{
            // User Not Exist
            return response()->json([
                "status" => "0",
                "error" => "invalid_credentials",
                "message" => "The user credentials were incorrect"
               ]);
        }
    }
}
