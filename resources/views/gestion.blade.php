@extends('layouts.app')

@section('content')
    <section class="administrer_header">

        <!-- ===== SECTION HEADER ===== -->

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
    <!-- ===== SECTION LISTE - ADMINISTRER ===== -->

    <section class="administrer_list">
    <!-- === FILTRES ==== -->
    <h2 style="margin-bottom: 50px;"> <i class="fa fa-check-square"></i> &nbsp;&nbsp;&nbsp;&nbsp; Gestion des cartes &nbsp;&nbsp;&nbsp;<i class="fa fa-check-square"></i></h2>

        <form action="/gestion" method="get" data-pjax>
            <div class="administrer_filter">
                <input style="margin-left: 50px;" type="search" name="search" placeholder="Rechercher par nom..."/>
                <button type="submit"><i class='fa fa-search' ></i></button>
            </div>
        </form>
        <!-- === TABLEAU ADMIN==== -->
        <div class="limiter">
            <div class="container-table100">
                <div class="wrap-table100">
                    <div class="table100">
                        <table>
                            <thead>
                            <!-- === PRES TABLEAU ==== -->
                            <tr class="table100-head">
                                <th class="column1"> Nom Prénom</th>
                                <th class="column3"> Numéro de carte </th>
                                <th class="column7"> SUPPRIMER </th>
                            </tr>
                            </thead>
                            @if($reservations->count() == 0)
                                <tr><td>Aucune carte enregistrée</td></tr>
                            @else
                                @foreach($reservations as $r)
                                        <tbody>

                                        <!-- === TABLEAU ADMINISTRATION EXEMPLE1 ==== -->
                                        <tr>
                                            <td class="column1">{{$r->nom_etudiant}} {{$r->prenom_etudiant}}</td>
                                            <td class="column3">{{$r->carte_etudiant}}</td>
                                            <td class="column7_gest" data-id="{{$r->id}}">
                                                <i class="fa fa-trash-o"></i>
                                                <div class="page_slider leA" style='display:none;'>
                                                    <span class="slider_title"> <i class="fa fa-trash-o"></i> &nbsp;&nbsp;&nbsp;&nbsp; Voulez vous supprimer ce matériel ? &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-trash-o"></i> </span><br/>
                                                    <div>
                                                        <a id="gest_slider_no" class="gest_slider_no" style="color:#000; background-color: red;" data-pjax><i class="fa fa-times"></i>Non</a>
                                                    </div>
                                                    <div class="gest_slider_yes">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                @endforeach
                                @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="pin_admin">
            <img src="img/pin.png" class="admin_pin">
        </div>
    </section>
    </section>

@endsection