@extends('layouts.app')

@section('content')

    <section class="type_pageadd">

    <header class="addtype_header">
            <div class="nav_gauche">
                <a href="/retour" data-pjax>Rendre du matériel</a>
                <a href="/pre_reservation" data-pjax>Réserver du matériel</a>
                <a href="/recapitulatif" data-pjax>Récap des reservations</a>
            </div>
            <div>
                <a href="/home" data-pjax>
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

            <section class="addtype_title">
                <h2> <i class="fa fa-plus-square"></i>&nbsp;&nbsp;&nbsp;&nbsp; Ajouter et supprimer un type &nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-trash"></i></h2>

                <!-- ===== GRID ===== -->

                <div class="Addtype_grid">
                    <form action="add_type" method="post" data-pjax>
                    {{csrf_field()}}
                    <!-- ===== AJOUTER UN TYPE ===== -->
                    <div class="screen_form_addtype">
                        <span class="add_title_type">Ajouter le nouveau type</span>
                        <div class="addtype_input">
                            <input type="text" name="new_type" placeholder="Nouveau type"/>
                            {!! $errors->first('nom','<p class="error_message">:message</p>') !!}
                        </div>

                        <div class="addtype_submit">
                            <input class="addtype_submit_btn" type="submit" value="Confirmer" />

                        </div>
                    </div>
                    </form>
                    <!--===----===-->
                    @include('supp_type')
                </div>
            </section>
    </section>
@endsection