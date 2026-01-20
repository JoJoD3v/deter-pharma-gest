<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricevuta Lavoro - {{ $lavoro->numero_ordine }}</title>
    <style>
        @page {
            margin: 15mm;
            size: A4 portrait;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #2c3e50;
            background: #ffffff;
            font-size: 9pt;
            line-height: 1.4;
        }

        .container {
            width: 100%;
            max-width: 180mm;
            margin: 0 auto;
        }

        /* ========== HEADER ========== */
        .header {
            display: table;
            width: 100%;
            margin-bottom: 8px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 8px;
        }

        .header-logo {
            display: table-cell;
            width: 35%;
            vertical-align: middle;
            text-align: left;
        }

        .header-logo img {
            max-width: 120px;
            height: auto;
        }

        .header-info {
            display: table-cell;
            width: 65%;
            vertical-align: middle;
            text-align: right;
            padding-left: 15px;
        }

        .company-name {
            font-size: 16pt;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 3px;
            letter-spacing: 0.3px;
        }

        .company-details {
            font-size: 8pt;
            color: #7f8c8d;
            line-height: 1.3;
        }

        .company-details strong {
            color: #34495e;
        }

        /* ========== TITOLO DOCUMENTO ========== */
        .document-title {
            text-align: center;
            margin: 8px 0 12px 0;
            padding: 10px;
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .document-title h1 {
            font-size: 18pt;
            font-weight: bold;
            color: #ffffff;
            margin-bottom: 3px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .document-number {
            font-size: 11pt;
            color: #000000;
            font-weight: 600;
        }

        /* ========== SEZIONI INFORMAZIONI ========== */
        .info-section {
            margin-bottom: 12px;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
            overflow: hidden;
            background: #ffffff;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .section-header {
            background: linear-gradient(135deg, #ecf0f1 0%, #d5dbdb 100%);
            padding: 6px 10px;
            border-bottom: 2px solid #3498db;
        }

        .section-header h2 {
            font-size: 10pt;
            font-weight: bold;
            color: #2c3e50;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin: 0;
        }



        .section-content {
            padding: 10px;
        }

        /* ========== GRIGLIA INFORMAZIONI ========== */
        .info-grid {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }

        .info-row {
            display: table-row;
        }

        .info-label {
            display: table-cell;
            width: 35%;
            padding: 5px 8px;
            font-weight: 600;
            color: #34495e;
            font-size: 9pt;
            border-bottom: 1px solid #ecf0f1;
        }

        .info-value {
            display: table-cell;
            width: 65%;
            padding: 5px 8px;
            color: #2c3e50;
            font-size: 9pt;
            border-bottom: 1px solid #ecf0f1;
        }

        .info-row:last-child .info-label,
        .info-row:last-child .info-value {
            border-bottom: none;
        }

        /* ========== CLIENTE ========== */
        .cliente-name {
            font-size: 11pt;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 6px;
            padding: 8px;
            background: #f8f9fa;
            border-left: 3px solid #3498db;
            border-radius: 3px;
        }

        .cliente-address {
            font-size: 9pt;
            color: #7f8c8d;
            padding-left: 8px;
        }

        /* ========== DESCRIZIONE LAVORO ========== */
        .work-description {
            font-size: 9pt;
            line-height: 1.5;
            color: #2c3e50;
            padding: 10px;
            background: #f8f9fa;
            border-left: 3px solid #3498db;
            border-radius: 3px;
            min-height: 60px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        /* ========== FIRME ========== */
        .signatures {
            margin-top: 25px;
            display: table;
            width: 100%;
            page-break-inside: avoid;
        }

        .signature-block {
            display: table-cell;
            width: 50%;
            padding: 0 10px;
            text-align: center;
            vertical-align: top;
        }

        .signature-date {
            font-size: 9pt;
            font-weight: 600;
            color: #34495e;
            margin-bottom: 35px;
        }

        .signature-line {
            border-bottom: 1.5px solid #2c3e50;
            width: 80%;
            margin: 0 auto 6px auto;
        }

        .signature-label {
            font-size: 8pt;
            color: #7f8c8d;
            font-style: italic;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        /* ========== FOOTER ========== */
        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ecf0f1;
            text-align: center;
            font-size: 7pt;
            color: #95a5a6;
            page-break-inside: avoid;
        }

        .footer-line {
            margin-bottom: 3px;
        }

        /* ========== UTILITY ========== */
        .text-center {
            text-align: center;
        }

        .text-bold {
            font-weight: bold;
        }

        .mb-10 {
            margin-bottom: 10px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        /* ========== STAMPA ========== */
        @media print {
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .info-section {
                page-break-inside: avoid;
            }

            .signatures {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- ========== HEADER ========== -->
        <div class="header">
            <div class="header-logo">
                <img src="{{ public_path('image/logo-deter.png') }}" alt="DeterPharma Logo">
            </div>
            <div class="header-info">
                <div class="company-name">DeterPharma</div>
                <div class="company-details">
                    <strong>Sede Operativa:</strong> Via Carlo Poma nr. 4 00198 - ROMA<br>
                    <strong>Tel:</strong> + 39 06 21119547 | +39 393 8788378<br>
                    <strong>Email:</strong> deterpharma@gmail.com
                </div>
            </div>
        </div>

        <!-- ========== TITOLO DOCUMENTO ========== -->
        <div class="document-title">
            <h1>Ricevuta Lavoro</h1>
            <div class="document-number">N° {{ $lavoro->numero_ordine }}</div>
        </div>

        <!-- ========== INFORMAZIONI ORDINE ========== -->
        <div class="info-section">
            <div class="section-header">
                <h2>Informazioni Servizio</h2>
            </div>
            <div class="section-content">
                <div class="info-grid">
                    <div class="info-row">
                        <div class="info-label">Data Lavoro:</div>
                        <div class="info-value"><strong>{{ $lavoro->data_lavoro->format('d/m/Y') }}</strong></div>
                    </div>
                    @if($lavoro->numero_trattamento)
                    <div class="info-row">
                        <div class="info-label">Numero Trattamento:</div>
                        <div class="info-value">{{ $lavoro->numero_trattamento }}</div>
                    </div>
                    @endif
                    @if($lavoro->tipo_ordine)
                    <div class="info-row">
                        <div class="info-label">Tipo Ordine:</div>
                        <div class="info-value"><strong>{{ $lavoro->tipo_ordine }}</strong></div>
                    </div>
                    @endif
                    @if($lavoro->lavoro_extra)
                    <div class="info-row">
                        <div class="info-label">Lavoro Extra:</div>
                        <div class="info-value"><strong>Sì</strong></div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- ========== DESTINATARIO ========== -->
        <div class="info-section">
            <div class="section-header">
                <h2>Destinatario</h2>
            </div>
            <div class="section-content">
                <div class="cliente-name">{{ $lavoro->nome_completo }}</div>
                @if($lavoro->indirizzo_completo)
                    <div class="cliente-address">
                        <strong>Indirizzo:</strong> {{ $lavoro->indirizzo_completo }}
                    </div>
                @endif
            </div>
        </div>

        <!-- ========== INTERVENTO SVOLTO ========== -->
        <div class="info-section">
            <div class="section-header">
                <h2>Intervento Svolto</h2>
            </div>
            <div class="section-content">
                <div class="work-description">{{ $lavoro->lavoro_svolto }}</div>
            </div>
        </div>

        <!-- ========== FIRME ========== -->
        <div class="signatures">
            <div class="signature-block">
                <div class="signature-date">Data: {{ $lavoro->data_lavoro->format('d/m/Y') }}</div>
                <div class="signature-line"></div>
                <div class="signature-label">Firma Destinatario</div>
            </div>
            <div class="signature-block">
                <div class="signature-date">Data: {{ $lavoro->data_lavoro->format('d/m/Y') }}</div>
                <div class="signature-line"></div>
                <div class="signature-label">Firma Operatore</div>
            </div>
        </div>

        <!-- ========== FOOTER ========== -->
        <div class="footer">
            <div class="footer-line">
                <strong>DeterPharma</strong> - Servizi di Sanificazione Professionale
            </div>
            <div class="footer-line">
                Documento generato il {{ now()->format('d/m/Y') }} alle ore {{ now()->format('H:i') }}
            </div>
        </div>
    </div>
</body>
</html>

