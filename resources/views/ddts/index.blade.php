@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Gestione DDT</h1>
        <a href="{{ route('ddts.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuovo DDT
        </a>
    </div>

    <div class="card mb-3">
        <div class="card-header">
            <i class="bi bi-funnel"></i> Filtri di Ricerca
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('ddts.index') }}">
                <div class="row g-3">
                    <div class="col-md-2">
                        <label for="numero_ddt" class="form-label">Numero DDT</label>
                        <input type="text" name="numero_ddt" id="numero_ddt" class="form-control" 
                               value="{{ request('numero_ddt') }}" placeholder="es. DDT-001">
                    </div>
                    <div class="col-md-3">
                        <label for="cliente" class="form-label">Cliente</label>
                        <input type="text" name="cliente" id="cliente" class="form-control" 
                               value="{{ request('cliente') }}" placeholder="Nome o codice cliente">
                    </div>
                    <div class="col-md-3">
                        <label for="causale" class="form-label">Causale Trasporto</label>
                        <input type="text" name="causale" id="causale" class="form-control" 
                               value="{{ request('causale') }}" placeholder="Causale">
                    </div>
                    <div class="col-md-2">
                        <label for="trasporto_a_cura" class="form-label">Trasporto a cura</label>
                        <select name="trasporto_a_cura" id="trasporto_a_cura" class="form-select">
                            <option value="">Tutti</option>
                            <option value="mittente" {{ request('trasporto_a_cura') == 'mittente' ? 'selected' : '' }}>Mittente</option>
                            <option value="vettore" {{ request('trasporto_a_cura') == 'vettore' ? 'selected' : '' }}>Vettore</option>
                            <option value="destinatario" {{ request('trasporto_a_cura') == 'destinatario' ? 'selected' : '' }}>Destinatario</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="data_da" class="form-label">Data Da</label>
                        <input type="date" name="data_da" id="data_da" class="form-control" 
                               value="{{ request('data_da') }}">
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-2">
                        <label for="data_a" class="form-label">Data A</label>
                        <input type="date" name="data_a" id="data_a" class="form-control" 
                               value="{{ request('data_a') }}">
                    </div>
                    <div class="col-md-10">
                        <label class="form-label">&nbsp;</label>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i> Cerca
                            </button>
                            <a href="{{ route('ddts.index') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Reimposta
                            </a>
                            @if(request()->hasAny(['numero_ddt', 'cliente', 'causale', 'trasporto_a_cura', 'data_da', 'data_a']))
                                <span class="badge bg-success ms-2">Filtri attivi</span>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if($ddts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Numero</th>
                                <th>Cliente</th>
                                <th>Data Trasporto</th>
                                <th>Causale</th>
                                <th>Trasporto a cura</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ddts as $ddt)
                                <tr>
                                    <td><strong>{{ $ddt->numero_progressivo_formattato }}</strong></td>
                                    <td>
                                        @if($ddt->cliente)
                                            {{ $ddt->cliente->nome_completo }}
                                        @else
                                            {{ $ddt->codice_cliente ?? 'N/D' }}
                                        @endif
                                    </td>
                                    <td>{{ $ddt->data_ora_trasporto ? $ddt->data_ora_trasporto->format('d/m/Y H:i') : 'N/D' }}</td>
                                    <td>{{ $ddt->causale_trasporto ?? 'N/D' }}</td>
                                    <td>
                                        @if($ddt->trasporto_a_cura)
                                            <span class="badge bg-secondary">{{ ucfirst($ddt->trasporto_a_cura) }}</span>
                                        @else
                                            N/D
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('ddts.show', $ddt) }}" class="btn btn-sm btn-info" title="Visualizza">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('ddts.pdf.amministratore', $ddt) }}" class="btn btn-sm btn-danger" title="PDF Amministratore" target="_blank">
                                                <i class="bi bi-file-pdf"></i>
                                            </a>
                                            <a href="{{ route('ddts.pdf.vettore', $ddt) }}" class="btn btn-sm btn-primary" title="PDF Vettore" target="_blank">
                                                <i class="bi bi-file-pdf"></i>
                                            </a>
                                            <a href="{{ route('ddts.edit', $ddt) }}" class="btn btn-sm btn-warning" title="Modifica">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('ddts.destroy', $ddt) }}" method="POST" class="d-inline"
                                                  onsubmit="return confirm('Sei sicuro di voler eliminare questo DDT?');">
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
                    {{ $ddts->links() }}
                </div>
            @else
                <p class="text-muted">Nessun DDT presente. <a href="{{ route('ddts.create') }}">Crea il primo DDT</a></p>
            @endif
        </div>
    </div>
</div>
@endsection

