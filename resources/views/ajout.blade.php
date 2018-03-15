@extends('layouts.app')@section('content')    <form action="ajout_materiel" method="post">        {{csrf_field()}}        <h3>Formulaire ajouter le materiel</h3><br/>        <p>Nom:</p>        <input placeholder="Nom du materiel" type="text" tabindex="1" name="nom" value="{{ old('nom') }}">        {!! $errors->first('nom','<p class="error_message">:message</p>') !!}<br/>        <p>Référence:</p>        <input placeholder="Reference du materiel" type="text" name="ref" value="{{ old('ref') }}">        {!! $errors->first('reference','<p class="error_message">:message</p>') !!}<br/>        <p>Type du matériel :</p>        @foreach( $types as $type)            <input type="radio" value="{{$type->nom}}" name="type" >{{$type->nom}}        @endforeach        <br/>        <a href="/ajout_type">Ajouter un type +</a>        {!! $errors->first('type_mat','<p class="error_message">:message</p>') !!}<br/>        <p>Etat du materiel ?</p>        <input type="radio" value="Bon" name="etat" >Bon        <input type="radio" value="Usé" name="etat" >Usé        <input type="radio" value="Cassé" name="etat" >Cassé        {!! $errors->first('qualite','<p class="error_message">:message</p>') !!}        <br/>        <p>Le materiel est il fonctionnel ?</p>        <input type="radio" value="OUI" name="note" >OUI        <br/>        <input type="radio" value="NON" name="note" >NON        {!! $errors->first('note','<p class="error_message">:message</p>') !!}        <br/>        <input name="submit" type="submit" value="Envoyer"/>    </form>@endsection