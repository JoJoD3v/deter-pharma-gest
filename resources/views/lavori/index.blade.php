@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Gestione Rapportini</h1>
        <a href="{{ route('lavori.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuovo Lavoro
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card mb-3">
        <div class="card-header">
            <i class="bi bi-funnel"></i> Filtri di Ricerca
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('lavori.index') }}">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label for="numero_ordine" class="form-label">N° Ordine (ID)</label>
                        <input type="number" name="numero_ordine" id="numero_ordine" class="form-control" 
                               value="{{ request('numero_ordine') }}" placeholder="es. 1">
                    </div>
                    <div class="col-md-3">
                        <label for="cliente" class="form-label">Cliente</label>
                        <input type="text" name="cliente" id="cliente" class="form-control" 
                               value="{{ request('cliente') }}" placeholder="Nome o ragione sociale">
                    </div>
                    <div class="col-md-2">
                        <label for="data_da" class="form-label">Data Da</label>
                        <input type="date" name="data_da" id="data_da" class="form-control" 
                               value="{{ request('data_da') }}">
                    </div>
                    <div class="col-md-2">
                        <label for="data_a" class="form-label">Data A</label>
                        <input type="date" name="data_a" id="data_a" class="form-control" 
                               value="{{ request('data_a') }}">
                    </div>
                    <div class="col-md-2">
                        <label for="tipo_ordine" class="form-label">Tipo Ordine</label>
                        <select name="tipo_ordine" id="tipo_ordine" class="form-select">
                            <option value="">Tutti</option>
                            <option value="Contratto" {{ request('tipo_ordine') == 'Contratto' ? 'selected' : '' }}>Contratto</option>
                            <option value="Email" {{ request('tipo_ordine') == 'Email' ? 'selected' : '' }}>Email</option>
                            <option value="Telefonico" {{ request('tipo_ordine') == 'Telefonico' ? 'selected' : '' }}>Telefonico</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label for="lavoro_extra" class="form-label">Extra</label>
                        <select name="lavoro_extra" id="lavoro_extra" class="form-select">
                            <option value="">Tutti</option>
                            <option value="1" {{ request('lavoro_extra') == '1' ? 'selected' : '' }}>Sì</option>
                            <option value="0" {{ request('lavoro_extra') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Cerca
                        </button>
                        <a href="{{ route('lavori.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Reimposta
                        </a>
                        @if(request()->hasAny(['numero_ordine', 'cliente', 'data_da', 'data_a', 'tipo_ordine', 'lavoro_extra']))
                            <span class="badge bg-success ms-2">Filtri attivi</span>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="bi bi-list-ul"></i> Lista Lavori Svolti
        </div>
        <div class="card-body">
            @if($lavori->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>N° Ordine</th>
                                <th>Cliente</th>
                                <th>Lavoro Svolto</th>
                                <th>Data Lavoro</th>
                                <th>Registrato il</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lavori as $lavoro)
                                <tr>
                                    <td><strong>{{ $lavoro->numero_ordine }}</strong></td>
                                    <td>
                                        <strong>{{ $lavoro->nome_completo }}</strong>
                                        @if($lavoro->cliente_id)
                                            <br><small class="text-muted">
                                                <i class="bi bi-person-check"></i> Cliente registrato
                                            </small>
                                        @endif
                                    </td>
                                    <td>
                                        {{ Str::limit($lavoro->lavoro_svolto, 50) }}
                                    </td>
                                    <td>
                                        <i class="bi bi-calendar"></i> 
                                        {{ $lavoro->data_lavoro->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $lavoro->created_at->format('d/m/Y H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('lavori.show', $lavoro) }}" class="btn btn-sm btn-info" title="Visualizza">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('lavori.pdf.ricevuta', $lavoro) }}" class="btn btn-sm btn-danger" title="Scarica Ricevuta PDF" target="_blank">
                                                <i class="bi bi-file-pdf"></i>
                                            </a>
                                            <a href="{{ route('lavori.edit', $lavoro) }}" class="btn btn-sm btn-warning" title="Modifica">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('lavori.destroy', $lavoro) }}" method="POST" class="d-inline" 
                                                  onsubmit="return confirm('Sei sicuro di voler eliminare questo lavoro?');">
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
                    {{ $lavori->links() }}
                </div>
            @else
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Nessun lavoro registrato. 
                    <a href="{{ route('lavori.create') }}">Crea il primo lavoro</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

