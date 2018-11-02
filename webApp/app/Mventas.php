<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mventas extends Model
{
    protected $table="ventas";
    protected $primarykey="id";
    protected $fillable = [
        'total', 'monto_cobrar', 'tipo_comprobante', 'serie', 'numero', 'tipo_moneda', 'igv', 'gravada', 'descuento', 'estado', 'tipoPago', 'tipo_entrega', 'id_users','payment_time', 'created_at','updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     public $timestamps = true;
}
