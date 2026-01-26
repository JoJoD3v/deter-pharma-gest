@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h2">Nuovo DDT</h1>
        <a href="{{ route('ddts.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Torna alla lista
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('ddts.store') }}" method="POST" id="ddt-form">
                @csrf

                <h5 class="mb-3">Numero Identificativo</h5>
                
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="numero_progressivo" class="form-label">Numero Progressivo <span class="text-danger">*</span></label>
                        <input type="text" name="numero_progressivo" id="numero_progressivo" 
                               class="form-control @error('numero_progressivo') is-invalid @enderror" 
                               value="{{ old('numero_progressivo', $nextProgressivo) }}" 
                               required
                               maxlength="10">
                        @error('numero_progressivo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Numero identificativo del DDT (formato: 000100, 000101, etc.)</small>
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="mb-3">Informazioni Cliente</h5>
                
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo_inserimento" id="cliente_registrato" 
                                   value="registrato" checked>
                            <label class="form-check-label" for="cliente_registrato">
                                Cliente già registrato
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo_inserimento" id="cliente_manuale" 
                                   value="manuale">
                            <label class="form-check-label" for="cliente_manuale">
                                Inserimento manuale
                            </label>
                        </div>
                    </div>
                </div>

                <div id="cliente-registrato-fields">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="cliente_id" class="form-label">Seleziona Cliente</label>
                            <select name="cliente_id" id="cliente_id" class="form-select @error('cliente_id') is-invalid @enderror">
                                <option value="">-- Seleziona un cliente --</option>
                                @foreach($clienti as $cliente)
                                    <option value="{{ $cliente->id }}" 
                                            data-cf="{{ $cliente->codice_fiscale }}" 
                                            data-piva="{{ $cliente->partita_iva }}">
                                        {{ $cliente->nome_completo }} - {{ $cliente->codice_fiscale ?? $cliente->partita_iva }}
                                    </option>
                                @endforeach
                            </select>
                            @error('cliente_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div id="cliente-manuale-fields" style="display: none;">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="codice_cliente" class="form-label">Codice Cliente</label>
                            <input type="text" name="codice_cliente" id="codice_cliente" 
                                   class="form-control @error('codice_cliente') is-invalid @enderror" 
                                   value="{{ old('codice_cliente') }}">
                            @error('codice_cliente')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="codice_fiscale_piva" class="form-label">Codice Fiscale / P.IVA</label>
                            <input type="text" name="codice_fiscale_piva" id="codice_fiscale_piva" 
                                   class="form-control @error('codice_fiscale_piva') is-invalid @enderror" 
                                   value="{{ old('codice_fiscale_piva') }}">
                            @error('codice_fiscale_piva')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="mb-3">Prodotti</h5>
                
                <div id="prodotti-container">
                    <div class="prodotto-row mb-3 p-3 border rounded">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="form-label">Codice</label>
                                <input type="text" name="prodotti[0][codice]" class="form-control" placeholder="Codice">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Nome Prodotto *</label>
                                <input type="text" name="prodotti[0][nome_prodotto]" class="form-control" 
                                       placeholder="Nome prodotto" required>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Unità Misura</label>
                                <input type="text" name="prodotti[0][unita_misura]" class="form-control" 
                                       placeholder="es. Kg, Lt, Pz">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Quantità *</label>
                                <input type="number" name="prodotti[0][quantita]" class="form-control" 
                                       step="0.01" min="0.01" value="1" required>
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-remove-prodotto w-100" disabled>
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-success mb-4" id="btn-add-prodotto">
                    <i class="bi bi-plus-circle"></i> Aggiungi Prodotto
                </button>

                <hr class="my-4">

                <h5 class="mb-3">Dettagli Trasporto</h5>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="causale_trasporto" class="form-label">Causale Trasporto</label>
                        <input type="text" name="causale_trasporto" id="causale_trasporto" 
                               class="form-control @error('causale_trasporto') is-invalid @enderror" 
                               value="{{ old('causale_trasporto') }}">
                        @error('causale_trasporto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="trasporto_a_cura" class="form-label">Trasporto a cura di</label>
                        <select name="trasporto_a_cura" id="trasporto_a_cura" 
                                class="form-select @error('trasporto_a_cura') is-invalid @enderror">
                            <option value="">-- Seleziona --</option>
                            <option value="mittente" {{ old('trasporto_a_cura') == 'mittente' ? 'selected' : '' }}>Mittente</option>
                            <option value="vettore" {{ old('trasporto_a_cura') == 'vettore' ? 'selected' : '' }}>Vettore</option>
                            <option value="destinatario" {{ old('trasporto_a_cura') == 'destinatario' ? 'selected' : '' }}>Destinatario</option>
                        </select>
                        @error('trasporto_a_cura')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="data_ora_trasporto" class="form-label">Data e Ora Inizio Trasporto</label>
                        <input type="datetime-local" name="data_ora_trasporto" id="data_ora_trasporto" 
                               class="form-control @error('data_ora_trasporto') is-invalid @enderror" 
                               value="{{ old('data_ora_trasporto') }}">
                        @error('data_ora_trasporto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="trasporto_ditta" class="form-label">Trasporto Ditta</label>
                        <input type="text" name="trasporto_ditta" id="trasporto_ditta" 
                               class="form-control @error('trasporto_ditta') is-invalid @enderror" 
                               value="{{ old('trasporto_ditta') }}">
                        @error('trasporto_ditta')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="aspetto_beni" class="form-label">Aspetto Esteriore dei Beni</label>
                        <select name="aspetto_beni" id="aspetto_beni" 
                                class="form-select @error('aspetto_beni') is-invalid @enderror">
                            <option value="">-- Seleziona --</option>
                            <option value="taniche" {{ old('aspetto_beni') == 'taniche' ? 'selected' : '' }}>Taniche</option>
                            <option value="cartone" {{ old('aspetto_beni') == 'cartone' ? 'selected' : '' }}>Cartone</option>
                            <option value="a_vista" {{ old('aspetto_beni') == 'a_vista' ? 'selected' : '' }}>A vista</option>
                        </select>
                        @error('aspetto_beni')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="num_colli" class="form-label">Numero Colli</label>
                        <input type="number" name="num_colli" id="num_colli" 
                               class="form-control @error('num_colli') is-invalid @enderror" 
                               value="{{ old('num_colli') }}" min="0">
                        @error('num_colli')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="peso" class="form-label">Peso (Kg)</label>
                        <input type="number" name="peso" id="peso" 
                               class="form-control @error('peso') is-invalid @enderror" 
                               value="{{ old('peso') }}" step="0.01" min="0">
                        @error('peso')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="porto" class="form-label">Porto</label>
                        <input type="text" name="porto" id="porto" 
                               class="form-control @error('porto') is-invalid @enderror" 
                               value="{{ old('porto') }}">
                        @error('porto')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="annotazioni" class="form-label">Annotazioni</label>
                        <textarea name="annotazioni" id="annotazioni" rows="3" 
                                  class="form-control @error('annotazioni') is-invalid @enderror">{{ old('annotazioni') }}</textarea>
                        @error('annotazioni')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('ddts.index') }}" class="btn btn-secondary">Annulla</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Salva DDT
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
let prodottoIndex = 1;

// Gestione tipo inserimento cliente
document.querySelectorAll('input[name="tipo_inserimento"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const registratoFields = document.getElementById('cliente-registrato-fields');
        const manualeFields = document.getElementById('cliente-manuale-fields');
        
        if (this.value === 'manuale') {
            registratoFields.style.display = 'none';
            manualeFields.style.display = 'block';
            document.getElementById('cliente_id').value = '';
        } else {
            registratoFields.style.display = 'block';
            manualeFields.style.display = 'none';
            document.getElementById('codice_cliente').value = '';
            document.getElementById('codice_fiscale_piva').value = '';
        }
    });
});

