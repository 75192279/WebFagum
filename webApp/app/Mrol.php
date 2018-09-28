<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mrol extends Model
{
    protected $table = 'rol';
    protected $fillable = ['nombre','descripcion','condicion'];
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany('App\User');
    }

}