<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'tipo_cliente',
        'nome',
        'cognome',
        'ragione_sociale',
        'codice_fiscale',
        'partita_iva',
        'telefono',
        'email',
        'indirizzo'
    ];

    public function ddts()
    {
        return $this->hasMany(DDT::class);
    }

    public function getNomeCompletoAttribute()
    {
        if ($this->tipo_cliente === 'giuridica') {
            return $this->ragione_sociale;
        }
        return trim($this->nome . ' ' . $this->cognome);
    }
}
