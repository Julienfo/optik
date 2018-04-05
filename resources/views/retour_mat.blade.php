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

        <!-- ===== SECTION CONTENT - RENDRE ===== -->


        <!-- === FORM RECAP DE LA RESERVATION DE L'ETUDIANT (ETAPE 2 ) ==== -->
        <form action="/retour_fin" method="post">
            {{csrf_field()}}
        <section class="camouflage">

                <div class="main_title_rendre">
                    <h3> Reservation de <span> {{$reservation->nom_etudiant}}&nbsp;{{$reservation->prenom_etudiant}} </span> <br> Numéro de carte : <span> {{$reservation->carte_etudiant}} </span> <br> Début de la reservation le <span> {{$reservation->date_debut}} </span> <br> Date de retour prévu le <span> {{$reservation->date_fin}} </span>
                    </h3>
                </div>


            <!-- === TABLEAU RENDRE ==== -->
            <div class="rendre_limiter">
                <div class="rendre_container-table100">
                    <div class="rendre_wrap-table100">
                        <div class="rendre_table100">
                            <table class="rendre_table">
                                <thead>
                                <!-- === PRES TABLEAU ==== -->
                                <tr class="rendre_table100-head">
                                    <th class="rendre_column1"> Nom du matériel
                                    <th class="rendre_column2"> Réference</th>
                                    <th class="rendre_column3"> qualité </th>
                                    <th class="rendre_column4"> note </th>
                                    <th class="rendre_column5"> rendre materiel </th>
                                    <th class="rendre_column5"> materiel perdu </th>
                                </tr>
                                </thead>
                                <tbody class="rendre_tbody">

                                <!-- === TABLEAU ADMINISTRATION EXEMPLE1 ==== -->
                                @foreach($materiel as $m)
                                <tr>
                                    <td class="rendre_column1">{{$m->nom}}</td>
                                    <td class="rendre_column2">{{$m->reference}}</td>
                                    <td class="rendre_column3"> {{$m->qualite}} </td>
                                    <td class="rendre_column4"> {{$m->note}} </td>
                                        <td class="rendre_column5">
                                            <div class="uuu">
                                                <input class="checkbox" type="checkbox" name="rendre[]" value="{{$m->id}}" checked/>
                                            </div>
                                        </td>
                                        <td class="rendre_column6">
                                            <div class="ttt">
                                                <input class="checkbox_perdu" type="checkbox" name="option[]" value="{{$m->id}}"/>
                                            </div>
                                        </td>
                                </tr>
                                @endforeach
                                <!-- === -- ==== -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rendre_tableau">
                @if($reservation->details != null)
                    <span class="rendre_tab_titre"> Le détail des accèsoires est aussi disponible :</span> <br> <br>
                    <textarea name="details" class="rendre_details" style="color: #000"> {{$reservation->details}} </textarea> <br>
                @endif
                <input class="rendre_submit_btn" type="submit" value="Rendre le matériel"/>
            </div>

        </section>
        </form>


    </section>
@endsection