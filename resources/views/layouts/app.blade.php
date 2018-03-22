<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon -->
    <link rel="apple-touch-icon" href="img/favicon.png">
    <link rel="icon" type="image/png" href="img/favicon.png" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/connection.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery.fullPage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">

    <!-- font anwsome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Font <font-family: 'Raleway', sans-serif;> -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

</head>
<body>
    <div id="app">
        @if(Auth::id() == true)
                @yield('content')
        @else
                @yield('content')
        @endif

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/preloader.js') }}"></script>
    <script src="{{ asset('js/jquery.pjax.js') }}"></script>
    <script src="{{ asset('js/ajax_fonction.js') }}"></script>
    <script src="{{ asset('js/pajax.js') }}"></script>
    <script src="{{ asset('js/JqueryPlugin.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/Script-Ajout/ReturnToTheTop.js') }}"></script>
    <script src="{{ asset('js/Script-Ajout/scroll.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.fullPage.js') }}"></script>
    <script>
        $(document).ready(function() {
            var panelOne = $('.form-panel.two').height(),
                panelTwo = $('.form-panel.two')[0].scrollHeight;

            $('.form-panel.two').not('.form-panel.two.active').on('click', function(e) {
                e.preventDefault();

                $('.form-toggle').addClass('visible');
                $('.form-panel.one').addClass('hidden');
                $('.form-panel.two').addClass('active');
                $('.form').animate({
                    'height': panelTwo
                }, 200);
            });

            $('.form-toggle').on('click', function(e) {
                e.preventDefault();
                $(this).removeClass('visible');
                $('.form-panel.one').removeClass('hidden');
                $('.form-panel.two').removeClass('active');
                $('.form').animate({
                    'height': panelOne
                }, 200);
            });
        });
    </script>

    @if(Session::has('toastr'))
        <script>
            $(document).ready(function () {
                toastr.{{Session::get('toastr')['statut']}}('{{Session::get('toastr')['message']}}')
            });
        </script>
    @endif
</body>
</html>
