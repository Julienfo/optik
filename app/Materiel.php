<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    public $timestamps = false;
    protected $fillable = ['nom', 'reference', 'type_mat', 'qualite', 'note'];
    protected $table ="materiels";
}
