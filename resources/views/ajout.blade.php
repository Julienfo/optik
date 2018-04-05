@extends('layouts.app')@section('content')    <section class="administrer_header">        <!-- ===== SECTION HEADER ===== -->        <header class="header_admin">            <div class="nav_gauche">                <a href="/retour" data-pjax>Rendre du matériel</a>                <a href="/pre_reservation" data-pjax>Réserver du matériel</a>                <a href="/recapitulatif" data-pjax>Récap des reservations</a>            </div>            <div>                <a href="{{ url('/home') }}" data-pjax>                    <img src="img/logo.png" class="logo">                </a>            </div>            <div class="nav_droite">                <a href="/ajout" data-pjax>Ajouter matériel</a>                <a href="/admin" data-pjax>Administrer du materiel</a>                <a href="{{ route('logout') }}"                   onclick="event.preventDefault();                   document.getElementById('logout-form').submit();" data-pjax>                    {{ Auth::user()->name }}&nbsp;&nbsp;<i class="fa fa-sign-out"></i>                </a>                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">                    @csrf                </form>            </div>        </header><!-- ===== AJOUTER DU MATOS PAGE 1 ===== --><div class="AjouterMatos_page1">    <h2> <i class="fa fa-archive"></i>&nbsp;&nbsp;&nbsp;&nbsp; Ajouter du materiel &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-archive"></i></h2>    <form action="ajout_materiel" method="post" data-pjax>    <!-- ===== GRID ===== -->    <div class="AjouterMatos_grid">        <!-- ===== GRID-TYPE ===== -->            {{csrf_field()}}            <div class="screen-form">                <span class="add_title">Ajouter du materiel (Étapes 1/3)</span>                <span class="little_title"> Préciser le nom du matériel</span>                <input placeholder="Exemple : 'Camera0001'" type="text" tabindex="1" name="nom" value="{{ old('nom') }}">                {!! $errors->first('nom','<p class="error_message">:message</p>') !!}                <span class="little_title"> Un commentaire sur le matériel ?</span>                <textarea id="txtArea" placeholder="Un commentaire ou une précision sur le matériel ?" name="note" rows="5" cols="37"></textarea>                {!! $errors->first('note','<p class="error_message">:message</p>') !!}                <span class="little_title"> Préciser le type du matériel </span>                <div class="add_type">                    <select class="addmatos_type" name="type">                        <option value="" selected>Choix type</option>                        @foreach( $types as $type)                            <option value="{{$type->id}}">{{$type->nom}}</option>                        @endforeach                    </select>                    {!! $errors->first('type_id','<p class="error_message">:message</p>') !!}<br/>                </div>                <span class="create_type_add"><a href="/type" data-pjax><u>Un problème avec le type ? creer / supprimer le !</u></a></span>            </div>            <!--===----===-->            <div class="screen-form">                <span class="add_title">Scanner et identifier le matériel <br> via la douchette (Étapes 2/3) </span>                <span class="douchette_desc">Pour utiliser la douchette, il faut vérifier qu'elle soit connecter en USB sans fil. Une fois connecté, maintenir le bouton 3 secondes avant utilisation</span>                <input placeholder="Scanner le code barre (ou ref)" type="text" name="ref" value="{{ old('ref') }}">                <br/>                {!! $errors->first('reference','<p class="error_message">:message</p>') !!}                <img src="img/barcode.png" alt="">            </div>            <!--===----===-->            <div class="screen-form">                <span class="add_title">VALIDER ET PASSER AU RECAPITULATIF<br> (Étapes 3/3) </span>                <span class="douchette_desc">Avant de passer à la suite, nous vous invitons à vérifier les valeurs que vous avez rentrer dans les champs, pour ne pas commetre d'erreurs par la suite.</span>                <input class="add_validate" name="submit" type="submit" value="Confirmer"/>                <img src="img/next.png" alt="">            </div>    </div>    </form>    <div class="add_etapes">        <img src="img/ajouter_etape1.png" alt="etape1/3">        <img src="img/ajouter_etape2.png" alt="etape1/3">        <img src="img/ajouter_etape3.png" alt="etape1/3">    </div></div>    </section>@endsection