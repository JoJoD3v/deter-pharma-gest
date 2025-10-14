<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DDT extends Model
{
    protected $table = 'd_d_t_s';

    protected $fillable = [
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
            if (empty($ddt->numero_ddt)) {
                $lastDdt = static::orderBy('id', 'desc')->first();
                $nextNumber = $lastDdt ? intval(substr($lastDdt->numero_ddt, 3)) + 1 : 1;
                $ddt->numero_ddt = 'DDT' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
            }
        });
    }
}
