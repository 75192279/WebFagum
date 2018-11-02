<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentrega extends Model
{
    protected $table="entrega";
    protected $primarykey="id";
    protected $fillable = [
        'id_venta','direccion', 'numero', 'adicionalinfo', 'referencia', 'ubigeo', 'encargado', 'numero_contacto', 'costo'
    ];
}
