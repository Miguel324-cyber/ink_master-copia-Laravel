<?php

namespace App\Http\Controllers;
use App\Models\loginModel;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class loginControlador extends Controller
{
    public function login(Request $request){
        $correoCliente = $request -> correoCliente;
        $contrasenaCliente = $request -> contrasenaCliente;

        $cliente = loginModel::where('correoCliente',$correoCliente)
                                ->first();
        if (!$cliente || !Hash::check($contrasenaCliente, $cliente->contrasenaCliente)){
            
            $data=[
                'message'=>'Cliente No Encontrado!',
                'status'=>404
            ];
            return response()->json($data,404);
        }
        $token = JWTAuth::fromUser($cliente);
        $data=[
            'message'=>'incio sesion correcto ',
            'token'=> $token,
            'cliente'=>$cliente,
            'status'=>200
        ];
        return response()->json($data,200);
    }
}