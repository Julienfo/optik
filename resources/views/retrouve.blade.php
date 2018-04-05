@extends('layouts.app')

@section('content')

    <section class="rendre_header">

        <header class="header_admin">
            <div class="nav_gauche">
                <a href="/retour" data-pjax>Rendre du matériel</a>
                <a href="/pre_reservation" data-pjax>Réserver du matériel</a>
                <a href="/recapitulatif" data-pjax>Récap des reservations</a>
            </div>
            <div>
                <a href="{{ url('/home') }}" data-pjax>
                    <img src="img/logo.png" class="logo">
                </a>
            </div>
            <div class="nav_droite">
                <a href="/ajout" data-pjax>Ajouter matériel</a>
                <a href="/admin" data-pjax>Administrer du materiel</a>

                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();" data-pjax>

                    {{ Auth::user()->name }}&nbsp;&nbsp;<i class="fa fa-sign-out"></i>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;" data-pjax>
                    @csrf
                </form>
            </div>
        </header>

        <!-- ===== SECTION CONTENT - RENDRE ===== -->


        <!-- === FORM NOM PRENOM ETUDIANT (ETAPE 1 ) ==== -->

        <!-- === Title Nom de l'étudiant  ==== -->
        <div class="main_title_rendre">
            <h2> <i class="fa fa-university"></i> &nbsp;&nbsp;&nbsp;&nbsp; Matériel retrouvé&nbsp;&nbsp;&nbsp;
                <i class="fa fa-university"></i>
            </h2>
        </div>

        <!-- === FORM  ==== -->
        <form action="/retrouve_form" method="post" data-pjax>
            {{csrf_field()}}
            <div class="rendre_etape1">
                <div class="form_rendre">
                    <span class="title_rendre">Référence du matériel retrouvé</span>
                    <div class="rendre_input">
                        <input type="text" name="retrouve" placeholder="Reference materiel retrouvé" value="{{old('retrouve')}}"/>
                        {!! $errors->first("retrouve",'<br/><span class="error_message">:message</span>') !!}
                    </div>

                    <div class="addtype_submit">
                        <input class="addtype_submit_btn" type="submit" value="Valider"/>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection