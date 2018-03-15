@extends('layouts.app')

@section('content')
    <h1>Ajout d'un type à la base de donnée</h1>
    <br/>
    <form action="add_type" method="post">
        {{csrf_field()}}
        {!! $errors->first('*','<p class="error_message">:message</p>') !!}
        <input type="text" name="new_type" placeholder="Nouveau type"/>
        <input type="submit" name="send_type" value="Envoyer" />
    </form>
@endsection