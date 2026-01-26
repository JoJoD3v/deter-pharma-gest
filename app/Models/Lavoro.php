<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lavoro extends Model
{
    protected $table = 'lavori';

    protected $fillable = [
        'numero_progressivo',
        'cliente_id',
        'nome_cliente',
        'cognome_cliente',
        'indirizzo_cliente',
        'lavoro_svolto',
        'data_lavoro',
        'numero_trattamento',
        'lavoro_extra',
        'tipo_ordine',
    ];

    protected $casts = [
        'data_lavoro' => 'date',
        'lavoro_extra' => 'boolean',
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

    /**
     * Ottiene il numero ordine formattato (es: 00001/2026)
     */
    public function getNumeroOrdineAttribute(): string
    {
        $anno = $this->data_lavoro ? $this->data_lavoro->format('Y') : date('Y');
        return str_pad($this->id, 5, '0', STR_PAD_LEFT) . '/' . $anno;
    }

    /**
     * Boot del modello
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($lavoro) {
            // Se numero_progressivo non è impostato, usa il prossimo disponibile
            if (empty($lavoro->numero_progressivo)) {
                $lavoro->numero_progressivo = static::getNextProgressivo();
            }
        });
    }

    /**
     * Ottiene il prossimo numero progressivo disponibile (inizia da 100)
     */
    public static function getNextProgressivo(): string
    {
        $lastLavoro = static::orderBy('numero_progressivo', 'desc')->first();
        
        if ($lastLavoro && $lastLavoro->numero_progressivo) {
            $lastNumber = intval($lastLavoro->numero_progressivo);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 100;
        }
        
        return str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }
}
