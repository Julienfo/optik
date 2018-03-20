@extends('layouts.app')

@section('content')
    <h1>Suppression d'un type à la base de donnée</h1>
    <br/>
    <p>Les types :</p>

    @foreach( $types as $type)
        <span>{{$type->nom}}&nbsp;<a class="delete" href="/remove_type/{{$type->id}}">x</a></span><br/>
    @endforeach
@endsection