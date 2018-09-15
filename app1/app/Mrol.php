<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mrol extends Model
{
    protected $table="rol";
    protected $primarykey="id";
    protected $fillable = [
        'descripcion','nombre'
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