// Aggiungi prodotto
document.getElementById('btn-add-prodotto').addEventListener('click', function() {
    const container = document.getElementById('prodotti-container');
    const newRow = document.createElement('div');
    newRow.className = 'prodotto-row mb-3 p-3 border rounded';
    newRow.innerHTML = `
        <div class="row">
            <div class="col-md-2">
                <label class="form-label">Codice</label>
                <input type="text" name="prodotti[${prodottoIndex}][codice]" class="form-control" placeholder="Codice">
            </div>
            <div class="col-md-4">
                <label class="form-label">Nome Prodotto *</label>
                <input type="text" name="prodotti[${prodottoIndex}][nome_prodotto]" class="form-control" 
                       placeholder="Nome prodotto" required>
            </div>
            <div class="col-md-2">
                <label class="form-label">Unità Misura</label>
                <input type="text" name="prodotti[${prodottoIndex}][unita_misura]" class="form-control" 
                       placeholder="es. Kg, Lt, Pz">
            </div>
            <div class="col-md-2">
                <label class="form-label">Quantità *</label>
                <input type="number" name="prodotti[${prodottoIndex}][quantita]" class="form-control" 
                       step="0.01" min="0.01" value="1" required>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-remove-prodotto w-100">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>
    `;
    container.appendChild(newRow);
    prodottoIndex++;
    updateRemoveButtons();
});

// Rimuovi prodotto
document.addEventListener('click', function(e) {
    if (e.target.closest('.btn-remove-prodotto')) {
        e.target.closest('.prodotto-row').remove();
        updateRemoveButtons();
    }
});

function updateRemoveButtons() {
    const rows = document.querySelectorAll('.prodotto-row');
    rows.forEach((row, index) => {
        const btn = row.querySelector('.btn-remove-prodotto');
        btn.disabled = rows.length === 1;
    });
}
</script>
@endpush
@endsection

