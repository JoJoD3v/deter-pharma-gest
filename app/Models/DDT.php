<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DDT extends Model
{
    protected $table = 'd_d_t_s';

    protected $fillable = [
        'numero_progressivo',
        'numero_ddt',
        'cliente_id',
        'codice_cliente',
        'codice_fiscale_piva',
        'causale_trasporto',
        'trasporto_a_cura',
        'data_ora_trasporto',
        'trasporto_ditta',
        'aspetto_beni',
        'num_colli',
        'peso',
        'porto',
        'annotazioni'
    ];

    protected $casts = [
        'data_ora_trasporto' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function prodotti()
    {
        return $this->hasMany(ProdottoDDT::class, 'ddt_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ddt) {
            // Se numero_progressivo non è impostato, usa il prossimo disponibile
            if (empty($ddt->numero_progressivo)) {
                $ddt->numero_progressivo = static::getNextProgressivo();
            }
            
            // Genera numero_ddt se non impostato
            if (empty($ddt->numero_ddt)) {
                $ddt->numero_ddt = 'DDT' . $ddt->numero_progressivo;
            }
        });
    }

    /**
     * Ottiene il prossimo numero progressivo disponibile (inizia da 100)
     */
    public static function getNextProgressivo(): string
    {
        $lastDdt = static::orderBy('numero_progressivo', 'desc')->first();
        
        if ($lastDdt && $lastDdt->numero_progressivo) {
            $lastNumber = intval($lastDdt->numero_progressivo);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 100;
        }
        
        return str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Ottiene il numero progressivo formattato con l'anno (es: 000100/2025)
     */
    public function getNumeroProgressivoFormattatoAttribute(): string
    {
        if (!$this->numero_progressivo) {
            return 'N/D';
        }
        $anno = $this->data_ora_trasporto ? $this->data_ora_trasporto->format('Y') : date('Y');
        return $this->numero_progressivo . '/' . $anno;
    }
}
