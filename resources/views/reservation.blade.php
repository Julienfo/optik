@extends('layouts.app')

@section('content')

    <section class="reserve_header">

    <header class="header_reserve">
        <div class="nav_gauche">
            <a href="/retour" data-pjax>Rendre du matériel</a>
            <a href="/pre_reservation" data-pjax>Réserver du matériel</a>
            <a href="/recapitulatif" data-pjax>Récap des reservations</a>
        </div>
        <div>
            <a href="{{url('/home')}}" data-pjax>
                <img src="/img/logo.png" class="logo">
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

    <section class="reserve_list">

        <h2> <i class="fa fa-pencil-square-o"></i> &nbsp;&nbsp;&nbsp;&nbsp; Reservation du materiel &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil-square-o"></i></h2>

        <h4> &nbsp;&nbsp;&nbsp;&nbsp; Le matériel que je reserve : &nbsp;&nbsp;&nbsp;&nbsp;</h4>

        <div class="main_title_rendre">
            <h3> Reservation pour <span style="color: dodgerblue;"> {{$reservation->nom_etudiant}}&nbsp;{{$reservation->prenom_etudiant}} </span> <br> Numéro de carte : <span style="color: dodgerblue;"> {{$reservation->carte_etudiant}} </span>
            </h3>
        </div>

        <!-- === MATERIEL RESERVER ==== -->
            <div class="reserve_bloc">

                <form action="/reserv_mat/{{$reservation->id}}" method="post" data-pjax>

                {{csrf_field()}}

            <div class="reserve_bloc_grid">

                <div class="add_reserve_txt">
                    <span> Pour ajouter/supprimer du materiel a réserver, appuiyer sur la touche <a style="color : #6cceec; border-bottom : solid 2px #6cceec">"entrer" </a><br> ou cliquer sur les  <a style="color : #6cceec; border-bottom : solid 2px #6cceec"> boutons</a></span><br>
                    <i class="fa fa-plus" id="plus"></i>
                    <i class="fa fa-minus" id="moins"></i>
                </div>

                <div class="reserve_bloc_input">

                    <input type="text" name="reference[]" class="input_reserve" placeholder="Reference materiel reserver"/>
                    {!! $errors->first("reference",'<br/><span class="error_message">:message</span>') !!}
                </div>

                <hr style="color : #fff"/>

                <div class="reserve_bloc_validate">

                    <input type="date" name="date_fin" placeholder="date de rendu prévue" value="{{ old('date_fin') }}"/><br/>
                    {!! $errors->first('date_fin','<span class="error_message">:message</span>') !!}<br/>


                    <input class="reserv_valid_slide" type="button" value="Confirmer"/>
                </div>

            </div>

                    <div class="page_slider" style='display:none;'>

            <span class="slider_title">
                    <i class="fa fa-pencil-square-o"></i> &nbsp;&nbsp;&nbsp;&nbsp; Voulez vous confirmer la réservation ? &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil-square-o"></i>
                </span>

                        <span class="slider_details">
                    <i class="fa fa-pencil-square-o"></i> &nbsp;&nbsp;&nbsp;&nbsp; Avez-vous emprunter des accésoires ? Si oui, lequel : &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil-square-o"></i>
                </span>

                        <div class="position_textarea">
                <textarea name="details" class="slide_area" rows="3" cols="5" placeholder="Les détails concernant la réservation : cables, carte SD, batteries en plus.."></textarea>
                        </div>
                        <br>

                        <i class="fa fa-check"></i><input type="submit" value="oui"/>
                        <button type="button" id="reserv_slider_no"><i class="fa fa-times"></i> Non </button>

                    </div>


                </form>

            </div>





        <!-- === FILTRES ==== -->
        <form action="reservation" method="get" data-pjax>
        <div class="reserve_filter">
            <ul>
                <li> Type de matériel :<br/>
                    <select id="monselect" class="monselect" name="type_select">
                        <option value="">Tous les types</option>
                        @foreach($types as $type)
                            @if($type->nom != 'Accessoires')
                                <option value="{{$type->id}}">{{$type->nom}}</option>
                            @endif
                        @endforeach
                    </select>
                </li>

                <li> Qualité du matériel :<br/>
                    <select id="monselect" class="monselect" name="qualite_select">
                        <option value="">Toutes les qualité</option>
                        @foreach($qualite as $q)
                            <option value="{{$q->qualite}}">{{$q->qualite}}</option>
                        @endforeach
                    </select>
                </li>
                <li> <button type="submit" class="admin_trier">
                        <i class="fa fa-search"></i>
                    </button>
                </li>
            </ul>
        </div>
        </form>


        <!-- === TABLEAU ADMIN==== -->
        <div class="reserve_limiter">
            <div class="reserve_container-table100">
                <div class="reserve_wrap-table100">
                    <div class="reserve_table100">
                        <table class="reserve_table">
                            <thead>
                            <!-- === PRES TABLEAU ==== -->
                            <tr class="reserve_table100-head">
                                <th class="reserve_column1"> Ajouter </th>
                                <th class="reserve_column2"> Nom du materiel</th>
                                <th class="reserve_column3"> Référence</th>
                                <th class="reserve_column4"> Type </th>
                                <th class="reserve_column5"> Qualité </th>
                                <th class="reserve_column6"> A propos </th>
                                <th class="reserve_column7"> Etats du matériel </th>
                            </tr>
                            </thead>
                            @if($materiel->count() == 0)
                                <tr><td>Aucun matèriel pour cette séléction.</td></tr>
                            @else
                                @foreach($materiel as $m)
                                    @foreach($types as $type)
                                        @if($m->type_id == $type->id)
                            <tbody class="reserve_tbody">
                            <!-- === TABLEAU RESERVATION EXEMPLE1 ==== -->

                            <tr>
                                <td class="reserve_column1" data-content="{{$m->reference}}"><i class="fa fa-cart-plus"></i></td>
                                <td class="reserve_column2">{{$m->nom}}</td>
                                <td class="reserve_column3">{{$m->reference}}</td>
                                <td class="reserve_column4">{{$type->nom}}</td>
                                <td class="reserve_column5">{{$m->qualite}}</td>
                                <td class="reserve_column6">{{$m->note}}</td>
                                <td class="reserve_column7">
                                        {{$m->etat}}
                                </td>
                            </tr>

                            <!-- === -- ==== -->
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
    </section>
</section>

@endsection