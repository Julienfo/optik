@extends('layouts.app')

@section('content')

    <section class="recap_header">

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
            <h2> <i class="fa fa-file-video-o"></i> &nbsp;&nbsp;&nbsp;&nbsp; Recapitulatif des emprunts &nbsp;&nbsp;&nbsp;<i class="fa fa-file-video-o"></i></h2>
            <form action="recapitulatif" method="get" data-pjax>
            <div class="recap_filter">
                <ul>
                    <li> Date :<br>
                        <select class="monselect" name="date_select">
                            <option value="0">+ récent au - récent</option>
                            <option value="1">- récent au + récent</option>
                        </select>
                    </li>

                    <li>
                        <button type="submit" class="admin_trier">
                            <i class="fa fa-search search-orange"></i>
                        </button>
                    </li>

                    <li class="create_type">
                        <a href="/retour" data-pjax> <u> Rendre le matériel ? </u> </a>
                    </li>
                </ul>
            </div>
            </form>

            <!-- === TABLEAU ADMIN==== -->
            <div class="recap_limiter">
                <div class="recap_container-table100">
                    <div class="recap_wrap-table100">
                        <div class="recap_table100">
                            <table class="recap_table">
                                <thead>
                                <!-- === PRES TABLEAU ==== -->
                                <tr class="recap_table100-head">
                                    <th class="recap_column1"> étudiant
                                    <th class="recap_column2"> carte de l'étudiant</th>
                                    <th class="recap_column3"> date de la reservation </th>
                                    <th class="recap_column3"> date de retour </th>
                                    <th class="recap_column4main"> Matériel réservé </th>
                                    <th class="recap_column5"> Détails </th>
                                    <th class="recap_column7"> Imprimable </th>
                                </tr>
                                </thead>
                                <tbody class="recap_tbody">

                                <!-- === TABLEAU ADMINISTRATION EXEMPLE1 ==== -->
                                @if($reservation->count() == 0)
                                    <tr><td>Aucune réservation réalisée.</td></tr>
                                @else
                                @foreach($reservation as $r)
                                        <tr id="{{$r->id}}">
                                            <td class="recap_column1">{{$r->nom_etudiant}}&nbsp;{{$r->prenom_etudiant}}</td>
                                            <td class="recap_column2">{{$r->carte_etudiant}}</td>
                                            <td class="recap_column3"> {{$r->date_debut}} </td>
                                            <td class="recap_column3"> {{$r->date_fin}} </td>
                                            <td class="recap_column4">
                                                <ul>
                                                    @foreach($materiel as $m)
                                                        @if($m->reservation_id == $r->id)
                                                            <li> {{$m->nom}} </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </td>
                                            @if($r->details == null)
                                                <td class="recap_column5"> Aucun détails. </td>
                                            @else
                                                <td class="recap_column5"> {{$r->details}} </td>
                                            @endif
                                            <td class="recap_column7" style="color: #000;"> <a href="/print/{{$r->id}}"> <i class="fa fa-print fa-2x"></i></a> </td>
                                        </tr>
                                @endforeach
                                @endif

                                <!-- === -- ==== -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </section>

@endsection