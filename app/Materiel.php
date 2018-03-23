<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    public $timestamps = false;
    protected $fillable = ['nom', 'reference', 'qualite', 'note', 'type_id', 'reservation_id'];
    protected $table ="materiels";

    public function type(){
        return $this->belongsTo('App\Type', 'type_id');
    }

    public function reservation(){
        return $this->belongsTo('App\Reservation', 'reservation_id');
    }
}
