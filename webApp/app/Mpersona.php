<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mpersona extends Model
{
    protected $table="persona";
    protected $primarykey="id";
    protected $fillable = [
        'nombre','apellido_materno','apellido_paterno','fecha_nacimiento',
        'numero_documento','tipo_documento','genero','direccion','telefono','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public $timestamps = true;
}
