<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public $timestamps = false;
    protected $fillable = ['date_debut', 'carte_etudiant', 'nom_etudiant', 'prenom_etudiant'];
    protected $table = "reservation";

    public function materiels(){
        return $this->hasMany('App\Materiel', 'reservation_id');
    }
}
