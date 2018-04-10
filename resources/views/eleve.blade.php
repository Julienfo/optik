@extends('layouts.app')

@section('content')

    <section class="reserve_header">

    <!-- ===== SECTION LISTE - ADMINISTRER ===== -->

    <section class="reserve_list">

        <h2 style="padding-top: 100px;"> <i class="fa fa-pencil-square-o"></i> &nbsp;&nbsp;&nbsp;&nbsp; Liste du materiel &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-pencil-square-o"></i></h2>

        <!-- === FILTRES ==== -->
        <form action="eleve" method="get" data-pjax>
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