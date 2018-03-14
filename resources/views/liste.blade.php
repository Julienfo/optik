@extends('layouts.app')

@section('content')
    <h1>Listing du materiel</h1>
    <br/>
    <form action="/trier" method="post">
        Trier par type:
        <select>
            <option value="Tous" selected>Tous les types</option>
            <option value="Caméra">Caméra</option>
            <option value="Photo">Photo</option>
            <option value="Micro">Micro</option>
        </select>
        <input type="submit" name="style" value="Trier" />
    </form>
    <br/><br/>

    <li> NOM | REFERENCE | TYPE | QUALITE </li>
    @foreach($materiel as $m)

        <li>{{$m->nom_mat}} | {{$m->reference_mat}} | {{$m->type_mat}} | {{$m->qualite}}</li>

    @endforeach

@endsection