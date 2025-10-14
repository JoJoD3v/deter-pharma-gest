@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Dettaglio Cliente</h1>
        <div>
            <a href="{{ route('clienti.edit', $cliente) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Modifica
            </a>
            <a href="{{ route('clienti.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Torna alla lista
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informazioni Generali</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Tipo Cliente:</th>
                            <td>
                                <span class="badge bg-{{ $cliente->tipo_cliente == 'fisica' ? 'info' : 'warning' }}">
                                    {{ ucfirst($cliente->tipo_cliente) }}
                                </span>
                            </td>
                        </tr>
                        @if($cliente->tipo_cliente == 'fisica')
                            <tr>
                                <th>Nome:</th>
                                <td>{{ $cliente->nome }}</td>
                            </tr>
                            <tr>
                                <th>Cognome:</th>
                                <td>{{ $cliente->cognome ?? 'N/D' }}</td>
                            </tr>
                        @else
                            <tr>
                                <th>Ragione Sociale:</th>
                                <td>{{ $cliente->ragione_sociale ?? 'N/D' }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Codice Fiscale:</th>
                            <td>{{ $cliente->codice_fiscale ?? 'N/D' }}</td>
                        </tr>
                        <tr>
                            <th>Partita IVA:</th>
                            <td>{{ $cliente->partita_iva ?? 'N/D' }}</td>
                        </tr>
                        <tr>
                            <th>Telefono:</th>
                            <td>{{ $cliente->telefono ?? 'N/D' }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $cliente->email ?? 'N/D' }}</td>
                        </tr>
                        <tr>
                            <th>Indirizzo:</th>
                            <td>{{ $cliente->indirizzo ?? 'N/D' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">DDT Associati ({{ $cliente->ddts->count() }})</h5>
                </div>
                <div class="card-body">
                    @if($cliente->ddts->count() > 0)
                        <div class="list-group">
                            @foreach($cliente->ddts->take(10) as $ddt)
                                <a href="{{ route('ddts.show', $ddt) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $ddt->numero_ddt }}</h6>
                                        <small>{{ $ddt->created_at->format('d/m/Y') }}</small>
                                    </div>
                                    <p class="mb-1">{{ $ddt->causale_trasporto ?? 'Nessuna causale' }}</p>
                                </a>
                            @endforeach
                        </div>
                        @if($cliente->ddts->count() > 10)
                            <p class="text-muted mt-2 mb-0">
                                <small>Visualizzati 10 di {{ $cliente->ddts->count() }} DDT totali</small>
                            </p>
                        @endif
                    @else
                        <p class="text-muted">Nessun DDT associato a questo cliente.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

