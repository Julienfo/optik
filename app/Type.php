<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public $timestamps = false;
    protected $fillable = ['nom'];
    protected $table ="type";

    public function materiels(){
        return $this->hasMany('App\Materiel', 'type_id');
    }
}
