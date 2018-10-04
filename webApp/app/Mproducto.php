<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mproducto extends Model
{
    protected $table="producto";
    protected $primarykey="id";
    protected $fillable = [
        'nombre', 'codigo','stockactual','stockminimo','stockmaximo', 'precio', 'descripcion', 'idUsuario', 'idCategoria','condicion','image', 'thumbnail', 'medium', 'large', 'created_at', 'updated_at'
    ];
    public $timestamps = true;
}
