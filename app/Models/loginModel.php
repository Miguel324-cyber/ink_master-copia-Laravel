<?php

namespace App\Models;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loginModel extends Model implements JWTSubject
{
    use HasFactory;
    protected $table='cliente';
    public $timestamps=false;
    protected $primaryKey = 'idCliente';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'correoCliente',
        'nombreCliente',
        'apellidoCliente',
        'telefonoCliente',
        'contrasenaCliente'
    ];

    public function getJWTIdentifier(){
        return $this-> getKey();
    }
    public function getJWTCustomClaims(){
        return[];
    }
}
