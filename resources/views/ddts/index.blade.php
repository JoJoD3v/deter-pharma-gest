@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Gestione DDT</h1>
        <a href="{{ route('ddts.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuovo DDT
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            @if($ddts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Numero DDT</th>
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
                                    <td><strong>{{ $ddt->numero_ddt }}</strong></td>
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

