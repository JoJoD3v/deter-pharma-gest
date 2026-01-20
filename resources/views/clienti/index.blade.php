@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Gestione Clienti</h1>
        <a href="{{ route('clienti.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuovo Cliente
        </a>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <i class="bi bi-funnel"></i> Filtri di Ricerca
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('clienti.index') }}">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label for="tipo_cliente" class="form-label">Tipo Cliente</label>
                        <select name="tipo_cliente" id="tipo_cliente" class="form-select">
                            <option value="">Tutti</option>
                            <option value="fisica" {{ request('tipo_cliente') == 'fisica' ? 'selected' : '' }}>Persona Fisica</option>
                            <option value="giuridica" {{ request('tipo_cliente') == 'giuridica' ? 'selected' : '' }}>Persona Giuridica</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="nome" class="form-label">Nome/Ragione Sociale</label>
                        <input type="text" name="nome" id="nome" class="form-control" 
                               value="{{ request('nome') }}" placeholder="Cerca per nome">
                    </div>
                    <div class="col-md-2">
                        <label for="codice_fiscale" class="form-label">Codice Fiscale</label>
                        <input type="text" name="codice_fiscale" id="codice_fiscale" class="form-control" 
                               value="{{ request('codice_fiscale') }}" placeholder="CF">
                    </div>
                    <div class="col-md-2">
                        <label for="partita_iva" class="form-label">Partita IVA</label>
                        <input type="text" name="partita_iva" id="partita_iva" class="form-control" 
                               value="{{ request('partita_iva') }}" placeholder="P.IVA">
                    </div>
                    <div class="col-md-2">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control" 
                               value="{{ request('telefono') }}" placeholder="Telefono">
                    </div>
                    <div class="col-md-1">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control" 
                               value="{{ request('email') }}" placeholder="Email">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Cerca
                        </button>
                        <a href="{{ route('clienti.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Reimposta
                        </a>
                        @if(request()->hasAny(['tipo_cliente', 'nome', 'codice_fiscale', 'partita_iva', 'telefono', 'email']))
                            <span class="badge bg-success ms-2">Filtri attivi</span>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($clienti->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo</th>
                                <th>Nome/Ragione Sociale</th>
                                <th>CF/P.IVA</th>
                                <th>Telefono</th>
                                <th>Email</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clienti as $cliente)
                                <tr>
                                    <td>{{ $cliente->id }}</td>
                                    <td>
                                        <span class="badge bg-{{ $cliente->tipo_cliente == 'fisica' ? 'info' : 'warning' }}">
                                            {{ ucfirst($cliente->tipo_cliente) }}
                                        </span>
                                    </td>
                                    <td>{{ $cliente->nome_completo }}</td>
                                    <td>{{ $cliente->codice_fiscale ?? $cliente->partita_iva ?? 'N/D' }}</td>
                                    <td>{{ $cliente->telefono ?? 'N/D' }}</td>
                                    <td>{{ $cliente->email ?? 'N/D' }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('clienti.show', $cliente) }}" class="btn btn-sm btn-info" title="Visualizza">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('clienti.edit', $cliente) }}" class="btn btn-sm btn-warning" title="Modifica">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('clienti.destroy', $cliente) }}" method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Sei sicuro di voler eliminare questo cliente?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Elimina">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    {{ $clienti->links() }}
                </div>
            @else
                <p class="text-muted">Nessun cliente presente. <a href="{{ route('clienti.create') }}">Crea il primo cliente</a></p>
            @endif
        </div>
    </div>
</div>
@endsection

