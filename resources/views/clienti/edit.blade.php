@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Modifica Cliente</h1>
        <a href="{{ route('clienti.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Torna alla lista
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('clienti.update', $cliente) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="tipo_cliente" class="form-label">Tipo Cliente *</label>
                        <select name="tipo_cliente" id="tipo_cliente" class="form-select @error('tipo_cliente') is-invalid @enderror" required>
                            <option value="fisica" {{ old('tipo_cliente', $cliente->tipo_cliente) == 'fisica' ? 'selected' : '' }}>Persona Fisica</option>
                            <option value="giuridica" {{ old('tipo_cliente', $cliente->tipo_cliente) == 'giuridica' ? 'selected' : '' }}>Persona Giuridica</option>
                        </select>
                        @error('tipo_cliente')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div id="persona-fisica-fields" style="display: {{ old('tipo_cliente', $cliente->tipo_cliente) == 'fisica' ? 'block' : 'none' }}">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nome" class="form-label">Nome *</label>
                            <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror" 
                                   value="{{ old('nome', $cliente->nome) }}" required>
                            @error('nome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="cognome" class="form-label">Cognome</label>
                            <input type="text" name="cognome" id="cognome" class="form-control @error('cognome') is-invalid @enderror" 
                                   value="{{ old('cognome', $cliente->cognome) }}">
                            @error('cognome')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div id="persona-giuridica-fields" style="display: {{ old('tipo_cliente', $cliente->tipo_cliente) == 'giuridica' ? 'block' : 'none' }}">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="ragione_sociale" class="form-label">Ragione Sociale</label>
                            <input type="text" name="ragione_sociale" id="ragione_sociale" 
                                   class="form-control @error('ragione_sociale') is-invalid @enderror" 
                                   value="{{ old('ragione_sociale', $cliente->ragione_sociale) }}">
                            @error('ragione_sociale')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="codice_fiscale" class="form-label">Codice Fiscale</label>
                        <input type="text" name="codice_fiscale" id="codice_fiscale" 
                               class="form-control @error('codice_fiscale') is-invalid @enderror" 
                               value="{{ old('codice_fiscale', $cliente->codice_fiscale) }}" maxlength="16">
                        @error('codice_fiscale')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="partita_iva" class="form-label">Partita IVA</label>
                        <input type="text" name="partita_iva" id="partita_iva" 
                               class="form-control @error('partita_iva') is-invalid @enderror" 
                               value="{{ old('partita_iva', $cliente->partita_iva) }}" maxlength="11">
                        @error('partita_iva')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" name="telefono" id="telefono" 
                               class="form-control @error('telefono') is-invalid @enderror" 
                               value="{{ old('telefono', $cliente->telefono) }}">
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email', $cliente->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="indirizzo" class="form-label">Indirizzo</label>
                        <textarea name="indirizzo" id="indirizzo" rows="3" 
                                  class="form-control @error('indirizzo') is-invalid @enderror">{{ old('indirizzo', $cliente->indirizzo) }}</textarea>
                        @error('indirizzo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('clienti.index') }}" class="btn btn-secondary">Annulla</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Aggiorna Cliente
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('tipo_cliente').addEventListener('change', function() {
        const personaFisica = document.getElementById('persona-fisica-fields');
        const personaGiuridica = document.getElementById('persona-giuridica-fields');
        const nomeField = document.getElementById('nome');
        const cognomeField = document.getElementById('cognome');
        const ragioneSocialeField = document.getElementById('ragione_sociale');

        if (this.value === 'giuridica') {
            // Mostra campi persona giuridica
            personaFisica.style.display = 'none';
            personaGiuridica.style.display = 'block';

            // Rimuovi required dai campi persona fisica
            nomeField.removeAttribute('required');
            cognomeField.removeAttribute('required');

            // Aggiungi required a ragione sociale
            ragioneSocialeField.setAttribute('required', 'required');
        } else {
            // Mostra campi persona fisica
            personaFisica.style.display = 'block';
            personaGiuridica.style.display = 'none';

            // Aggiungi required al campo nome
            nomeField.setAttribute('required', 'required');

            // Rimuovi required da ragione sociale
            ragioneSocialeField.removeAttribute('required');
        }
    });
</script>
@endpush
@endsection

