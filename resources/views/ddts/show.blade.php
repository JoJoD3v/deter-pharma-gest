@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Dettaglio DDT: {{ $ddt->numero_ddt }}</h1>
        <div class="btn-group" role="group">
            <a href="{{ route('ddts.pdf.amministratore', $ddt) }}" class="btn btn-danger" target="_blank">
                <i class="bi bi-file-pdf"></i> PDF Amministratore
            </a>
            <a href="{{ route('ddts.pdf.vettore', $ddt) }}" class="btn btn-info" target="_blank">
                <i class="bi bi-file-pdf"></i> PDF Vettore
            </a>
            <a href="{{ route('ddts.edit', $ddt) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Modifica
            </a>
            <a href="{{ route('ddts.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Torna alla lista
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Informazioni Cliente</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Cliente:</th>
                            <td>
                                @if($ddt->cliente)
                                    {{ $ddt->cliente->nome_completo }}
                                @else
                                    {{ $ddt->codice_cliente ?? 'N/D' }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>CF/P.IVA:</th>
                            <td>
                                @if($ddt->cliente)
                                    {{ $ddt->cliente->codice_fiscale ?? $ddt->cliente->partita_iva ?? 'N/D' }}
                                @else
                                    {{ $ddt->codice_fiscale_piva ?? 'N/D' }}
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Dettagli Trasporto</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Causale:</th>
                            <td>{{ $ddt->causale_trasporto ?? 'N/D' }}</td>
                        </tr>
                        <tr>
                            <th>Trasporto a cura:</th>
                            <td>{{ $ddt->trasporto_a_cura ? ucfirst($ddt->trasporto_a_cura) : 'N/D' }}</td>
                        </tr>
                        <tr>
                            <th>Data/Ora:</th>
                            <td>{{ $ddt->data_ora_trasporto ? $ddt->data_ora_trasporto->format('d/m/Y H:i') : 'N/D' }}</td>
                        </tr>
                        <tr>
                            <th>Ditta:</th>
                            <td>{{ $ddt->trasporto_ditta ?? 'N/D' }}</td>
                        </tr>
                        <tr>
                            <th>Aspetto beni:</th>
                            <td>{{ $ddt->aspetto_beni ? ucfirst(str_replace('_', ' ', $ddt->aspetto_beni)) : 'N/D' }}</td>
                        </tr>
                        <tr>
                            <th>N. Colli:</th>
                            <td>{{ $ddt->num_colli ?? 'N/D' }}</td>
                        </tr>
                        <tr>
                            <th>Peso:</th>
                            <td>{{ $ddt->peso ? $ddt->peso . ' Kg' : 'N/D' }}</td>
                        </tr>
                        <tr>
                            <th>Porto:</th>
                            <td>{{ $ddt->porto ?? 'N/D' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">Prodotti</h5>
        </div>
        <div class="card-body">
            @if($ddt->prodotti->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Codice</th>
                                <th>Nome Prodotto</th>
                                <th>Unità Misura</th>
                                <th>Quantità</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ddt->prodotti as $prodotto)
                                <tr>
                                    <td>{{ $prodotto->codice ?? '-' }}</td>
                                    <td>{{ $prodotto->nome_prodotto }}</td>
                                    <td>{{ $prodotto->unita_misura ?? '-' }}</td>
                                    <td>{{ $prodotto->quantita }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">Nessun prodotto associato.</p>
            @endif
        </div>
    </div>

    @if($ddt->annotazioni)
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Annotazioni</h5>
            </div>
            <div class="card-body">
                <p class="mb-0">{{ $ddt->annotazioni }}</p>
            </div>
        </div>
    @endif
</div>
@endsection

