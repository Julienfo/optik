<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Materiel;
use App\Type;

class HomeController extends Controller
{
    /*/**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /*/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function welcome(){
        return view('welcome');
    }

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
            'reference' => 'required|unique:materiels,reference',
            'type_id' => 'required',
        ];  //nom du champ input a valider et la ou les regles

        $message = [
            'nom.required' => 'Veuillez remplir le nom.',
            'reference.required' => 'Veuillez remplir la reference.',
            'reference.unique' => 'Cette reference existe déjà.',
            'type_id.required' => 'Veuillez séléctionner le type.',
        ];


        Validator::make($data, $rules, $message)->validate();

        $ref_mat = Materiel::all('reference');

        if($ref_mat == request('ref')){

        }

        Materiel::create([
            'nom' => request('nom'),
            'reference' => request('ref'),
            'type_id' => request('type'),
            'note' => request('note'),
        ]);

        return redirect('/ajout')->with('toastr', ['statut' => 'success', 'message' => 'Matériel ajouté.']);

    }

    public function ajout_type(){

        return view('ajout_type');
    }

    public function add_type(){

        //Validation des champs

        $data = ['nom' => request('new_type')];  //nom du champ input et la valeur
        $rules = ['nom' => 'required|unique:type,nom'];  //nom du champ input a valider et la ou les regles
        $message = [
            'nom.required' => 'Veuillez remplir le champ type.',
            'nom.unique' => 'Ce type existe déjà.',
            ];


        Validator::make($data, $rules, $message)->validate();

        $type = request('new_type');
        $types = Type::where('nom', $type)->first(); //recuperer les champs de la bdd where = input,  si egale alors return false

        if($types){
            return redirect('/ajout_type');
        }else{

            Type::create([
                'nom' => $type,
            ]);

            return redirect('/ajout')->with('toastr', ['statut' => 'success', 'message' => 'Type ajouté.']);
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
            return back()->with('toastr', ['statut' => 'error', 'message' => 'Il y a eu un problème.']);
        }else{
            Type::where('id', $id)->delete();
            return back()->with('toastr', ['statut' => 'success', 'message' => 'Type supprimé.']);
        }


    }*/


    public function admin()
    {
        $type_select = request('type_select');
        $types = Type::all();

        $qualite_select = request('qualite_select');
        $qualite = Materiel::distinct()->select('qualite')->get();

        $etat_select = request('etat_select');
        $etat = Materiel::distinct()->select('etat')->get();

        if($type_select == null && $qualite_select == null && $etat_select == null){

            $materiel = Materiel::all();

        }else{
            $materiel = Materiel::where('type_id', $type_select)
                ->orwhere('qualite', $qualite_select)
                ->orwhere('etat', $etat_select)
                ->get();
        }

        if($type_select != null && $qualite_select != null && $etat_select != null){

            $materiel = Materiel::where('type_id', $type_select)
                ->where('qualite', $qualite_select)
                ->where('etat', $etat_select)
                ->get();

        }

        if($type_select != null && $qualite_select != null && $etat_select == null){

            $materiel = Materiel::where('type_id', $type_select)
                ->where('qualite', $qualite_select)
                ->get();

        }

        if($type_select == null && $qualite_select != null && $etat_select != null){

            $materiel = Materiel::where('qualite', $qualite_select)
                ->where('etat', $etat_select)
                ->get();

        }

        if($type_select != null && $qualite_select == null && $etat_select != null){

            $materiel = Materiel::where('type_id', $type_select)
                ->where('etat', $etat_select)
                ->get();

        }

        return view('admin', ['materiel' => $materiel, 'types' => $types, 'qualite' => $qualite, 'etat' => $etat]);
    }

    public function remove_mat($id){

        $materiel = Materiel::find($id);
        if ($materiel == false){
            return back()->with('toastr', ['statut' => 'error', 'message' => 'Il y a eu un problème.']);
        }else{
            Materiel::where('id', $id)->delete();
            return back()->with('toastr', ['statut' => 'success', 'message' => 'Matériel supprimé.']);
        }
    }

    public function change_qualite($qualite, $id){

        $materiel = Materiel::find($id);
        if ($materiel == false){
            return back();
        }else{
            $materiel->qualite = $qualite;
            $materiel->save();

            return back();
        }
    }

    public function reservation(){
        $type_select = request('type_select');
        $types = Type::all();

        $qualite_select = request('qualite_select');
        $qualite = Materiel::distinct()->select('qualite')->get();

        $etat_select = request('etat_select');
        $etat = Materiel::distinct()->select('etat')->get();

        if($type_select == null && $qualite_select == null && $etat_select == null){

            $materiel = Materiel::all();

        }else{
            $materiel = Materiel::where('type_id', $type_select)
                ->orwhere('qualite', $qualite_select)
                ->orwhere('etat', $etat_select)
                ->get();
        }

        if($type_select != null && $qualite_select != null && $etat_select != null){

            $materiel = Materiel::where('type_id', $type_select)
                ->where('qualite', $qualite_select)
                ->where('etat', $etat_select)
                ->get();

        }

        if($type_select != null && $qualite_select != null && $etat_select == null){

            $materiel = Materiel::where('type_id', $type_select)
                ->where('qualite', $qualite_select)
                ->get();

        }

        if($type_select == null && $qualite_select != null && $etat_select != null){

            $materiel = Materiel::where('qualite', $qualite_select)
                ->where('etat', $etat_select)
                ->get();

        }

        if($type_select != null && $qualite_select == null && $etat_select != null){

            $materiel = Materiel::where('type_id', $type_select)
                ->where('etat', $etat_select)
                ->get();

        }

        return view('reservation', ['materiel' => $materiel, 'types' => $types, 'qualite' => $qualite, 'etat' => $etat]);
    }
}
