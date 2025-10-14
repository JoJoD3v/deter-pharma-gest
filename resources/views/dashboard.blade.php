@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h2 mb-4">Dashboard</h1>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white mb-3" style="background: linear-gradient(135deg, #216581 0%, #2FA4C4 100%); border: none;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Utenti</h5>
                            <h2 class="mb-0">{{ $totalUsers }}</h2>
                        </div>
                        <div>
                            <i class="bi bi-people" style="font-size: 3rem; opacity: 0.8;"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="background-color: rgba(255,255,255,0.1); border-top: 1px solid rgba(255,255,255,0.2);">
                    <a href="{{ route('users.index') }}" class="text-white text-decoration-none">
                        Visualizza tutti <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white mb-3" style="background: linear-gradient(135deg, #2FA4C4 0%, #41B7D1 100%); border: none;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Clienti</h5>
                            <h2 class="mb-0">{{ $totalClienti }}</h2>
                        </div>
                        <div>
                            <i class="bi bi-person-vcard" style="font-size: 3rem; opacity: 0.8;"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="background-color: rgba(255,255,255,0.1); border-top: 1px solid rgba(255,255,255,0.2);">
                    <a href="{{ route('clienti.index') }}" class="text-white text-decoration-none">
                        Visualizza tutti <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white mb-3" style="background: linear-gradient(135deg, #41B7D1 0%, #60D6F4 100%); border: none;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">DDT</h5>
                            <h2 class="mb-0">{{ $totalDDT }}</h2>
                        </div>
                        <div>
                            <i class="bi bi-file-earmark-text" style="font-size: 3rem; opacity: 0.8;"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="background-color: rgba(255,255,255,0.1); border-top: 1px solid rgba(255,255,255,0.2);">
                    <a href="{{ route('ddts.index') }}" class="text-white text-decoration-none">
                        Visualizza tutti <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white mb-3" style="background: linear-gradient(135deg, #60D6F4 0%, #98DFEC 100%); border: none;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Lavori</h5>
                            <h2 class="mb-0">{{ $totalLavori }}</h2>
                        </div>
                        <div>
                            <i class="bi bi-tools" style="font-size: 3rem; opacity: 0.8;"></i>
                        </div>
                    </div>
                </div>
                <div class="card-footer" style="background-color: rgba(255,255,255,0.1); border-top: 1px solid rgba(255,255,255,0.2);">
                    <a href="{{ route('lavori.index') }}" class="text-white text-decoration-none">
                        Visualizza tutti <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Ultimi DDT Creati</h5>
                </div>
                <div class="card-body">
                    @if($recentDDT->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Numero DDT</th>
                                        <th>Cliente</th>
                                        <th>Data Trasporto</th>
                                        <th>Causale</th>
                                        <th>Azioni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentDDT as $ddt)
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
                                                <a href="{{ route('ddts.show', $ddt) }}" class="btn btn-sm btn-info">
                                                    <i class="bi bi-eye"></i> Visualizza
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">Nessun DDT presente nel sistema.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

