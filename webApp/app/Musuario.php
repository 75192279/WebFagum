<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Musuario extends Model
{
    protected $table="usuario";
    protected $primarykey="id";
    protected $fillable = [
        'usuario', 'correo', 'password','idPersona',,'idRol','estado'
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
