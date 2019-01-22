@extends('layouts.app')

@section('content')
<section id="home" class="app profile-section">
    <div class="container login-container">
        <div class="columns">
            <div class="column card login-form is-half is-offset-one-quarter">

                <div class="card-header"><p class="card-header-title">{{ __('Login') }}</p></div>

                <div class="card-content">
                    <form class="has-text-centered" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="field">
                            <label for="email" class="label">{{ __('E-Mail Address') }}</label>

                            <div class="control">
                                <input id="" type="email" class="input {{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <label for="password" class="label">{{ __('Password') }}</label>

                            <div class="control">
                                <input id="password" type="password" class="input {{ $errors->has('password') ? ' is-danger' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="field">
                            <div class="control">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="checkbox" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>

                        <div class="field is-grouped">
                            <div class="control">
                                <button type="submit" class="button is-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <div class="control">
                                @if (Route::has('password.request'))
                                    <a class="button is-text" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection
