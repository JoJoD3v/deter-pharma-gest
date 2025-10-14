<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clienti = Cliente::latest()->paginate(15);
        return view('clienti.index', compact('clienti'));
    }

    public function create()
    {
        return view('clienti.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo_cliente' => 'required|in:fisica,giuridica',
            'nome' => 'required|string|max:255',
            'cognome' => 'nullable|string|max:255',
            'ragione_sociale' => 'nullable|string|max:255',
            'codice_fiscale' => 'nullable|string|max:16',
            'partita_iva' => 'nullable|string|max:11',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'indirizzo' => 'nullable|string',
        ]);

        Cliente::create($validated);

        return redirect()->route('clienti.index')
            ->with('success', 'Cliente creato con successo!');
    }

    public function show(Cliente $cliente)
    {
        $cliente->load('ddts');
        return view('clienti.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clienti.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'tipo_cliente' => 'required|in:fisica,giuridica',
            'nome' => 'required|string|max:255',
            'cognome' => 'nullable|string|max:255',
            'ragione_sociale' => 'nullable|string|max:255',
            'codice_fiscale' => 'nullable|string|max:16',
            'partita_iva' => 'nullable|string|max:11',
            'telefono' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'indirizzo' => 'nullable|string',
        ]);

        $cliente->update($validated);

        return redirect()->route('clienti.index')
            ->with('success', 'Cliente aggiornato con successo!');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return redirect()->route('clienti.index')
            ->with('success', 'Cliente eliminato con successo!');
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        $clienti = Cliente::where('codice_fiscale', 'LIKE', "%{$query}%")
            ->orWhere('partita_iva', 'LIKE', "%{$query}%")
            ->orWhere('nome', 'LIKE', "%{$query}%")
            ->orWhere('cognome', 'LIKE', "%{$query}%")
            ->orWhere('ragione_sociale', 'LIKE', "%{$query}%")
            ->get();

        return response()->json($clienti);
    }
}
