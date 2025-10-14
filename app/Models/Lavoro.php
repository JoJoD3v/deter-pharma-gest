<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lavoro extends Model
{
    protected $table = 'lavori';

    protected $fillable = [
        'cliente_id',
        'nome_cliente',
        'cognome_cliente',
        'indirizzo_cliente',
        'lavoro_svolto',
        'data_lavoro',
    ];

    protected $casts = [
        'data_lavoro' => 'date',
    ];

    /**
     * Relazione con Cliente (opzionale)
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Ottiene il nome completo del cliente
     */
    public function getNomeCompletoAttribute(): string
    {
        if ($this->cliente_id && $this->cliente) {
            return $this->cliente->tipo_cliente === 'fisica'
                ? trim($this->cliente->nome . ' ' . $this->cliente->cognome)
                : ($this->cliente->ragione_sociale ?? 'N/D');
        }

        $nomeCompleto = trim(($this->nome_cliente ?? '') . ' ' . ($this->cognome_cliente ?? ''));
        return $nomeCompleto ?: 'N/D';
    }

    /**
     * Ottiene l'indirizzo del cliente
     */
    public function getIndirizzoCompletoAttribute(): string
    {
        if ($this->cliente_id && $this->cliente) {
            return $this->cliente->indirizzo ?? '';
        }

        return $this->indirizzo_cliente ?? '';
    }
}
