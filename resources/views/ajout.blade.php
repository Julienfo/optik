@extends('layouts.app')@section('content')    <form action="ajout_materiel" method="post">        {{csrf_field()}}        <h3>Formulaire ajouter le materiel</h3><br/>        {!! $errors->first('*','<p class="error_message">:message</p>') !!}        <p>Nom:</p>        <input placeholder="Nom du materiel" type="text" tabindex="1" name="nom" value="{{ old('nom') }}"><br/><br/>        <p>Référence:</p>        <input placeholder="Reference du materiel" type="text" name="ref" value="{{ old('ref') }}"><br/><br/>        <p>Type du matériel :</p>        <input type="radio" value="Caméra" name="type" >Caméra        <input type="radio" value="Photo" name="type" >Photo        <input type="radio" value="Micro" name="type" >Micro        <input type="radio" value="Lumière" name="type" >Lumière<br/>        <a href="/ajout_type">Ajouter un type +</a>        <br/><br/>        <p>Etat du materiel ?</p>        <input type="radio" value="Bon" name="etat" >Bon        <input type="radio" value="Usé" name="etat" >Usé        <input type="radio" value="Cassé" name="etat" >Cassé        <br/><br/>        <p>Le materiel est il fonctionnel ?</p>        <input type="radio" value="OUI" name="note" >OUI        <br/>        <input type="radio" value="NON" name="note" >NON        <br/><br/>        <input name="submit" type="submit" value="Envoyer"/>    </form>@endsection