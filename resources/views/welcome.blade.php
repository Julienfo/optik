@extends('layouts.app')

@section('content')
    <!-- ===== PRLOADER HOME ===== -->

    <div class="loader"></div>


    <!-- ===== SECTION HOME ===== -->

    <div class="home_content">
        <a href="#" data-pjax>
            <div class="left-one">
                <h1> Section <br> élèves </h1>
            </div>
        </a>
        <a href="{{ route('login') }}" data-pjax>
            <div class="right-one">
                <h1> Section <br> administrateur </h1>
            </div>
        </a>
    </div>
    {{--<body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif
        </div>
    </body>--}}
@endsection