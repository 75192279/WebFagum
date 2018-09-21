<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mpersona extends Model
{
    protected $table="persona";
    protected $primarykey="id";
    protected $timestamps="true";
    protected $fillable = [
        'nombre','apellidos_materno','apellido_paterno','fecha_nacimiento',
        'numero_documento','tipo_documento','genero','created_at','updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
