<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public $timestamps = false;
    protected $fillable = ['nom_etudiant', 'prenom_etudiant', 'carte_etudiant','date_debut', 'date_fin', 'details'];
    protected $table = "reservation";

    public function materiels(){
        return $this->hasMany('App\Materiel', 'reservation_id');
    }
}
