@extends('layouts.app')

@section('content')
    <header>
        <div class="nav_gauche">
            <a href="/retour" data-pjax>Rendre du matériel</a>
            <a href="/pre_reservation" data-pjax>Réserver du matériel</a>
            <a href="/recapitulatif" data-pjax>Récap des reservations</a>
        </div>
        <div>
            <a href="{{url('/home')}}" data-pjax>
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
    <!-- ===== PAGE PRINCIPALE ===== -->
    <div class="fullpage">
        <div class="section">
            <div class="content">

                <div class="title">
                    <img src="img/mmi.png" class="logo_mmi">
                    <h3>Application pour la gestion du <br> matériel audiovisuel</h3>
                    <h4>projet de deuxième année</h4>
                </div>
                <div>
                    <img src="img/package.png" class="carton">
                </div>
            </div>
        </div>
        <!-- ===== PAGE SECONDAIRE ===== -->
        <div class="section">
            <div class="content2_bg">
                <div class="content2">

                    <a href="/pre_reservation" data-pjax>
                        <div class="index_grid" id="bloc1">
							<span>
                <h1>reserver du matériel</h1>
                <h4>Gestion de la réservation/emprunt</h4>
            </span>
                        </div>
                    </a>

                    <a href="/admin" data-pjax>
                        <div class="index_grid_midtop" id="bloc2">
							<span class="grid_txt_middle">
                <h1>Administer le matériel</h1>
                <h4>Gestion du stock et controle du matériel</h4>
            </span>
                        </div>
                    </a>
                    <a href="/retour" data-pjax>
                        <div class="index_grid" id="bloc3">
							<span class="grid_txt_right">
                <h1>Rendre le materiel emprunter</h1>
                <h4>Interface pour rendre la matériel qui a été emprunter</h4>
            </span>
                        </div>
                    </a>
                    <a href="/recapitulatif" data-pjax>
                        <div class="index_grid" id="bloc4">
							<span>
                <h1>Liste des reservations</h1>
                <h4>Aperçu de la liste des réservations en cours</h4>
            </span>
                        </div>
                    </a>
                    <a href="/gestion" data-pjax>
                        <div class="index_grid_midbottom" id="bloc5">
							<span class="grid_txt_middle">
                <h1>Gérer les cartes</h1>
                <h4> Supprimer des cartes de la base de donnée</h4>
            </span>
                        </div>
                    </a>
                    <a href="/retrouve" data-pjax>
                        <div class="index_grid" id="bloc6">
							<span class="grid_txt_right">
                <h1>Matériel perdu retrouvé</h1>
                <h4> Remettre disponible du matériel retrouvé</h4>
            </span>
                        </div>
                    </a>
                </div>
                <div>

                </div>
            </div>
        </div>

        <!-- ===== PAGE TROIS ===== -->

        <div class="section">
            <div class="content3_bg">
                <div class="content3">
                    <img src="img/screen.png" class="mockup">

                </div>
            </div>

        </div>
    </div>
@endsection
