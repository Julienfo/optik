@extends('layouts.app')

@section('content')
    <!-- ===== SECTION LOGIN ===== -->

<section class="login_content">
    <img id="login_MMI" src="img/mmi.png">

    <div class="login_centre">
        <!-- Form-->
        <div class="form">

            <div class="form-panel one">
                <div class="form-header">
                    <h1>S'enregistrer</h1>
                </div>
                <div class="form-content">
                    <form method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="username">Identifiant</label>
                            <input type="text" id="username" placeholder="Identifiant" name="name" value="{{ old('name') }}" required autofocus/>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" placeholder="password" name="password" required />
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="cpassword">Confirmation Mot de passe</label>
                            <input type="password" id="cpassword" placeholder="confirm password" name="password_confirmation" required />
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">Adresse mail</label>
                            <input type="email" id="email" placeholder="email" name="email" value="{{ old('email') }}" required />
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <img id="home_optik" src="img/logo.png">
</section>
@endsection