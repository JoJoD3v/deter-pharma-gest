@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Dettaglio Utente</h1>
        <div>
            <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Modifica
            </a>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Torna alla lista
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="30%">Nome:</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>Cognome:</th>
                    <td>{{ $user->cognome }}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Ruolo:</th>
                    <td>
                        <span class="badge bg-{{ $user->ruolo == 'admin' ? 'danger' : 'primary' }}">
                            {{ ucfirst($user->ruolo) }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Data Creazione:</th>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Ultimo Aggiornamento:</th>
                    <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection

