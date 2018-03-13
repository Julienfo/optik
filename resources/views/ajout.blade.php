@extends('layouts.app')

@section('content')

<form action="ajout_materiel" method="post">
    {{csrf_field()}}

    <h3>Formulaire ajouter le materiel</h3>
    {!! $errors->first('*','<p class="error_message">:message</p>') !!}

    <input placeholder="Nom du materiel" type="text" tabindex="1" name="nom" value="{{ old('nom') }}">
    <input placeholder="Reference du materiel" type="text" name="ref" value="{{ old('ref') }}">
    <input type="text" placeholder="Type du materiel" name="type" value="{{ old('type') }}">

    <select name="etat" required>
    <option>Bon</option>
    <option>Usé</option>
    <option>Cassé</option>
    </select>
    <br/>

    <p>Le materiel est il fonctionnel ?</p>
    <input type="radio" value="OUI" name="note" >OUI
    <br/>

    <input type="radio" value="NON" name="note" >NON
    <br/>
    <button name="submit" type="submit" data-submit="...Sending"> Envoyer </button>

</form>
@endsection
