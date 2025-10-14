<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lavoro;
use App\Models\Cliente;

class LavoroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clienti = Cliente::all();

        // Lavoro con cliente registrato
        if ($clienti->count() > 0) {
            Lavoro::create([
                'cliente_id' => $clienti->first()->id,
                'lavoro_svolto' => 'Sanificazione completa uffici con prodotti certificati. Trattamento di tutte le superfici, pavimenti e arredi.',
                'data_lavoro' => now()->subDays(5),
            ]);

            if ($clienti->count() > 1) {
                Lavoro::create([
                    'cliente_id' => $clienti->skip(1)->first()->id,
                    'lavoro_svolto' => 'Disinfezione ambienti con nebulizzazione. Intervento su 200 mq di superficie.',
                    'data_lavoro' => now()->subDays(3),
                ]);
            }
        }

        // Lavori con inserimento manuale
        Lavoro::create([
            'nome_cliente' => 'Mario',
            'cognome_cliente' => 'Rossi',
            'indirizzo_cliente' => 'Via Verdi 12, Roma',
            'lavoro_svolto' => 'Sanificazione uffici',
            'data_lavoro' => now()->subDays(2),
        ]);

        Lavoro::create([
            'nome_cliente' => 'Azienda',
            'cognome_cliente' => 'Bianchi SRL',
            'indirizzo_cliente' => 'Via Roma 45, Milano',
            'lavoro_svolto' => 'Trattamento anti-batterico completo di tutti gli ambienti aziendali',
            'data_lavoro' => now()->subDays(1),
        ]);

        Lavoro::create([
            'nome_cliente' => 'Giuseppe',
            'cognome_cliente' => 'Verdi',
            'indirizzo_cliente' => 'Corso Italia 88, Torino',
            'lavoro_svolto' => 'Sanificazione con ozono di magazzino 500 mq',
            'data_lavoro' => now(),
        ]);
    }
}
