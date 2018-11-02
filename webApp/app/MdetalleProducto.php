<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MdetalleProducto extends Model
{
    protected $table = 'detalle_pago';
    protected $primaryKey = 'id';
    public $timestamps = true; 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'talla', 'color', 'modelo', 'id_producto'
        'created_at',
        'updated_at'
    ];
}
