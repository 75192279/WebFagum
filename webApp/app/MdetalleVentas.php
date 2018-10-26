<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdetalleVentas extends Model
{
    protected $table="detalle_ventas";
    protected $primarykey="id";
    protected $fillable = [
        'idProducto', 'cantidad', 'precio', 'subtotal', 'idVenta', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
     public $timestamps = true;
}
