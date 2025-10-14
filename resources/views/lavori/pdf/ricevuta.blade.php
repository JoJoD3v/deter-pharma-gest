<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ricevuta Lavoro - {{ $lavoro->id }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #000;
        }

        .container {
            width: 100%;
            height: 100%;
            padding: 20px;
        }

        .main-box {
            border: 4px solid #216581;
            width: 100%;
            height: 450px;
            display: table;
        }

        .left-section {
            width: 30%;
            border-right: 4px solid #216581;
            padding: 30px 20px;
            vertical-align: top;
            display: table-cell;
        }

        .right-section {
            width: 70%;
            padding: 30px;
            vertical-align: top;
            display: table-cell;
        }

        .logo-box {
            width: 100%;
            height: 180px;
            border: 2px solid #216581;
            background-color: #F8FBFC;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 30px;
            text-align: center;
        }

        .logo-placeholder {
            font-size: 32px;
            font-weight: bold;
            color: #216581;
            letter-spacing: 2px;
        }

        .sede-operativa {
            margin-top: 30px;
        }

        .sede-operativa h3 {
            font-size: 16px;
            font-weight: bold;
            color: #216581;
            margin-bottom: 15px;
            border-bottom: 2px solid #2FA4C4;
            padding-bottom: 5px;
        }

        .sede-operativa p {
            font-size: 13px;
            line-height: 1.8;
            margin: 5px 0;
            color: #333;
        }

        .destinatario-box {
            border: 3px solid #216581;
            padding: 20px;
            margin-bottom: 25px;
            background-color: #F8FBFC;
        }

        .destinatario-box h3 {
            font-size: 14px;
            font-weight: bold;
            color: #216581;
            margin-bottom: 8px;
        }

        .destinatario-box p {
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
            color: #000;
        }

        .intervento-box {
            border: 3px solid #216581;
            padding: 20px;
            margin-bottom: 25px;
            min-height: 100px;
            background-color: #FFFFFF;
        }

        .intervento-box h3 {
            font-size: 14px;
            font-weight: bold;
            color: #216581;
            margin-bottom: 10px;
        }

        .intervento-box p {
            font-size: 14px;
            line-height: 1.6;
            color: #000;
        }

        .intervento-box .esempio {
            font-size: 12px;
            color: #666;
            font-style: italic;
        }

        .footer-section {
            display: table;
            width: 100%;
        }

        .data-firma {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .data-firma h4 {
            font-size: 14px;
            font-weight: bold;
            color: #216581;
            margin-bottom: 10px;
        }

        .data-firma p {
            font-size: 14px;
            margin-bottom: 15px;
        }

        .firma-line {
            border-bottom: 2px solid #000;
            width: 90%;
            margin-top: 40px;
        }

        .firma-label {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-box">
            <!-- Sezione Sinistra -->
            <div class="left-section">
                <!-- Logo Placeholder -->
                <div class="logo-box">
                    <div class="logo-placeholder">LOGO</div>
                </div>

                <!-- Sede Operativa -->
                <div class="sede-operativa">
                    <h3>Sede Operativa:</h3>
                    <p><strong>Via Rossi 1234</strong></p>
                    <p><strong>00012 Roma</strong></p>
                    <p style="margin-top: 15px;"><strong>Telefono</strong></p>
                    <p><strong>02 2379239</strong></p>
                </div>
            </div>

            <!-- Sezione Destra -->
            <div class="right-section">
                <!-- Destinatario -->
                <div class="destinatario-box">
                    <h3>Destinatario:</h3>
                    <p>{{ $lavoro->nome_completo }}</p>
                    @if($lavoro->indirizzo_completo)
                        <p>{{ $lavoro->indirizzo_completo }}</p>
                    @endif
                </div>

                <!-- Intervento Svolto -->
                <div class="intervento-box">
                    <h3>Intervento svolto:</h3>
                    <p>{{ $lavoro->lavoro_svolto }}</p>
                </div>

                <!-- Data e Firme -->
                <div class="footer-section">
                    <div class="data-firma">
                        <h4>Data: {{ $lavoro->data_lavoro->format('d/m/Y') }}</h4>
                        <div class="firma-line"></div>
                        <p class="firma-label">Firma Destinatario</p>
                    </div>
                    <div class="data-firma" style="text-align: right;">
                        <h4 style="visibility: hidden;">Firma</h4>
                        <div class="firma-line" style="margin-left: auto;"></div>
                        <p class="firma-label">Firma Operatore</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

