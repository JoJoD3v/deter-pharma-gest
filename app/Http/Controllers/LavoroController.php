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
    public function index()
    {
        $lavori = Lavoro::with('cliente')->latest()->paginate(15);
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
        ]);

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
        ]);

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
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('Ricevuta_Lavoro_' . $lavoro->id . '.pdf');
    }
}
