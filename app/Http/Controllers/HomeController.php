<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Materiel;
use App\Type;

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


    public function home()
    {
        return view('home');
    }

    public function liste()
    {
        $materiel = Materiel::all();
        return view('liste', ['materiel' => $materiel]);
    }

    public function ajout()
    {
        $types = Type::all();
        return view('ajout', ['types' => $types]);
    }

    public function ajout_materiel()
    {

        //Validation des champs

        $data = [
            'nom' => request('nom'),
            'reference' => request('ref'),
            'type_mat' => request('type'),
            'qualite' => request('etat'),
            'note' => request('note')
        ];  //nom du champ input et la valeur

        $rules = [
            'nom' => 'required',
            'reference' => 'required', 'type_mat' => 'required',
            'qualite' => 'required',
            'note' => 'required'
        ];  //nom du champ input a valider et la ou les regles

        $message = [
            'nom.required' => 'Veuillez remplir le nom.',
            'reference.required' => 'Veuillez remplir la reference.',
            'type_mat.required' => 'Veuillez remplir le type.',
            'qualite.required' => 'Veuillez remplir l\'état du matériel.',
            'note.required' => 'Veuillez remplir la fonction du matériel.'
        ];


        Validator::make($data, $rules, $message)->validate();

        Materiel::create([
            'nom' => request('nom'),
            'reference' => request('ref'),
            'type_mat' => request('type'),
            'qualite' => request('etat'),
            'note' => request('note')
        ]);

        return redirect('/home');

    }

    public function ajout_type(){

        return view('ajout_type');
    }

    public function add_type(){

        $error_message = ''; //erreur si type existe deja

        //Validation des champs

        $data = ['nom' => request('new_type')];  //nom du champ input et la valeur
        $rules = ['nom' => 'required'];  //nom du champ input a valider et la ou les regles
        $message = ['nom.required' => 'Veuillez remplir le champ type.'];


        Validator::make($data, $rules, $message)->validate();

        $type = request('new_type');
        $types = Type::where('nom', $type)->first(); //recuperer les champs de la bdd where = input,  si egale alors return false

        if($types){
            return redirect('/ajout_type');
        }else{

            Type::create([
                'nom' => $type,
            ]);

            return redirect('/ajout');
        }
    }

    public function trier()
    {
        return redirect('/liste');
    }
}
