@extends('layouts.app')

@section('content')
<style>
    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #216581 0%, #2FA4C4 50%, #60D6F4 100%);
    }
    .login-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }
    .login-logo {
        text-align: center;
        padding: 30px 20px;
        background: white;
    }
    .login-logo img {
        max-width: 200px;
        height: auto;
    }
    .login-body {
        padding: 40px;
        background: white;
    }
    .login-title {
        color: #216581;
        font-weight: 600;
        margin-bottom: 30px;
        text-align: center;
    }
    .form-control:focus {
        border-color: #2FA4C4;
        box-shadow: 0 0 0 0.25rem rgba(47, 164, 196, 0.25);
    }
    .btn-login {
        background: linear-gradient(135deg, #216581 0%, #2FA4C4 100%);
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
    }
    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(47, 164, 196, 0.4);
    }
    .form-label {
        color: #216581;
        font-weight: 500;
    }
</style>

<div class="login-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="login-card">
                    <div class="login-logo">
                        <img src="{{ asset('image/logo-deter.png') }}" alt="DeterPharma Logo">
                    </div>
                    <div class="login-body">
                        <h3 class="login-title">Accedi al Gestionale</h3>
                        
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Indirizzo Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
                                       placeholder="Inserisci la tua email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                       name="password" required autocomplete="current-password" 
                                       placeholder="Inserisci la password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" 
                                           {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Ricordami
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-login">
                                    <i class="bi bi-box-arrow-in-right"></i> Accedi
                                </button>
                            </div>

                            @if (Route::has('password.request'))
                                <div class="text-center mt-3">
                                    <a href="{{ route('password.request') }}" style="color: #2FA4C4;">
                                        Password dimenticata?
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
