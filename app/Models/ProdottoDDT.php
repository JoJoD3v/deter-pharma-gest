<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdottoDDT extends Model
{
    protected $table = 'prodotto_d_d_t_s';

    protected $fillable = [
        'ddt_id',
        'codice',
        'nome_prodotto',
        'unita_misura',
        'quantita'
    ];

    public function ddt()
    {
        return $this->belongsTo(DDT::class, 'ddt_id');
    }
}
