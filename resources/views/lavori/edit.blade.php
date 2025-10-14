@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Modifica Lavoro #{{ $lavoro->id }}</h1>
        <a href="{{ route('lavori.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Torna alla lista
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <i class="bi bi-pencil"></i> Modifica Lavoro Svolto
        </div>
        <div class="card-body">
            <form action="{{ route('lavori.update', $lavoro) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3">
                            <i class="bi bi-person"></i> Dati Cliente
                        </h5>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="cliente_id" class="form-label">Cliente Registrato (opzionale)</label>
                        <select name="cliente_id" id="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror">
                            <option value="">-- Inserimento Manuale --</option>
                            @foreach($clienti as $cliente)
                                <option value="{{ $cliente->id }}"
                                        data-nome="{{ $cliente->tipo_cliente === 'fisica' ? $cliente->nome : $cliente->ragione_sociale }}"
                                        data-cognome="{{ $cliente->tipo_cliente === 'fisica' ? $cliente->cognome : '' }}"
                                        data-indirizzo="{{ $cliente->indirizzo }}"
                                        {{ old('cliente_id', $lavoro->cliente_id) == $cliente->id ? 'selected' : '' }}>
                                    @if($cliente->tipo_cliente === 'fisica')
                                        {{ $cliente->nome }} {{ $cliente->cognome }}
                                    @else
                                        {{ $cliente->ragione_sociale }}
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Seleziona un cliente già registrato o inserisci manualmente i dati</small>
                    </div>
                </div>

                <div class="row mb-3" id="dati-manuali">
                    <div class="col-md-4">
                        <label for="nome_cliente" class="form-label">Nome / Ragione Sociale <span class="text-danger">*</span></label>
                        <input type="text" name="nome_cliente" id="nome_cliente"
                               class="form-control @error('nome_cliente') is-invalid @enderror"
                               value="{{ old('nome_cliente', $lavoro->nome_cliente) }}" required>
                        @error('nome_cliente')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="cognome_cliente" class="form-label">Cognome</label>
                        <input type="text" name="cognome_cliente" id="cognome_cliente"
                               class="form-control @error('cognome_cliente') is-invalid @enderror"
                               value="{{ old('cognome_cliente', $lavoro->cognome_cliente) }}">
                        @error('cognome_cliente')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="indirizzo_cliente" class="form-label">Indirizzo</label>
                        <input type="text" name="indirizzo_cliente" id="indirizzo_cliente"
                               class="form-control @error('indirizzo_cliente') is-invalid @enderror"
                               value="{{ old('indirizzo_cliente', $lavoro->indirizzo_cliente) }}">
                        @error('indirizzo_cliente')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                <div class="row mb-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3">
                            <i class="bi bi-tools"></i> Dettagli Lavoro
                        </h5>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-8">
                        <label for="lavoro_svolto" class="form-label">Lavoro Svolto <span class="text-danger">*</span></label>
                        <textarea name="lavoro_svolto" id="lavoro_svolto" rows="4"
                                  class="form-control @error('lavoro_svolto') is-invalid @enderror"
                                  required>{{ old('lavoro_svolto', $lavoro->lavoro_svolto) }}</textarea>
                        @error('lavoro_svolto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Esempio: Sanificazione uffici, Disinfezione ambienti, ecc.</small>
                    </div>

                    <div class="col-md-4">
                        <label for="data_lavoro" class="form-label">Data Lavoro <span class="text-danger">*</span></label>
                        <input type="date" name="data_lavoro" id="data_lavoro"
                               class="form-control @error('data_lavoro') is-invalid @enderror"
                               value="{{ old('data_lavoro', $lavoro->data_lavoro->format('Y-m-d')) }}" required>
                        @error('data_lavoro')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Aggiorna Lavoro
                        </button>
                        <a href="{{ route('lavori.index') }}" class="btn btn-secondary">
                            <i class="bi bi-x-circle"></i> Annulla
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const clienteSelect = document.getElementById('cliente_id');
    const nomeInput = document.getElementById('nome_cliente');
    const cognomeInput = document.getElementById('cognome_cliente');
    const indirizzoInput = document.getElementById('indirizzo_cliente');
    const datiManuali = document.getElementById('dati-manuali');

    clienteSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        
        if (this.value) {
            // Cliente selezionato - compila automaticamente e disabilita campi
            nomeInput.value = selectedOption.dataset.nome || '';
            cognomeInput.value = selectedOption.dataset.cognome || '';
            indirizzoInput.value = selectedOption.dataset.indirizzo || '';
            
            nomeInput.setAttribute('readonly', true);
            cognomeInput.setAttribute('readonly', true);
            indirizzoInput.setAttribute('readonly', true);
            
            nomeInput.removeAttribute('required');
            
            datiManuali.style.opacity = '0.6';
        } else {
            // Inserimento manuale - abilita campi
            nomeInput.value = '';
            cognomeInput.value = '';
            indirizzoInput.value = '';
            
            nomeInput.removeAttribute('readonly');
            cognomeInput.removeAttribute('readonly');
            indirizzoInput.removeAttribute('readonly');
            
            nomeInput.setAttribute('required', true);
            
            datiManuali.style.opacity = '1';
        }
    });
});
</script>
@endpush
@endsection

