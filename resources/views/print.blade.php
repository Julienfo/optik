<style>

        section {
            font-family: Raleway;
            font-size: 12pt;
        }
        img {
            display: block;
            width: 300px;
            margin: auto;
            margin-top: 2cm;
        }
        .print_infos {
            text-align: center;
            margin-top: 2cm;
            display: grid;
            grid-template-columns : 1fr 1fr 1fr 1fr;
        }

        .print_ul {
            display: grid;
            grid-template-columns : 1fr 1fr 1fr 2fr;
        }

        .print_ul li{
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .print_details{
            margin-top: 1cm;
            text-align: center;
        }
        h1 {
            margin-top: 1cm;
            text-align: center;
        }
        ul {
            list-style: none;
            display: block;
            text-align: center;
        }

</style>
<body onload="print()">

<img src="/img/print_logo.png" class="logo">

<!-- ===== SECTION LISTE - ADMINISTRER ===== -->

<section class="print_reserve_list">

    <div class="print_infos">
        <div style="color: grey;"> <b>Nom Prénom</b> </div>
        <div style="color: grey;"> <b>Numéro de carte</b> </div>
        <div style="color: grey;"> <b>Date de début</b> </div>
        <div style="color: grey;"> <b>Date de rendu prévu</b> </div>

        <div style="color: grey;"> {{$reservation->nom_etudiant}} &nbsp; {{$reservation->prenom_etudiant}} </div>
        <div style="color: grey;"> {{$reservation->carte_etudiant}} </div>
        <div style="color: grey;"> {{$reservation->date_debut}} </div>
        <div style="color: grey;"> {{$reservation->date_fin}} </div>
    </div>


    <br>

    <h1>Liste du matériel emprunté :</h1>
    <ul class="print_ul">
        @foreach($materiel as $m)
            <li> {{$m->nom}} </li>
            <li> {{$m->reference}} </li>
            <li> {{$m->qualite}} </li>
            <li> {{$m->note}} </li>
        @endforeach
    </ul>

    <h1>Accessoires :</h1>
    <p class="print_details">{{$reservation->details}}</p>
</section>

<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

<script>

    ////////   PRINT   ////////

    $('body').click( function () {

        window.location.replace('/recapitulatif');
    });

</script>


</body>