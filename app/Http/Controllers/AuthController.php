<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;
use \stdClass;

class AuthController extends Controller
{
    public function register(Request $request)
    {
       /*  $validations= request()->validate([
                'nombre'=>'required',
                'descripcion'=>'required',
                'precio'=>'required',
        ]); */
        $validations=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        if($validations->fails()){
            return response()->json($validations->errors());
        }
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
        ]);
        $token=$user->createToken('auth_token')->plainTextToken;

        return response()
        ->json(['data'=>$user,'acces_token'=>$token,'token_type'=>'Bearer',]);
    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email','password')))
        {
            return response()
              ->json(['message'=>'nombre de usuario o contraseña incorrecta'],401);
        }
        $user=User::where('email',$request['email'])->firstOrFail();
        $token=$user->createToken('auth_token')->plainTextToken;

        return response()
            ->json([
                'message'=>'hola '. $user->name,
                'accesToken'=>$token,
                'token_type'=>'Bearer',
                'user'=>$user
            ]);
    }

    public function logout(Request $request){
        $request->user()->currentAccesToken()->delete();
        return[
            'message'=> 'has cerrado sesión correctamente'
        ];
    }

}
