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
            'type_id' => request('type'),
        ];  //nom du champ input et la valeur

        $rules = [
            'nom' => 'required',
            'reference' => 'required',
            'type_id' => 'required',
        ];  //nom du champ input a valider et la ou les regles

        $message = [
            'nom.required' => 'Veuillez remplir le nom.',
            'reference.required' => 'Veuillez remplir la reference.',
            'type_id.required' => 'Veuillez séléctionner le type.',
        ];


        Validator::make($data, $rules, $message)->validate();

        Materiel::create([
            'nom' => request('nom'),
            'reference' => request('ref'),
            'type_id' => request('type'),
            'note' => request('note'),
        ]);

        return redirect('/home');

    }

    public function ajout_type(){

        return view('ajout_type');
    }

    public function add_type(){

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

    public function supp_type(){

        $types = Type::all();
        return view('supp_type', ['types' => $types]);
    }

    /*
    public function remove_type($id){

        $type = Type::find($id);
        if ($type == false){
            abort(404);
        }else{
            Type::where('id', $id)->delete();
            return back();
        }


    }*/

    public function liste()
    {
        $type_select = request('type_select');
        $types = Type::all();
        if($type_select == 'Tous' | $type_select == null){
            $materiel = Materiel::all();
        }else{
            $materiel = Materiel::where('type_mat', $type_select)->get();
        }
        return view('liste', ['materiel' => $materiel], ['types' => $types]);
    }
}
