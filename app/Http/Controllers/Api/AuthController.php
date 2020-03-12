<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\UserRole;
use App\Models\ProjectLocation;
use GuzzleHttp\Client;

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
        
       $validatedData = $this->validate($request,[
            /* 'tipe_pelaksana' => 'required', */
            'pelaksana' => 'required',
            'fullname' => 'required',
            'kotakab' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'target_pbt' => 'required|numeric',
            'target_shat' => 'required|numeric',
            'target_k4' => 'required|numeric',
            'tim' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);

        try {

            $user = User::create([
                'pelaksana' => $validatedData['pelaksana'],
                'fullname' => $validatedData['fullname'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
                'status' => "0"
            ]);
            
            if($request['tipe_pelaksana'] == '2'){
                UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => 2
                ]);
            }elseif($request['tipe_pelaksana'] == '3'){
                UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => 3
                ]);
            }
          

            ProjectLocation::create([
             'user_id' => $user->id,
             'kotakab_id' => $validatedData['kotakab'],
             'kecamatan_id' => $validatedData['kecamatan'],
             'desa_id' => $validatedData['desa'],
             'target_pbt' => $validatedData['target_pbt'],
             'target_shat' => $validatedData['target_shat'],
             'target_k4' => $validatedData['target_k4'],
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
                if(($resultUser->role->role_id == '2') || ($resultUser->role->role_id == '3') ){
                    if ($resultUser->status == '1') {
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
                        //Status Belum Aktif
                        return response()->json([
                            "status" => "0",
                            "error" => "invalid_credentials",
                            "message" => "Akun Anda Belum diverifikasi, Silakan Tunggu 1x24 jam"
                        ]);
                    }
                }else{

                  // Role Validation

                    return response()->json([
                        "status" => "0",
                        "error" => "invalid_credentials",
                        "message" => "Anda memasukkan Email dan Password yang salah. Isi dengan data yang benar dan coba lagi"
                    ]);
                }
               
            }else{
                 // Password False
                return response()->json([
                    "status" => "0",
                    "error" => "invalid_credentials",
                    "message" => "Anda memasukkan Email dan Password yang salah. Isi dengan data yang benar dan coba lagi"
                ]);
            }
        }else{
            // Email Not Exist
            return response()->json([
                "status" => "0",
                "error" => "invalid_credentials",
                "message" => "Email tidak terdaftar"
            ]);
        }
    }
}
