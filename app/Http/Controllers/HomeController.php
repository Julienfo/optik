<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Materiel;
use App\Type;
use App\Reservation;
use Psr\Log\NullLogger;


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

        Materiel::create([
            'nom' => request('nom'),
            'reference' => request('ref'),
            'type_id' => request('type'),
            'note' => request('note'),
        ]);

        return redirect('/ajout')->with('toastr', ['statut' => 'success', 'message' => 'Matériel ajouté.']);

    }

    public function type(){
        $type_id = Materiel::distinct()->select('type_id')->get()->toArray();
        $all_types = Type::select('id')->get()->toArray();

        $types = Type::all();
        $tri_types = array_diff_key($all_types, $type_id);

        return view('type', ['types' => $types, 'tri_types' => $tri_types]);
    }

    public function add_type(){

        //Validation des champs

        $data = ['nom' => request('new_type')];  //nom du champ input et la valeur
        $rules = ['nom' => 'required|unique:type,nom'];  //nom du champ input a valider et la ou les regles
        $message = [
            'nom.required' => 'Veuillez remplir le champ type.',
            'nom.unique' => 'Ce type existe déjà.'
            ];


        Validator::make($data, $rules, $message)->validate();

        $type = request('new_type');
        $types = Type::where('nom', $type)->first();

        if($types){
            return back()->with('toastr', ['statut' => 'error', 'message' => 'Ce type existe déjà.']);
        }else{

            Type::create([
                'nom' => $type,
            ]);

            return back()->with('toastr', ['statut' => 'success', 'message' => 'Type ajouté.']);
        }
    }

    public function remove_type($id){

        $type = Type::where('id', $id)->first();

            if($type->id == intval($id)){
                Type::where('id', $id)->delete();
                return redirect('/type')->with('toastr', ['statut' => 'success', 'message' => 'Type supprimé.']);
            }else{
                return redirect('/type')->with('toastr', ['statut' => 'error', 'message' => 'Il y a eu un problème.']);
            }

    }


    public function admin()
    {
        $type_select = request('type_select');
        $types = Type::all();

        $qualite_select = request('qualite_select');
        $qualite = Materiel::distinct()->select('qualite')->get();

        $etat_select = request('etat_select');
        $etat = Materiel::distinct()->select('etat')->get();

        $reservations = Reservation::all();

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

        return view('admin', [
            'materiel' => $materiel,
            'types' => $types,
            'qualite' => $qualite,
            'etat' => $etat,
            'reservations' => $reservations
        ]);
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

    public function pre_reservation(){
        return view('pre_reservation');
    }

    public function pre_reserv(){
        //Validation des champs

        $data = [
            'carte_etudiant' => request('carte_etudiant')
        ];  //nom du champ input et la valeur

        $rules = [
            'carte_etudiant' => 'required|exists:reservation,carte_etudiant'
            //nom du champ input a valider et la ou les regles

        ];  //nom du champ input a valider et la ou les regles

        $message = [
            'carte_etudiant.required' => 'Veuillez remplir le numéro de carte étudiant.',
            'carte_etudiant.exists' => 'Cette étudiant n\'est pas enregistré.'
        ];


        Validator::make($data, $rules, $message)->validate();

        $carte = request('carte_etudiant');

        $reservation = Reservation::where('carte_etudiant', $carte)->first();

        if($reservation->date_debut != null){
            return back()->with('toastr', ['statut' => 'error', 'message' => 'Cette étudiant a une réservation en cours.']);
        }else{
            $id_reservation = $reservation->id;
            return redirect('/reservation/'.$id_reservation);
        }
    }

    public function reservation($id){

        $type_select = request('type_select');
        $types = Type::all();

        $qualite_select = request('qualite_select');
        $qualite = Materiel::distinct()->select('qualite')->get();

        $reservation = Reservation::where('id', $id)->first();


        if($type_select == null && $qualite_select == null){

            $materiel = Materiel::where('etat', 'Disponible')->get();

        }else{
            $materiel = Materiel::where('etat', 'Disponible')->where('type_id', $type_select)
                ->orwhere('qualite', $qualite_select)
                ->get();
        }

        if($type_select != null && $qualite_select != null){

            $materiel = Materiel::where('etat', 'Disponible')->where('type_id', $type_select)
                ->where('qualite', $qualite_select)
                ->get();

        }

        if($type_select == null && $qualite_select != null){

            $materiel = Materiel::where('etat', 'Disponible')->where('qualite', $qualite_select)
                ->get();

        }

        if($type_select != null && $qualite_select == null){

            $materiel = Materiel::where('etat', 'Disponible')->where('type_id', $type_select)
                ->get();

        }

        return view('reservation', [
            'materiel' => $materiel,
            'types' => $types,
            'qualite' => $qualite,
            'reservation' => $reservation
        ]);
    }

    public function reserv_mat($id)
    {
        $materiel_id = Materiel::where('reservation_id', $id)->first();

        if($materiel_id){
            if($materiel_id->reservation_id == $id){
                return redirect('/home')->with('toastr', ['statut' => 'error', 'message' => 'Cette étudiant a une réservation en cours.']);
            }
        }

        $date= date("Y-m-d");

        //Validation des champs

        $data = [
            'reference' => request('reference'),
            'date_fin' => request('date_fin')

        ];  //nom du champ input et la valeur

        $rules = [
            'reference' => 'required|exists:materiels,reference',
            'date_fin' => 'required'
        ];  //nom du champ input a valider et la ou les regles

        $message = [
            'reference.required' => 'Veuillez remplir la reference.',
            'reference.exists' => 'Cette reference n\'existe pas.',
            'date_fin.required' => 'Veuillez remplir la date de rendu prévu.'
        ];


        Validator::make($data, $rules, $message)->validate();

        $references = request('reference');

        foreach ($references as $reference){

            $ref_reserv = Materiel::where('reference', $reference)->where('etat', 'Réservé')->first();
            $ref_perdu = Materiel::where('reference', $reference)->where('etat', 'Perdu')->first();

            if($ref_reserv){
                return back()->with('toastr', ['statut' => 'error', 'message' => 'Ce matériel est réservé.']);
            }

            if($ref_perdu){
                return back()->with('toastr', ['statut' => 'error', 'message' => 'Ce matériel est perdu.']);
            }
        }

        Reservation::where('id', $id)->update([
            'date_debut' => $date,
            'date_fin' => request('date_fin'),
            'details' => request('details')
        ]);


        $id_reservation = Reservation::where('id', $id)->first();


        foreach ($references as $reference){

            Materiel::where('reference', $reference)->update([
                'reservation_id' => $id_reservation->id,
                'etat' => 'Réservé'
            ]);

        }

        return redirect('/home')->with('toastr', ['statut' => 'success', 'message' => 'Réservation réussie.']);
    }

    public function recapitulatif(){

        $materiel = Materiel::all();

        $date_select = request('date_select');


        if($date_select == 0){
            $reservation = Reservation::where('date_debut', '!=', null)->orderBy('date_debut', 'desc')->get();
        }else{
            $reservation = Reservation::where('date_debut', '!=', null)->get();
        }

        return view('recapitulatif', ['reservation' => $reservation, 'materiel' => $materiel]);
    }

    public function retour(){
        return view('retour');
    }

    public function retour_mat(){

        //Validation des champs

        $data = [
            'carte_etudiant' => request('carte_etudiant')
        ];  //nom du champ input et la valeur

        $rules = [
            'carte_etudiant' => 'required|exists:reservation,carte_etudiant'
            //nom du champ input a valider et la ou les regles

        ];  //nom du champ input a valider et la ou les regles

        $message = [
            'carte_etudiant.required' => 'Veuillez remplir le numéro de carte étudiant.',
            'carte_etudiant.exists' => 'Cette étudiant n\'a pas de réservation en cours.'
        ];


        Validator::make($data, $rules, $message)->validate();

        $reservation = Reservation::where('carte_etudiant', request('carte_etudiant'))->first();

        $id_reservation = $reservation->id;

        return redirect('/retour_mat/'.$id_reservation);
    }

    public function retour_mat_id($id){
        $materiel = Materiel::where('reservation_id', $id)->get();

        $reservation = Reservation::where('id', $id)->first();

        return view('retour_mat', ['materiel' => $materiel, 'reservation' => $reservation]);
    }

    public function retour_fin(){
        $rendre = request('rendre');
        $option = request('option');

        if(empty($option) && empty($rendre)) {
                return back()->with('toastr', ['statut' => 'error', 'message' => 'Aucun matériel à rendre sélectionné.']);
        }

        $materiel = Materiel::where('id', $rendre)->first();
        $materiel1 = Materiel::where('id', $option)->first();

        if(empty($rendre)){
            $id_reservation1 = $materiel1->reservation_id;
            $id = $id_reservation1;
        }

        if(empty($option)){
            $id_reservation = $materiel->reservation_id;
            $id = $id_reservation;
        }

        if(!empty($rendre)){
            $id_reservation = $materiel->reservation_id;
            $id = $id_reservation;

            foreach ($rendre as $r){
                Materiel::where('id', $r)->update([
                    'reservation_id' => null,
                    'etat' => 'Disponible'
                ]);
            }
        }


        if(!empty($option)){
            $id_reservation1 = $materiel1->reservation_id;
            $id = $id_reservation1;

            foreach ($option as $o) {
                Materiel::where('id', $o)->update([
                    'reservation_id' => null,
                    'etat' => 'Perdu'
                ]);
            }
        }


        $mat_restant_num = Materiel::where('reservation_id', $id)->count();

        if($mat_restant_num == 0){

            Reservation::where('id', $id)->update([
                'date_debut' => null,
                'date_fin' => null,
                'details' => null
            ]);
            return redirect('/home')->with('toastr', ['statut' => 'success', 'message' => 'Réservation rendu.']);

        }else{

            Reservation::where('id', $id)->update([
                'details' => request('details')
            ]);
            return redirect('/home')->with('toastr', ['statut' => 'success', 'message' => 'Matériel rendu et réservation toujours en cours.']);
        }
    }

    public function retrouve(){
        return view('retrouve');
    }

    public function retrouve_form(){

        //Validation des champs

        $data = [
            'retrouve' => request('retrouve')
        ];  //nom du champ input et la valeur

        $rules = [
            'retrouve' => 'required|exists:materiels,reference'
            //nom du champ input a valider et la ou les regles

        ];  //nom du champ input a valider et la ou les regles

        $message = [
            'retrouve.required' => 'Veuillez remplir la référence du matériel retrouvé.',
            'retrouve.exists' => 'Cette référence n\'existe pas.'
        ];


        Validator::make($data, $rules, $message)->validate();

        $retrouve = request('retrouve');

        Materiel::where('reference', $retrouve)->update([
            'etat' => 'Disponible'
        ]);

        return redirect('/home')->with('toastr', ['statut' => 'success', 'message' => 'Matériel retrouvé disponible.']);
    }

    public function ajout_carte()
    {
        return view('ajout_carte');
    }

    public function ajout_carte_etu()
    {

        //Validation des champs

        $data = [
            'nom' => request('nom'),
            'prenom' => request('prenom'),
            'carte' => request('carte')
        ];  //nom du champ input et la valeur

        $rules = [
            'nom' => 'required',
            'prenom' => 'required',
            'carte' => 'required|unique:reservation,carte_etudiant'
        ];  //nom du champ input a valider et la ou les regles

        $message = [
            'nom.required' => 'Veuillez remplir le nom.',
            'prenom.required' => 'Veuillez remplir le prénom.',
            'carte.required' => 'Veuillez remplir le numéro.',
            'carte.unique' => 'Cette personne possède une carte.'
        ];


        Validator::make($data, $rules, $message)->validate();

        Reservation::create([
            'nom_etudiant' => request('nom'),
            'prenom_etudiant' => request('prenom'),
            'carte_etudiant' => request('carte')
        ]);

        return redirect('/pre_reservation')->with('toastr', ['statut' => 'success', 'message' => 'Carte ajoutée.']);

    }

    public function gestion()
    {
        $search = request('search');

        if($search){
            $reservations = Reservation::where('nom_etudiant', 'LIKE', $search.'%')->get();
        }else{
            $reservations = Reservation::all();
        }

        return view('gestion', ['reservations' => $reservations]);
    }

    public function remove_pers($id){

        $reservation = Reservation::find($id);
        if ($reservation == false){
            return back()->with('toastr', ['statut' => 'error', 'message' => 'Il y a eu un problème.']);
        }else{
            Reservation::where('id', $id)->delete();
            return back()->with('toastr', ['statut' => 'success', 'message' => 'Carte supprimée.']);
        }
    }
}