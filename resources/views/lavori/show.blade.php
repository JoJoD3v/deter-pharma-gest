@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Dettaglio Lavoro N° {{ $lavoro->numero_progressivo }}</h1>
        <div class="btn-group" role="group">
            <a href="{{ route('lavori.pdf.ricevuta', $lavoro) }}" class="btn btn-danger" target="_blank">
                <i class="bi bi-file-pdf"></i> Scarica Ricevuta PDF
            </a>
            <a href="{{ route('lavori.edit', $lavoro) }}" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Modifica
            </a>
            <a href="{{ route('lavori.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Torna alla lista
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="bi bi-person"></i> Informazioni Cliente
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Tipo:</th>
                            <td>
                                @if($lavoro->cliente_id)
                                    <span class="badge bg-success">
                                        <i class="bi bi-person-check"></i> Cliente Registrato
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-pencil"></i> Inserimento Manuale
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Nome Completo:</th>
                            <td><strong>{{ $lavoro->nome_completo }}</strong></td>
                        </tr>
                        <tr>
                            <th>Indirizzo:</th>
                            <td>{{ $lavoro->indirizzo_completo ?: 'Non specificato' }}</td>
                        </tr>
                        @if($lavoro->cliente_id && $lavoro->cliente)
                            <tr>
                                <th>Codice Fiscale / P.IVA:</th>
                                <td>{{ $lavoro->cliente->codice_fiscale ?? $lavoro->cliente->partita_iva }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $lavoro->cliente->email ?: 'Non specificata' }}</td>
                            </tr>
                            <tr>
                                <th>Telefono:</th>
                                <td>{{ $lavoro->cliente->telefono ?: 'Non specificato' }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="bi bi-tools"></i> Dettagli Lavoro
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Numero Progressivo:</th>
                            <td><strong class="text-primary">{{ $lavoro->numero_progressivo }}</strong></td>
                        </tr>
                        <tr>
                            <th>Data Lavoro:</th>
                            <td>
                                <i class="bi bi-calendar"></i> 
                                <strong>{{ $lavoro->data_lavoro->format('d/m/Y') }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <th>Numero Trattamento:</th>
                            <td>{{ $lavoro->numero_trattamento ?: 'Non specificato' }}</td>
                        </tr>
                        <tr>
                            <th>Tipo Ordine:</th>
                            <td>
                                @if($lavoro->tipo_ordine)
                                    <span class="badge bg-info">{{ $lavoro->tipo_ordine }}</span>
                                @else
                                    Non specificato
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Lavoro Extra:</th>
                            <td>
                                @if($lavoro->lavoro_extra)
                                    <span class="badge bg-warning text-dark"><i class="bi bi-star-fill"></i> Sì</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Lavoro Svolto:</th>
                            <td>
                                <div class="alert alert-light mb-0">
                                    {{ $lavoro->lavoro_svolto }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Registrato il:</th>
                            <td>
                                <small class="text-muted">
                                    {{ $lavoro->created_at->format('d/m/Y H:i') }}
                                </small>
                            </td>
                        </tr>
                        <tr>
                            <th>Ultima modifica:</th>
                            <td>
                                <small class="text-muted">
                                    {{ $lavoro->updated_at->format('d/m/Y H:i') }}
                                </small>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <i class="bi bi-exclamation-triangle"></i> Zona Pericolosa
                </div>
                <div class="card-body">
                    <p class="mb-3">L'eliminazione di questo lavoro è permanente e non può essere annullata.</p>
                    <form action="{{ route('lavori.destroy', $lavoro) }}" method="POST" 
                          onsubmit="return confirm('Sei ASSOLUTAMENTE sicuro di voler eliminare questo lavoro? Questa azione NON può essere annullata!');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Elimina Lavoro
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

