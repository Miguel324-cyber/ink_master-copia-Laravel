<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class clienteModelo extends Model
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
}

