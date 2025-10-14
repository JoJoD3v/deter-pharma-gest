@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Gestione Lavori</h1>
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
                                <th>ID</th>
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
                                    <td>{{ $lavoro->id }}</td>
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

