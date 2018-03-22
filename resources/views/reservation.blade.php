@extends('layouts.app')

@section('content')

    <section class="reserve_header">

    <header class="header_reserve">
        <div class="nav_gauche">
            <a href="#">Rendre du matériel</a>
            <a href="/reservation">Réserver du matériel</a>
            <a href="#">Récap des reservations</a>
        </div>
        <div>
            <a href="{{url('/home')}}">
                <img src="img/logo.png" class="logo">
            </a>
        </div>
        <div class="nav_droite">
            <a href="/ajout">Ajouter matériel</a>
            <a href="/admin">Administrer du materiel</a>

            <a href="{{ route('logout') }}"
               onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">

                {{ Auth::user()->name }}&nbsp;&nbsp;<i class="fa fa-sign-out"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </header>

    <!-- ===== SECTION LISTE - ADMINISTRER ===== -->

    <section class="reserve_list">

        <h2> <i class="fa fa-pencil-square-o"></i> &nbsp;&nbsp;&nbsp;&nbsp; Reservation du materiel &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil-square-o"></i></h2>

        <h4> &nbsp;&nbsp;&nbsp;&nbsp; Le matériel que je reserve : &nbsp;&nbsp;&nbsp;&nbsp;</h4>

        <!-- === MATERIEL RESERVER ==== -->

        <div class="reserve_bloc">
            <div class="reserve_bloc_grid">
                <div class="add_reserve_txt">
                    <span> Pour ajouter/supprimer du materiel a réserver, appuiyer sur la touche <a style="color : #6cceec; border-bottom : solid 2px #6cceec">"entrer" </a><br> ou cliquer sur les  <a style="color : #6cceec; border-bottom : solid 2px #6cceec"> boutons</a></span><br>
                    <i class="fa fa-plus" id="plus"></i>
                    <i class="fa fa-minus"id="moins"></i>
                </div>

                <div class="reserve_bloc_input">

                    <input type="text" class="input_reserve" placeholder="Reference materiel reserver">

                </div>

                <hr style="color : #fff">

                <div class="reserve_bloc_validate">


                    <input type="text" placeholder="nom/prenom de l'étudiant">
                    <input type="text" placeholder="carte étudiante numéro">
                    <input class="reserv_valid_slide" type="submit" value="Confirmer">
                </div>



            </div>
        </div>

        <!-- === FILTRES ==== -->
        <div class="reserve_filter">
            <ul>
                <li> Type de matériel :
                    <select id="monselect">
                        <option value="valeur1">Valeur 1</option>
                        <option value="valeur2" selected>Valeur 2</option>
                        <option value="valeur3">Valeur 3</option>
                    </select>
                </li>

                <li> Qualité du matériel :
                    <select id="monselect">
                        <option value="valeur1">Valeur 1</option>
                        <option value="valeur2" selected>Valeur 2</option>
                        <option value="valeur3">Valeur 3</option>
                    </select>
                </li>
                <li> Etat du matériel :
                    <select id="monselect" placeholder="Etats du materiel">
                        <option value="valeur1">Valeur 1</option>
                        <option value="valeur2">Valeur 2</option>
                        <option value="valeur3">Valeur 3</option>
                    </select> </li>
            </ul>
        </div>


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
                            <tbody class="reserve_tbody">
                            <!-- === TABLEAU RESERVATION EXEMPLE1 ==== -->

                            <tr>
                                <td class="reserve_column1"><i class="fa fa-cart-plus"></i></td>
                                <td class="reserve_column2">Camera1</td>
                                <td class="reserve_column3">MATOS00002</td>
                                <td class="reserve_column4">Camera</td>
                                <td class="reserve_column5"> Neuf </td>
                                <td class="reserve_column6">La caméra reçu est neuve !</td>
                                <td class="reserve_column7"> <a class="open-event" title="Reserver par Jean"> Reserver </a> </td>
                            </tr>

                            <!-- === -- ==== -->

                            <tr>
                                <td class="reserve_column1"><i class="fa fa-cart-plus"></i></td>
                                <td class="reserve_column2">Camera1</td>
                                <td class="reserve_column3">MATOS00002</td>
                                <td class="reserve_column4">Camera</td>
                                <td class="reserve_column5"> Neuf </td>
                                <td class="reserve_column6">La caméra reçu est neuve !</td>
                                <td class="reserve_column7"> <a class="open-event" title="Reserver par Jean"> Reserver </a> </td>
                            </tr>

                            <tr>
                                <td class="reserve_column1"><i class="fa fa-cart-plus"></i></td>
                                <td class="reserve_column2">Camera1</td>
                                <td class="reserve_column3">MATOS00002</td>
                                <td class="reserve_column4">Camera</td>
                                <td class="reserve_column5"> Neuf </td>
                                <td class="reserve_column6">La caméra reçu est neuve !</td>
                                <td class="reserve_column7"> <a class="open-event" title="Reserver par Jean"> Reserver </a> </td>
                            </tr>
                            <tr>
                                <td class="reserve_column1"><i class="fa fa-cart-plus"></i></td>
                                <td class="reserve_column2">Camera1</td>
                                <td class="reserve_column3">MATOS00002</td>
                                <td class="reserve_column4">Camera</td>
                                <td class="reserve_column5"> Neuf </td>
                                <td class="reserve_column6">La caméra reçu est neuve !</td>
                                <td class="reserve_column7"> <a class="open-event" title="Reserver par Jean"> Reserver </a> </td>
                            </tr>

                            <tr>
                                <td class="reserve_column1"><i class="fa fa-cart-plus"></i></td>
                                <td class="reserve_column2">Camera1</td>
                                <td class="reserve_column3">MATOS00002</td>
                                <td class="reserve_column4">Camera</td>
                                <td class="reserve_column5"> Neuf </td>
                                <td class="reserve_column6">La caméra reçu est neuve !</td>
                                <td class="reserve_column7"> <a class="open-event" title="Reserver par Jean"> Reserver </a> </td>
                            </tr>
                            <tr>
                                <td class="reserve_column1"><i class="fa fa-cart-plus"></i></td>
                                <td class="reserve_column2">Camera1</td>
                                <td class="reserve_column3">MATOS00002</td>
                                <td class="reserve_column4">Camera</td>
                                <td class="reserve_column5"> Neuf </td>
                                <td class="reserve_column6">La caméra reçu est neuve !</td>
                                <td class="reserve_column7"> <a class="open-event" title="Reserver par Jean"> Reserver </a> </td>
                            </tr>

                            <tr>
                                <td class="reserve_column1"><i class="fa fa-cart-plus"></i></td>
                                <td class="reserve_column2">Camera1</td>
                                <td class="reserve_column3">MATOS00002</td>
                                <td class="reserve_column4">Camera</td>
                                <td class="reserve_column5"> Neuf </td>
                                <td class="reserve_column6">La caméra reçu est neuve !</td>
                                <td class="reserve_column7"> <a class="open-event" title="Reserver par Jean"> Reserver </a> </td>
                            </tr>
                            <tr>
                                <td class="reserve_column1"><i class="fa fa-cart-plus"></i></td>
                                <td class="reserve_column2">Camera1</td>
                                <td class="reserve_column3">MATOS00002</td>
                                <td class="reserve_column4">Camera</td>
                                <td class="reserve_column5"> Neuf </td>
                                <td class="reserve_column6">La caméra reçu est neuve !</td>
                                <td class="reserve_column7"> <a class="open-event" title="Reserver par Jean"> Reserver </a> </td>
                            </tr>

                            <tr>
                                <td class="reserve_column1"><i class="fa fa-cart-plus"></i></td>
                                <td class="reserve_column2">Camera1</td>
                                <td class="reserve_column3">MATOS00002</td>
                                <td class="reserve_column4">Camera</td>
                                <td class="reserve_column5"> Neuf </td>
                                <td class="reserve_column6">La caméra reçu est neuve !</td>
                                <td class="reserve_column7"> <a class="open-event" title="Reserver par Jean"> Reserver </a> </td>
                            </tr>

                            <tr>
                                <td class="reserve_column1"><i class="fa fa-cart-plus"></i></td>
                                <td class="reserve_column2">Camera1</td>
                                <td class="reserve_column3">MATOS00002</td>
                                <td class="reserve_column4">Camera</td>
                                <td class="reserve_column5"> Neuf </td>
                                <td class="reserve_column6">La caméra reçu est neuve !</td>
                                <td class="reserve_column7"> <a class="open-event" title="Reserver par Jean"> Reserver </a> </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="page_slider" style='display:none;'>
        <span> <i class="fa fa-pencil-square-o"></i> &nbsp;&nbsp;&nbsp;&nbsp; Voulez vous confirmer la réservation ? &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil-square-o"></i> </span><br>
        <button id="reserv_slider_yes" type="submit"><i class="fa fa-check"></i> Oui</button>
        <button id="reserv_slider_no"><i class="fa fa-times"></i> Non </button>
    </div>

</section>

@endsection