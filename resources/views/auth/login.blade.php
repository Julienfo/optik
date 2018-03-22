@extends('layouts.app')

@section('content')

    <!-- ===== SECTION LOGIN ===== -->

    <section class="login_content">
        <img id="login_MMI" src="img/mmi.png">

        <div class="login_centre">
            <!-- Form-->
            <div class="form">
                <div class="form-toggle"></div>
                <div class="form-panel one">
                    <div class="form-header">
                        <h1>Se connecter</h1>
                    </div>
                    <div class="form-content">
                        <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="username">Identifiant</label>
                                <input type="text" id="username" placeholder="email" name="email" value="{{ old('email') }}" required autofocus />
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
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
                                <label class="form-remember">
                                    <input type="checkbox" value="None" id="squaredFour" name="remember" {{ old('remember') ? 'checked' : '' }} checked/>Remember me
                                </label>
                            </div>
                            <div class="form-group">
                                <a class="form-recovery" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                                <a class="form-recovery" href="{{ route('register') }}">Creer un compte</a>
                            </div>
                            <div class="form-group">
                                <button type="submit">LogIn</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <img id="home_optik" src="img/logo.png">
    </section>

@endsection
