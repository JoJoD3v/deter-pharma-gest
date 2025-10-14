@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Modifica Utente</h1>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Torna alla lista
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nome *</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="cognome" class="form-label">Cognome *</label>
                        <input type="text" name="cognome" id="cognome" class="form-control @error('cognome') is-invalid @enderror" 
                               value="{{ old('cognome', $user->cognome) }}" required>
                        @error('cognome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email *</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="ruolo" class="form-label">Ruolo *</label>
                        <select name="ruolo" id="ruolo" class="form-select @error('ruolo') is-invalid @enderror" required>
                            <option value="operatore" {{ old('ruolo', $user->ruolo) == 'operatore' ? 'selected' : '' }}>Operatore</option>
                            <option value="admin" {{ old('ruolo', $user->ruolo) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('ruolo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Nuova Password (lascia vuoto per non modificare)</label>
                        <input type="password" name="password" id="password" 
                               class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Conferma Nuova Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="form-control">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Annulla</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Aggiorna Utente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

