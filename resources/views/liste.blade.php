@extends('layouts.app')

@section('content')
    <h1>Listing du materiel</h1>

    @foreach($materiel as $m)

        <li>{{$m->nom_mat}} | {{$m->reference_mat}} | {{$m->type_mat}} | {{$m->qualite}}</li>

    @endforeach

@endsection
