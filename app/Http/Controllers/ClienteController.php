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

    public function index(Request $request)
    {
        $query = Cliente::query();

        // Filtro per tipo cliente
        if ($request->filled('tipo_cliente')) {
            $query->where('tipo_cliente', $request->tipo_cliente);
        }

        // Filtro per nome/ragione sociale
        if ($request->filled('nome')) {
            $query->where(function($q) use ($request) {
                $q->where('nome', 'like', '%' . $request->nome . '%')
                  ->orWhere('cognome', 'like', '%' . $request->nome . '%')
                  ->orWhere('ragione_sociale', 'like', '%' . $request->nome . '%');
            });
        }

        // Filtro per codice fiscale
        if ($request->filled('codice_fiscale')) {
            $query->where('codice_fiscale', 'like', '%' . $request->codice_fiscale . '%');
        }

        // Filtro per partita IVA
        if ($request->filled('partita_iva')) {
            $query->where('partita_iva', 'like', '%' . $request->partita_iva . '%');
        }

        // Filtro per telefono
        if ($request->filled('telefono')) {
            $query->where('telefono', 'like', '%' . $request->telefono . '%');
        }

        // Filtro per email
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $clienti = $query->latest()->paginate(15)->withQueryString();
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
            'nome' => 'required_if:tipo_cliente,fisica|nullable|string|max:255',
            'cognome' => 'nullable|string|max:255',
            'ragione_sociale' => 'required_if:tipo_cliente,giuridica|nullable|string|max:255',
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
            'nome' => 'required_if:tipo_cliente,fisica|nullable|string|max:255',
            'cognome' => 'nullable|string|max:255',
            'ragione_sociale' => 'required_if:tipo_cliente,giuridica|nullable|string|max:255',
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
