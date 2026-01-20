<?php

namespace App\Http\Controllers;

use App\Models\Lavoro;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LavoroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Lavoro::with('cliente');

        // Filtro per numero ordine (ID)
        if ($request->filled('numero_ordine')) {
            $query->where('id', $request->numero_ordine);
        }

        // Filtro per nome cliente
        if ($request->filled('cliente')) {
            $query->where(function($q) use ($request) {
                $q->where('nome_cliente', 'like', '%' . $request->cliente . '%')
                  ->orWhere('cognome_cliente', 'like', '%' . $request->cliente . '%')
                  ->orWhereHas('cliente', function($subQ) use ($request) {
                      $subQ->where('nome', 'like', '%' . $request->cliente . '%')
                           ->orWhere('cognome', 'like', '%' . $request->cliente . '%')
                           ->orWhere('ragione_sociale', 'like', '%' . $request->cliente . '%');
                  });
            });
        }

        // Filtro per data lavoro
        if ($request->filled('data_da')) {
            $query->where('data_lavoro', '>=', $request->data_da);
        }

        if ($request->filled('data_a')) {
            $query->where('data_lavoro', '<=', $request->data_a);
        }

        // Filtro per tipo ordine
        if ($request->filled('tipo_ordine')) {
            $query->where('tipo_ordine', $request->tipo_ordine);
        }

        // Filtro per lavoro extra
        if ($request->filled('lavoro_extra')) {
            $query->where('lavoro_extra', $request->lavoro_extra == '1');
        }

        $lavori = $query->latest()->paginate(15)->withQueryString();
        return view('lavori.index', compact('lavori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clienti = Cliente::orderBy('nome')->get();
        return view('lavori.create', compact('clienti'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'nome_cliente' => 'required_without:cliente_id|string|max:255',
            'cognome_cliente' => 'nullable|string|max:255',
            'indirizzo_cliente' => 'nullable|string',
            'lavoro_svolto' => 'required|string',
            'data_lavoro' => 'required|date',
            'numero_trattamento' => 'nullable|integer|min:1|max:99',
            'lavoro_extra' => 'nullable|boolean',
            'tipo_ordine' => 'nullable|in:Contratto,Email,Telefonico',
        ]);

        // Assicura che lavoro_extra sia un booleano
        $validated['lavoro_extra'] = $request->has('lavoro_extra') ? true : false;

        Lavoro::create($validated);

        return redirect()->route('lavori.index')
            ->with('success', 'Lavoro registrato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lavoro $lavoro)
    {
        $lavoro->load('cliente');
        return view('lavori.show', compact('lavoro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lavoro $lavoro)
    {
        $clienti = Cliente::orderBy('nome')->get();
        return view('lavori.edit', compact('lavoro', 'clienti'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lavoro $lavoro)
    {
        $validated = $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'nome_cliente' => 'required_without:cliente_id|string|max:255',
            'cognome_cliente' => 'nullable|string|max:255',
            'indirizzo_cliente' => 'nullable|string',
            'lavoro_svolto' => 'required|string',
            'data_lavoro' => 'required|date',
            'numero_trattamento' => 'nullable|integer|min:1|max:99',
            'lavoro_extra' => 'nullable|boolean',
            'tipo_ordine' => 'nullable|in:Contratto,Email,Telefonico',
        ]);

        // Assicura che lavoro_extra sia un booleano
        $validated['lavoro_extra'] = $request->has('lavoro_extra') ? true : false;

        $lavoro->update($validated);

        return redirect()->route('lavori.index')
            ->with('success', 'Lavoro aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lavoro $lavoro)
    {
        $lavoro->delete();

        return redirect()->route('lavori.index')
            ->with('success', 'Lavoro eliminato con successo!');
    }

    /**
     * Genera PDF ricevuta lavoro
     */
    public function pdfRicevuta(Lavoro $lavoro)
    {
        $lavoro->load('cliente');

        $pdf = Pdf::loadView('lavori.pdf.ricevuta', compact('lavoro'));
        $pdf->setPaper('a4', 'portrait');

        // Sostituisce il carattere "/" con "-" per il nome file
        $nomeFile = str_replace('/', '-', $lavoro->numero_ordine);

        return $pdf->download('Ricevuta_Lavoro_' . $nomeFile . '.pdf');
    }
}
