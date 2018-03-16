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
        <input type="submit" value="Trier" />
    </form>
    <br/><br/>

    <li> NOM | REFERENCE | TYPE | QUALITE </li>


        @foreach($materiel as $m)

            <li>{{$m->nom}} | {{$m->reference}} | {{$m->type_mat}} | {{$m->qualite}}</li>

        @endforeach

@endsection