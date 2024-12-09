<?php

use App\Http\Controllers\clienteControlador;
use App\Http\Controllers\loginControlador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/cliente', function(){
    return"Conexion Exitosa!";
});
 */

 Route::get('/cliente',[clienteControlador::class,'listar']);
 Route::get('/cliente/{idCliente}',[clienteControlador::class,'mostrar']);
 Route::post('/cliente',[clienteControlador::class,'agregar']);
 Route::delete('/cliente/{idCliente}',[clienteControlador::class,'eliminar']);
 Route::put('/cliente/{idCliente}',[clienteControlador::class,'modificar']); 
 Route::post('/login',[loginControlador::class,'login']);