<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mcategoria extends Model
{
    protected $table="categoria";
    protected $primarykey="id";
    protected $fillable = [
        'descripcion','nombre','condicion','created_at','updated_at'
    ];
    public $timestamps=true;
}
