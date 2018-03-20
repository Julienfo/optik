@extends('layouts.app')

@section('content')
    <h1>Listing du materiel</h1>
    <br/>
    <form action="liste" method="get">

        Trier par type:
        <select name="type_select">
            <option value="Tous">Tous les types</option>
            @foreach($types as $type)
                <option value="{{$type->nom}}">{{$type->nom}}</option>
            @endforeach
        </select>
        <input type="submit" value="Trier"/>
    </form>
    <br/>
    <a href="/ajout_type">Ajouter un type +</a>&nbsp;<a href="/supp_type">supprimer un type x</a>
    <br/><br/>

    @if($materiel->count() == 0)
        <p>Aucun materiel pour ce type.</p>
    @else
        <h3> NOM | REFERENCE | TYPE | QUALITE </h3>
        @foreach($materiel as $m)
            <p>{{$m->nom}} | {{$m->reference}} | {{$m->type_mat}} | {{$m->qualite}}</p>
        @endforeach
    @endif

@endsection