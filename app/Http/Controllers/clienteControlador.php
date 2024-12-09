<?php

namespace App\Http\Controllers;
use App\Models\clienteModelo;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class clienteControlador extends controller
{
    public function listar (){
        $cliente = clienteModelo::all();
        if ($cliente ->isEmpty()){
            $data=[
                'message'=>'No hay clientes registrados',
                'status'=>200
            ];
            return response()->json($data,404);
        }
        return response()->json($cliente,200);
    }

    //agregar cliente
    public function agregar(Request $request){
        $validacion=Validator::make($request->all(),
        [
            'idCliente'=>'Required|numeric',
            'correoCliente'=>'Required|email',
            'nombreCliente'=>'Required|min:2|max:40',
            'apellidoCliente'=>'Required|min:2|max:40',
            'telefonoCliente'=>'Required|min:2|max:15',
            'contrasenaCliente'=>'Required|min:5|max:20'
        ]);
        if($validacion->fails()){
            $data=[
                'message'=>'Error en la validacion de datos',
                'errors'=>$validacion->errors(),
                'status'=>200
            ];
            return response()->json($data,400);
        }

        $cliente = clienteModelo::create(
            [
                'idCliente'=>$request->idCliente,
                'correoCliente'=>$request->correoCliente,
                'nombreCliente'=>$request->nombreCliente,
                'apellidoCliente'=>$request->apellidoCliente,
                'telefonoCliente'=>$request->telefonoCliente,
                'contrasenaCliente'=>Hash::make($request->contrasenaCliente)
            ]
        );

        if(!$cliente){
            $data=[
                'message'=>'Error al registrar el cliente',
                'status'=>500
            ];
            return response()->json($data,500);
        }
        $data=[
            'cliente'=>$cliente,
            'status'=>201
        ];
        return response()->json($data,201);
    }

    //Listar por ID
    public function mostrar($idCliente){
        $cliente = clienteModelo::find($idCliente);
        if(!$cliente){
            $data=[
                'message'=>'Cliente No Encontrado!',
                'status'=>404
            ];
            return response()->json($data,404);
        }
        $data=[
            'cliente'=>$cliente,
            'status'=>200
        ];
        return response()->json($data,200);
    }

    //eliminar cliente
    public function eliminar($idCliente){
        $cliente = clienteModelo::find($idCliente);
        if(!$cliente){
            $data=[
                'message'=>'Cliente no encontrado',
                'status'=>404
            ];
            return response()->json($data,404);
        }
        $cliente->delete();
        $data=[
            'message'=>'Cliente eliminado',
            'status'=>200
        ];
        return response()->json($data,200);
    }

    //Modificar cliente
    public function modificar(Request $request, $idCliente){
        $cliente = clienteModelo::find($idCliente);
        if(!$cliente){
            $data=[
                'message'=>'Cliente no encontrado',
                'status'=>404
            ];
            return response()->json($data,404);
        }
        $validacion=Validator::make($request->all(),
        [
            //'idCliente'=>'Required|numeric',
            'correoCliente'=>'Required|email',
            'nombreCliente'=>'Required|min:2|max:40',
            'apellidoCliente'=>'Required|min:2|max:40',
            'telefonoCliente'=>'Required|min:2|max:15',
            'contrasenaCliente'=>'Required|min:5|max:20'
        ]);
        if($validacion->fails()){
            $data=[
                'message'=>'Error en la validacion de datos',
                'errors'=>$validacion->errors(),
                'status'=>200
            ];
            return response()->json($data,400);
        }
        //$cliente->idCliente=$request->idCliente;
        $cliente->correoCliente=$request->correoCliente;
        $cliente->nombreCliente=$request->nombreCliente;
        $cliente->apellidoCliente=$request->apellidoCliente;
        $cliente->telefonoCliente=$request->telefonoCliente;

        if ($request->has('contrasenaCliente') && !empty($request->contrasenaCliente)) {
            $cliente->contrasenaCliente = Hash::make($request->contrasenaCliente);
        }

        $cliente->save();

        $data=[
            'message'=>'Cliente modificado',
            'empleado'=>$cliente,
            'status'=>200
        ];
        return response()->json($data,200);
    }
 
}
