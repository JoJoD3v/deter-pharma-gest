@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Gestione Clienti</h1>
        <a href="{{ route('clienti.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuovo Cliente
        </a>
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

