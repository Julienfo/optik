@extends('layouts.app')

@section('content')

<form action="#" method="post">
    <h3>Formulaire ajouter le materiel</h3>
    <fieldset>
        <input placeholder="Nom du materiel" type="text" tabindex="1" name="nom">
    </fieldset>
    <fieldset>
        <input placeholder="Reference du materiel" type="text" name="style">
    </fieldset>
    <fieldset>
        <input type="text" placeholder="Type du materiel" name="type" required>
    </fieldset>
    <fieldset>
        <select required>
            <option>Bon</option>
            <option>Usé</option>
            <option>Cassé</option>
        </select>
    </fieldset>
    <br/>
    <fieldset>
        <p>Le materiel est il fonctionnel ?</p>
        <input type="radio" name="valide" >OUI
        <br/>
        <input type="radio" name="valide" >NON
    </fieldset>
    <br/>
    <fieldset>
        <button name="submit" type="submit" data-submit="...Sending"> Envoyer </button>
    </fieldset>

    {{csrf_field()}}
</form>
@endsection
