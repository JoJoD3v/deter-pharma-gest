<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DDT {{ $ddt->numero_progressivo }} - Amministratore</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #000;
        }
        .header-container {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #000;
        }
        .company-header {
            display: table-cell;
            width: 25%;
            vertical-align: middle;
            text-align: center;
            padding: 10px;
        }
        .company-header img {
            max-width: 180px;
            height: auto;
            margin-bottom: 5px;
        }
        .company-header .company-name {
            font-size: 12pt;
            font-weight: bold;
            color: #000;
        }
        .header {
            display: table-cell;
            width: 75%;
            vertical-align: top;
            text-align: center;
        }
        .header h3 {
            margin: 3px 0;
            font-size: 12pt;
        }
        .header .luogo {
            margin-top: 10px;
            font-weight: bold;
        }
        .header .idem {
            color: blue;
            font-weight: bold;
        }
        .title {
            font-size: 14pt;
            font-weight: bold;
            margin-top: 10px;
        }
        .info-box {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .info-box td {
            border: 1px solid #000;
            padding: 6px 8px;
            font-size: 10pt;
        }
        .info-box .label {
            font-weight: bold;
            background-color: #f0f0f0;
            width: 25%;
        }
        .products-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .products-table th,
        .products-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }
        .products-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            font-size: 10pt;
        }
        .products-table td {
            font-size: 10pt;
        }
        .products-table .center {
            text-align: center;
        }
        .products-table .right {
            text-align: right;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        .details-table td {
            border: 1px solid #000;
            padding: 6px 8px;
            font-size: 10pt;
        }
        .details-table .label {
            font-weight: bold;
            background-color: #f0f0f0;
            width: 35%;
        }
        .checkbox {
            display: inline-block;
            width: 12px;
            height: 12px;
            border: 1px solid #000;
            margin: 0 3px;
            vertical-align: middle;
        }
        .checkbox.checked::after {
            content: 'X';
            font-weight: bold;
            font-size: 10pt;
            display: block;
            text-align: center;
            line-height: 12px;
        }
        .signature-box {
            height: 80px;
            border: 1px solid #000;
            margin-top: 5px;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 80pt;
            color: rgba(0, 0, 0, 0.05);
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="watermark">AMMINISTRATORE</div>
    
    <div class="header-container">
        <div class="company-header">
            <img src="{{ public_path('image/logo-completo.jpg') }}" alt="DeterPharma Logo">
        </div>
        
        <div class="header">
            <h3>Spett.le</h3>
            <h3>{{ $ddt->cliente ? $ddt->cliente->nome_completo : ($ddt->codice_cliente ?? 'N/D') }}</h3>
            @if($ddt->cliente && $ddt->cliente->indirizzo)
                <h3>{{ $ddt->cliente->indirizzo }}</h3>
            @endif
            <div class="luogo">Luogo di consegna</div>
            <div class="idem">IDEM</div>
            <div class="title">Documento di Trasporto</div>
        </div>
    </div>

    <table class="info-box">
        <tr>
            <td class="label">NR.</td>
            <td>{{ $ddt->numero_progressivo }}</td>
            <td class="label">DATA</td>
            <td>{{ $ddt->data_ora_trasporto ? $ddt->data_ora_trasporto->format('d/m/Y') : date('d/m/Y') }}</td>
            <td class="label">COD. CLIENTE</td>
            <td>{{ $ddt->cliente ? $ddt->cliente->id : ($ddt->codice_cliente ?? 'N/D') }}</td>
            <td class="label">PARTITA IVA</td>
            <td>{{ $ddt->cliente ? ($ddt->cliente->partita_iva ?? $ddt->cliente->codice_fiscale ?? 'N/D') : ($ddt->codice_fiscale_piva ?? 'N/D') }}</td>
        </tr>
    </table>

    <table class="products-table">
        <thead>
            <tr>
                <th style="width: 15%;">CODICE</th>
                <th style="width: 50%;">DESCRIZIONE PRODOTTO</th>
                <th style="width: 15%;" class="center">U.M</th>
                <th style="width: 20%;" class="right">Q.TA'</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ddt->prodotti as $prodotto)
                <tr>
                    <td>{{ $prodotto->codice ?? '' }}</td>
                    <td><strong>{{ strtoupper($prodotto->nome_prodotto) }}</strong></td>
                    <td class="center">{{ strtoupper($prodotto->unita_misura ?? 'PZ') }}</td>
                    <td class="right">{{ number_format($prodotto->quantita, 3, ',', '.') }}</td>
                </tr>
            @endforeach
            @for($i = count($ddt->prodotti); $i < 5; $i++)
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            @endfor
        </tbody>
    </table>

    <table class="details-table">
        <tr>
            <td class="label">Causale del Trasporto</td>
            <td>{{ $ddt->causale_trasporto ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Trasporto a cura del</td>
            <td>
                MITTENTE 
                <span class="checkbox {{ $ddt->trasporto_a_cura == 'mittente' ? 'checked' : '' }}"></span>
                VETTORE 
                <span class="checkbox {{ $ddt->trasporto_a_cura == 'vettore' ? 'checked' : '' }}"></span>
                DESTINATARIO
                <span class="checkbox {{ $ddt->trasporto_a_cura == 'destinatario' ? 'checked' : '' }}"></span>
            </td>
        </tr>
        <tr>
            <td class="label">Data e ora inizio del Trasporto</td>
            <td>{{ $ddt->data_ora_trasporto ? $ddt->data_ora_trasporto->format('d/m/Y H:i') : '' }}</td>
        </tr>
        <tr>
            <td class="label">Trasporto a mezzo Vettore</td>
            <td>{{ $ddt->trasporto_ditta ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Aspetto esteriore dei beni</td>
            <td>
                TANICHE 
                <span class="checkbox {{ $ddt->aspetto_beni == 'taniche' ? 'checked' : '' }}"></span>
                CARTONE 
                <span class="checkbox {{ $ddt->aspetto_beni == 'cartone' ? 'checked' : '' }}"></span>
                A VISTA
                <span class="checkbox {{ $ddt->aspetto_beni == 'a_vista' ? 'checked' : '' }}"></span>
            </td>
        </tr>
        <tr>
            <td class="label">Nr. Colli e Peso</td>
            <td>{{ $ddt->num_colli ? 'Colli: ' . $ddt->num_colli : '' }} {{ $ddt->peso ? 'Peso: ' . $ddt->peso . ' Kg' : '' }}</td>
        </tr>
        <tr>
            <td class="label">Porto</td>
            <td>{{ $ddt->porto ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Annotazioni</td>
            <td>{{ $ddt->annotazioni ?? '' }}</td>
        </tr>
        <tr>
            <td class="label">Firma del Conducente</td>
            <td><div class="signature-box"></div></td>
        </tr>
        <tr>
            <td class="label">Firma del Destinatario</td>
            <td><div class="signature-box"></div></td>
        </tr>
    </table>

    <div style="margin-top: 20px; font-size: 9pt; text-align: center; color: #666;">
        Documento generato il {{ now()->format('d/m/Y H:i') }} - Versione Amministratore
    </div>
</body>
</html>

