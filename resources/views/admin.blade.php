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
    <h2> <i class="fa fa-check-square"></i> &nbsp;&nbsp;&nbsp;&nbsp; Administration du matériel &nbsp;&nbsp;&nbsp;<i class="fa fa-check-square"></i></h2>
    <form action="admin" method="get" data-pjax>
        <div class="administrer_filter">
                <ul>
                    <li> Type de matériel :<br/>
                        <select class="monselect" name="type_select">
                            <option value="">Tous les types</option>
                            @foreach($types as $type)
                                <option value="{{$type->id}}">{{$type->nom}}</option>
                            @endforeach
                        </select>
                    </li>

                    <li> Qualité du matériel :<br/>
                        <select class="monselect" name="qualite_select">
                            <option value="">Toutes les qualité</option>
                            @foreach($qualite as $q)
                                <option value="{{$q->qualite}}">{{$q->qualite}}</option>
                            @endforeach
                        </select>
                    </li>
                    <li> Etat du matériel :<br/>
                        <select class="monselect" name="etat_select">
                            <option value="">Tous les état</option>
                            @foreach($etat as $e)
                                <option value="{{$e->etat}}">{{$e->etat}}</option>
                            @endforeach
                        </select>
                    </li>
                    <li> <button type="submit" class="admin_trier">
                            <i class="fa fa-search"></i>
                        </button>
                    </li>
                    <li class="create_type">
                        <a href="/type" data-pjax><u>Un problème avec le type ?<br/> créer / supprimer le !</u></a>&nbsp;<!--<a href="/supp_type">supprimer un type x</a>-->
                    </li>
                </ul>
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
                                <th class="column1"> Nom du materiel
                                <th class="column2"> Référence</th>
                                <th class="column3"> Type </th>
                                <th class="column4"> Qualité </th>
                                <th class="column5"> A propos </th>
                                <th class="column6"> Etats du matériel </th>
                                <th class="column7"> SUPPRIMER </th>
                            </tr>
                            </thead>
                            @if($materiel->count() == 0)
                                <tr><td>Aucun matèriel pour cette séléction.</td></tr>
                            @else
                                @foreach($materiel as $m)
                                    @foreach($types as $type)
                                        @if($m->type_id == $type->id)
                                            <tbody>

                                            <!-- === TABLEAU ADMINISTRATION EXEMPLE1 ==== -->
                                            <tr>
                                                <td class="column1">{{$m->nom}}</td>
                                                <td class="column2">{{$m->reference}}</td>
                                                <td class="column3">{{$type->nom}}</td>
                                                <td class="column4">
                                                    <select class="select_qualite" data-id="{{$m->id}}">
                                                        <option value="{{$m->qualite}}" selected>{{$m->qualite}}</option>
                                                        @if($m->qualite == 'Bon')
                                                            <option value="Usé">Usé</option>
                                                            <option value="Cassé">Cassé</option>
                                                        @endif
                                                        @if($m->qualite == 'Usé')
                                                            <option value="Bon">Bon</option>
                                                            <option value="Cassé">Cassé</option>
                                                        @endif
                                                        @if($m->qualite == 'Cassé')
                                                            <option value="Bon">Bon</option>
                                                            <option value="Usé">Usé</option>
                                                        @endif
                                                    </select>
                                                </td>
                                                <td class="column5">{{$m->note}}</td>
                                                <td class="column6">
                                                    @if($m->etat == "Réservé")
                                                        @foreach($reservations as $r)
                                                            @if($r->id == $m->reservation_id)
                                                                <a class="open-event" title="Reservé par {{$r->nom_etudiant}} {{$r->prenom_etudiant}}">{{$m->etat}}</a>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        {{$m->etat}}
                                                    @endif
                                                </td>
                                                <td class="column7" data-id="{{$m->id}}">
                                                    <i class="fa fa-trash-o"></i>
                                                    <div class="page_slider leA" style='display:none;'>
                                                        <span class="slider_title"> <i class="fa fa-trash-o"></i> &nbsp;&nbsp;&nbsp;&nbsp; Voulez vous supprimer ce matériel ? &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-trash-o"></i> </span><br/>
                                                        <div>
                                                            <a id="reserv_slider_no" class="reserv_slider_no" style="color:#000; background-color: red;" data-pjax><i class="fa fa-times"></i>Non</a>
                                                        </div>
                                                        <div class="reserv_slider_yes">
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        @endif
                                    @endforeach
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