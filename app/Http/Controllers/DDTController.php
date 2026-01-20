<?php

namespace App\Http\Controllers;

use App\Models\DDT;
use App\Models\Cliente;
use App\Models\ProdottoDDT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class DDTController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = DDT::with('cliente');

        // Filtro per numero DDT
        if ($request->filled('numero_ddt')) {
            $query->where('numero_ddt', 'like', '%' . $request->numero_ddt . '%');
        }

        // Filtro per cliente
        if ($request->filled('cliente')) {
            $query->where(function($q) use ($request) {
                $q->where('codice_cliente', 'like', '%' . $request->cliente . '%')
                  ->orWhereHas('cliente', function($subQ) use ($request) {
                      $subQ->where('nome', 'like', '%' . $request->cliente . '%')
                           ->orWhere('cognome', 'like', '%' . $request->cliente . '%')
                           ->orWhere('ragione_sociale', 'like', '%' . $request->cliente . '%');
                  });
            });
        }

        // Filtro per causale trasporto
        if ($request->filled('causale')) {
            $query->where('causale_trasporto', 'like', '%' . $request->causale . '%');
        }

        // Filtro per trasporto a cura
        if ($request->filled('trasporto_a_cura')) {
            $query->where('trasporto_a_cura', $request->trasporto_a_cura);
        }

        // Filtro per data trasporto
        if ($request->filled('data_da')) {
            $query->whereDate('data_ora_trasporto', '>=', $request->data_da);
        }

        if ($request->filled('data_a')) {
            $query->whereDate('data_ora_trasporto', '<=', $request->data_a);
        }

        $ddts = $query->latest()->paginate(15)->withQueryString();
        return view('ddts.index', compact('ddts'));
    }

    public function create()
    {
        $clienti = Cliente::all();
        return view('ddts.create', compact('clienti'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'codice_cliente' => 'nullable|string|max:255',
            'codice_fiscale_piva' => 'nullable|string|max:255',
            'causale_trasporto' => 'nullable|string|max:255',
            'trasporto_a_cura' => 'nullable|in:mittente,vettore,destinatario',
            'data_ora_trasporto' => 'nullable|date',
            'trasporto_ditta' => 'nullable|string|max:255',
            'aspetto_beni' => 'nullable|in:taniche,cartone,a_vista',
            'num_colli' => 'nullable|integer',
            'peso' => 'nullable|numeric',
            'porto' => 'nullable|string|max:255',
            'annotazioni' => 'nullable|string',
            'prodotti' => 'required|array|min:1',
            'prodotti.*.codice' => 'nullable|string|max:255',
            'prodotti.*.nome_prodotto' => 'required|string|max:255',
            'prodotti.*.unita_misura' => 'nullable|string|max:50',
            'prodotti.*.quantita' => 'required|numeric|min:0.01',
        ]);

        DB::beginTransaction();
        try {
            $ddt = DDT::create($validated);

            foreach ($request->prodotti as $prodotto) {
                $ddt->prodotti()->create($prodotto);
            }

            DB::commit();

            return redirect()->route('ddts.index')
                ->with('success', 'DDT creato con successo! Numero: ' . $ddt->numero_ddt);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Errore nella creazione del DDT: ' . $e->getMessage()]);
        }
    }

    public function show(DDT $ddt)
    {
        $ddt->load(['cliente', 'prodotti']);
        return view('ddts.show', compact('ddt'));
    }

    public function edit(DDT $ddt)
    {
        $ddt->load('prodotti');
        $clienti = Cliente::all();
        return view('ddts.edit', compact('ddt', 'clienti'));
    }

    public function update(Request $request, DDT $ddt)
    {
        $validated = $request->validate([
            'cliente_id' => 'nullable|exists:clientes,id',
            'codice_cliente' => 'nullable|string|max:255',
            'codice_fiscale_piva' => 'nullable|string|max:255',
            'causale_trasporto' => 'nullable|string|max:255',
            'trasporto_a_cura' => 'nullable|in:mittente,vettore,destinatario',
            'data_ora_trasporto' => 'nullable|date',
            'trasporto_ditta' => 'nullable|string|max:255',
            'aspetto_beni' => 'nullable|in:taniche,cartone,a_vista',
            'num_colli' => 'nullable|integer',
            'peso' => 'nullable|numeric',
            'porto' => 'nullable|string|max:255',
            'annotazioni' => 'nullable|string',
            'prodotti' => 'required|array|min:1',
            'prodotti.*.codice' => 'nullable|string|max:255',
            'prodotti.*.nome_prodotto' => 'required|string|max:255',
            'prodotti.*.unita_misura' => 'nullable|string|max:50',
            'prodotti.*.quantita' => 'required|numeric|min:0.01',
        ]);

        DB::beginTransaction();
        try {
            $ddt->update($validated);

            $ddt->prodotti()->delete();

            foreach ($request->prodotti as $prodotto) {
                $ddt->prodotti()->create($prodotto);
            }

            DB::commit();

            return redirect()->route('ddts.index')
                ->with('success', 'DDT aggiornato con successo!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Errore nell\'aggiornamento del DDT: ' . $e->getMessage()]);
        }
    }

    public function destroy(DDT $ddt)
    {
        $ddt->delete();

        return redirect()->route('ddts.index')
            ->with('success', 'DDT eliminato con successo!');
    }

    public function pdfAmministratore(DDT $ddt)
    {
        $ddt->load(['cliente', 'prodotti']);

        $pdf = Pdf::loadView('ddts.pdf.amministratore', compact('ddt'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('DDT_' . $ddt->numero_ddt . '_Amministratore.pdf');
    }

    public function pdfVettore(DDT $ddt)
    {
        $ddt->load(['cliente', 'prodotti']);

        $pdf = Pdf::loadView('ddts.pdf.vettore', compact('ddt'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download('DDT_' . $ddt->numero_ddt . '_Vettore.pdf');
    }
}
