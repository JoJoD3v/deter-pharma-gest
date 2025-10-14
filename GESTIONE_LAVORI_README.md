# Gestione Lavori - DeterPharma Gest

## 📋 Panoramica

La nuova sezione **Gestione Lavori** permette di registrare e gestire tutti i lavori svolti dall'azienda, con la possibilità di generare ricevute PDF professionali per ogni intervento.

## ✨ Funzionalità Implementate

### 1. CRUD Completo Lavori
- ✅ **Creazione** lavori con dati cliente (registrato o manuale)
- ✅ **Visualizzazione** lista lavori con paginazione
- ✅ **Modifica** lavori esistenti
- ✅ **Eliminazione** lavori con conferma
- ✅ **Dettaglio** lavoro con tutte le informazioni

### 2. Gestione Cliente Flessibile
- **Cliente Registrato**: Selezione da dropdown con auto-compilazione dati
- **Inserimento Manuale**: Possibilità di inserire dati cliente al volo
- Campi: Nome, Cognome, Indirizzo

### 3. Generazione PDF Ricevuta
- ✅ Layout professionale conforme all'immagine fornita
- ✅ Formato A4 orizzontale (landscape)
- ✅ Sezione sinistra: Logo + Sede Operativa
- ✅ Sezione destra: Destinatario + Intervento + Firme
- ✅ Colori aziendali (#216581, #2FA4C4, etc.)
- ✅ Download automatico con nome descrittivo

### 4. Integrazione Dashboard
- ✅ Card "Lavori" con conteggio totale
- ✅ Link rapido alla gestione lavori
- ✅ Gradiente colorato coerente con la palette

### 5. Menu Sidebar
- ✅ Voce "Gestione Lavori" con icona tools
- ✅ Evidenziazione automatica quando attiva

## 🗂️ Struttura Database

### Tabella `lavori`

| Campo | Tipo | Descrizione |
|-------|------|-------------|
| id | bigint | ID univoco |
| cliente_id | bigint (nullable) | FK a clientes (se cliente registrato) |
| nome_cliente | varchar (nullable) | Nome/Ragione Sociale (se manuale) |
| cognome_cliente | varchar (nullable) | Cognome (se manuale) |
| indirizzo_cliente | text (nullable) | Indirizzo (se manuale) |
| lavoro_svolto | text | Descrizione lavoro svolto |
| data_lavoro | date | Data esecuzione lavoro |
| created_at | timestamp | Data creazione record |
| updated_at | timestamp | Data ultima modifica |

## 📁 File Creati/Modificati

### Nuovi File

#### Models
- `app/Models/Lavoro.php` - Model Eloquent con relazioni e accessors

#### Controllers
- `app/Http/Controllers/LavoroController.php` - CRUD + metodo PDF

#### Migrations
- `database/migrations/2025_10_14_181355_create_lavori_table.php`

#### Seeders
- `database/seeders/LavoroSeeder.php` - Dati di esempio

#### Views
- `resources/views/lavori/index.blade.php` - Lista lavori
- `resources/views/lavori/create.blade.php` - Form creazione
- `resources/views/lavori/edit.blade.php` - Form modifica
- `resources/views/lavori/show.blade.php` - Dettaglio lavoro
- `resources/views/lavori/pdf/ricevuta.blade.php` - Template PDF

### File Modificati

#### Routes
- `routes/web.php` - Aggiunte routes resource + PDF

#### Controllers
- `app/Http/Controllers/DashboardController.php` - Aggiunta statistica lavori

#### Views
- `resources/views/layouts/app.blade.php` - Aggiunta voce menu
- `resources/views/dashboard.blade.php` - Aggiunta card Lavori (4 card totali)

#### Seeders
- `database/seeders/DatabaseSeeder.php` - Aggiunto LavoroSeeder

## 🎨 Layout PDF Ricevuta

Il PDF generato segue esattamente il layout fornito nell'immagine:

```
┌─────────────────────────────────────────────────────────────┐
│                                                             │
│  ┌──────────┐  │  Destinatario:                           │
│  │          │  │  Mario Rossi                              │
│  │   LOGO   │  │  via Verdi 12 Roma                        │
│  │          │  │                                           │
│  └──────────┘  │  ┌─────────────────────────────────────┐ │
│                │  │ Intervento svolto:                  │ │
│  Sede Operativa│  │ (esempio: sanificazione uffici)     │ │
│  Via rossi 1234│  └─────────────────────────────────────┘ │
│  00012 Roma    │                                           │
│  Telefono      │  Data: 14/10/2025                         │
│  02 2379239    │  _______________    _______________       │
│                │  Firma Destinat.    Firma Operatore       │
└─────────────────────────────────────────────────────────────┘
```

### Caratteristiche PDF
- **Formato**: A4 Landscape (orizzontale)
- **Bordo principale**: 4px solid #216581
- **Divisore verticale**: 4px solid #216581
- **Sezione sinistra**: 30% larghezza
- **Sezione destra**: 70% larghezza
- **Logo**: Placeholder "LOGO" (personalizzabile)
- **Colori**: Palette aziendale (#216581, #2FA4C4, #F8FBFC)

## 🚀 Come Utilizzare

### Creare un Nuovo Lavoro

1. **Accedi a "Gestione Lavori"** dal menu laterale
2. **Clicca "Nuovo Lavoro"**
3. **Scegli il tipo di cliente**:
   - **Cliente Registrato**: Seleziona dal dropdown (auto-compila i dati)
   - **Inserimento Manuale**: Lascia vuoto e compila manualmente
4. **Compila i dati**:
   - Nome/Ragione Sociale (obbligatorio)
   - Cognome (opzionale)
   - Indirizzo (opzionale)
   - Lavoro Svolto (obbligatorio)
   - Data Lavoro (obbligatorio)
5. **Salva**

### Generare PDF Ricevuta

#### Dalla Lista Lavori
1. Vai su "Gestione Lavori"
2. Clicca l'icona PDF rossa nella riga del lavoro
3. Il PDF verrà scaricato automaticamente

#### Dalla Scheda Lavoro
1. Apri un lavoro (icona occhio)
2. Clicca "Scarica Ricevuta PDF" in alto
3. Il PDF verrà scaricato automaticamente

### Modificare un Lavoro

1. Dalla lista o dalla scheda, clicca "Modifica"
2. Aggiorna i campi necessari
3. Clicca "Aggiorna Lavoro"

### Eliminare un Lavoro

1. Dalla lista: clicca icona cestino e conferma
2. Dalla scheda: scorri in basso, clicca "Elimina Lavoro" e conferma

## 📊 Statistiche Dashboard

La dashboard ora mostra 4 card:
1. **Utenti** - Gradiente blu profondo → azzurro medio
2. **Clienti** - Gradiente azzurro medio → azzurro intermedio
3. **DDT** - Gradiente azzurro intermedio → azzurro chiaro
4. **Lavori** - Gradiente azzurro chiaro → azzurro pastello

Ogni card mostra:
- Icona rappresentativa
- Conteggio totale
- Link "Visualizza tutti"

## 🔧 Personalizzazione PDF

### Modificare Logo
1. Apri `resources/views/lavori/pdf/ricevuta.blade.php`
2. Trova la sezione `.logo-box`
3. Sostituisci il placeholder con:
```html
<img src="{{ public_path('images/logo.png') }}" alt="Logo" style="max-width: 100%; max-height: 100%;">
```
4. Carica il logo in `public/images/logo.png`

### Modificare Sede Operativa
1. Apri `resources/views/lavori/pdf/ricevuta.blade.php`
2. Trova la sezione `.sede-operativa`
3. Modifica i dati aziendali:
```html
<p><strong>Via Tua 123</strong></p>
<p><strong>00100 Città</strong></p>
<p style="margin-top: 15px;"><strong>Telefono</strong></p>
<p><strong>06 1234567</strong></p>
```

### Aggiungere Email/P.IVA
Nella sezione `.sede-operativa`, aggiungi:
```html
<p style="margin-top: 10px;"><strong>Email</strong></p>
<p><strong>info@tuaazienda.it</strong></p>
<p style="margin-top: 10px;"><strong>P.IVA</strong></p>
<p><strong>12345678901</strong></p>
```

## 🎯 Routes Disponibili

| Metodo | URI | Nome | Azione |
|--------|-----|------|--------|
| GET | /lavori | lavori.index | Lista lavori |
| GET | /lavori/create | lavori.create | Form creazione |
| POST | /lavori | lavori.store | Salva lavoro |
| GET | /lavori/{id} | lavori.show | Dettaglio lavoro |
| GET | /lavori/{id}/edit | lavori.edit | Form modifica |
| PUT/PATCH | /lavori/{id} | lavori.update | Aggiorna lavoro |
| DELETE | /lavori/{id} | lavori.destroy | Elimina lavoro |
| GET | /lavori/{id}/pdf-ricevuta | lavori.pdf.ricevuta | Genera PDF |

## 💡 Esempi di Utilizzo

### Lavoro con Cliente Registrato
```
Cliente: Mario Rossi (selezionato da dropdown)
Lavoro: Sanificazione completa uffici con prodotti certificati
Data: 14/10/2025
```
→ I dati cliente vengono presi dal database

### Lavoro con Inserimento Manuale
```
Nome: Giuseppe
Cognome: Verdi
Indirizzo: Corso Italia 88, Torino
Lavoro: Sanificazione con ozono di magazzino 500 mq
Data: 14/10/2025
```
→ I dati cliente vengono salvati nel record lavoro

## 🐛 Risoluzione Problemi

### PDF non si scarica
**Soluzione**: Verifica che DomPDF sia installato
```bash
composer require barryvdh/laravel-dompdf
```

### Layout PDF non corretto
**Soluzione**: Verifica che il formato sia landscape
```php
$pdf->setPaper('a4', 'landscape');
```

### Dati cliente non si auto-compilano
**Soluzione**: Verifica che JavaScript sia abilitato e controlla la console browser

### Errore "Table lavoros not found"
**Soluzione**: Aggiungi `protected $table = 'lavori';` nel Model

## 📝 Note Tecniche

- **Relazione Cliente**: `belongsTo` opzionale (nullable)
- **Accessor `nome_completo`**: Gestisce sia cliente registrato che manuale
- **Accessor `indirizzo_completo`**: Gestisce sia cliente registrato che manuale
- **Validazione**: `nome_cliente` obbligatorio solo se `cliente_id` è vuoto
- **PDF Engine**: DomPDF con supporto UTF-8
- **Stili PDF**: Inline CSS per massima compatibilità

## 🎉 Funzionalità Future (Opzionali)

- [ ] Invio ricevuta via email
- [ ] Firma digitale su PDF
- [ ] Allegati al lavoro (foto, documenti)
- [ ] Storico modifiche lavoro
- [ ] Filtri avanzati lista lavori
- [ ] Export Excel lista lavori
- [ ] Template ricevuta personalizzabili
- [ ] Numerazione progressiva ricevute

---

**Versione**: 1.2.0  
**Data**: Ottobre 2025  
**Compatibilità**: Laravel 12+, PHP 8.2+

