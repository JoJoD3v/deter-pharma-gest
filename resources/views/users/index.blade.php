@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Gestione Utenti</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuovo Utente
        </a>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <i class="bi bi-funnel"></i> Filtri di Ricerca
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('users.index') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" 
                               value="{{ request('nome') }}" placeholder="Cerca per nome">
                    </div>
                    <div class="col-md-3">
                        <label for="cognome" class="form-label">Cognome</label>
                        <input type="text" name="cognome" id="cognome" class="form-control" 
                               value="{{ request('cognome') }}" placeholder="Cerca per cognome">
                    </div>
                    <div class="col-md-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control" 
                               value="{{ request('email') }}" placeholder="Cerca per email">
                    </div>
                    <div class="col-md-3">
                        <label for="ruolo" class="form-label">Ruolo</label>
                        <select name="ruolo" id="ruolo" class="form-select">
                            <option value="">Tutti i ruoli</option>
                            <option value="admin" {{ request('ruolo') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="operatore" {{ request('ruolo') == 'operatore' ? 'selected' : '' }}>Operatore</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Cerca
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Reimposta
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($users->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Cognome</th>
                                <th>Email</th>
                                <th>Ruolo</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->cognome }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge bg-{{ $user->ruolo == 'admin' ? 'danger' : 'primary' }}">
                                            {{ ucfirst($user->ruolo) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning" title="Modifica">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            @if($user->id !== auth()->id())
                                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" 
                                                      onsubmit="return confirm('Sei sicuro di voler eliminare questo utente?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Elimina">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $users->links() }}
                </div>
            @else
                <p class="text-muted">Nessun utente presente.</p>
            @endif
        </div>
    </div>
</div>
@endsection

