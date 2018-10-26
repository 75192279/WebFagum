<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mventas extends Model
{
    protected $table="ventas";
    protected $primarykey="id";
    protected $fillable = [
        'estado', 'id_users', 'created_at', 'updated_at', 'tipoPago'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     public $timestamps = true;
}
