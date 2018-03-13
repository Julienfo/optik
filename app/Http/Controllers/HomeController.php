<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Materiel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function ajout()
    {
        return view('ajout');
    }

    public function home()
    {
        return view('home');
    }

    public function liste()
    {
        $materiel = Materiel::all();
        return view('liste', ['materiel' => $materiel]);
    }

    public function ajout_materiel()
    {

        //Validation des champs

        $data = ['nom_mat' => request('nom'), 'reference_mat' => request('ref'), 'type_mat' => request('type'), 'qualite' => request('etat'), 'note' => request('note')];  //nom du champ input et la valeur
        $rules = ['nom_mat' => 'required', 'reference_mat' => 'required', 'type_mat' => 'required', 'qualite' => 'required', 'note' => 'required'];  //nom du champ input a valider et la ou les regles
        $message = ['*.required' => 'Veuillez remplir le(s) champ(s) manquant(s).'];


        Validator::make($data, $rules, $message)->validate();

        Materiel::create([
            'nom_mat' => request('nom'),
            'reference_mat' => request('ref'),
            'type_mat' => request('type'),
            'qualite' => request('etat'),
            'note' => request('note')
        ]);

        return redirect('/home');

    }
}
