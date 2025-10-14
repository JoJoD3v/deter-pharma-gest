# Changelog Aggiornamenti - DeterPharma Gest

## Versione 1.1.0 - Ottobre 2025

### 🎨 Nuova Palette Colori

Implementata una nuova palette di colori professionale e coerente in tutto il gestionale:

#### Colori Principali
- **#216581** - Blu profondo (Header, Navbar, elementi primari)
- **#2FA4C4** - Azzurro medio (Pulsanti primari, elementi attivi)
- **#41B7D1** - Azzurro intermedio (Hover, transizioni)
- **#60D6F4** - Azzurro chiaro (Accenti, highlights)
- **#98DFEC** - Azzurro pastello (Sfondi secondari, card headers)
- **#F8FBFC** - Bianco opaco (Sfondo principale)

#### Applicazioni UI
- **Background principale**: #F8FBFC (bianco con tocco azzurro ghiaccio)
- **Header/Navbar**: #216581 con testo bianco
- **Sidebar**: Gradiente da #216581 a #2FA4C4
- **Pulsanti primari**: #2FA4C4 con hover #41B7D1
- **Pulsanti secondari**: #98DFEC con testo #216581
- **Card/Box**: #FFFFFF con ombra rgba(33,101,129,0.1)
- **Tabelle righe alternate**: #FFFFFF / #F0FAFC
- **Link**: #41B7D1 con hover #2FA4C4

#### Miglioramenti Visivi
- Bordi arrotondati (6-8px) per pulsanti e card
- Ombre sottili per profondità
- Transizioni smooth su hover
- Gradiente nella sidebar per effetto moderno
- Card dashboard con gradienti colorati

### 📄 Sistema Generazione PDF DDT

Implementato sistema completo di generazione PDF per i Documenti di Trasporto con due versioni distinte:

#### PDF Amministratore
- **Rotta**: `/ddts/{id}/pdf-amministratore`
- **Metodo Controller**: `DDTController@pdfAmministratore`
- **Template**: `resources/views/ddts/pdf/amministratore.blade.php`
- **Caratteristiche**:
  - Watermark "AMMINISTRATORE" in background
  - Tutte le informazioni complete del DDT
  - Sezione annotazioni visibile
  - Spazi per firma conducente e destinatario
  - Footer con data/ora generazione

#### PDF Vettore
- **Rotta**: `/ddts/{id}/pdf-vettore`
- **Metodo Controller**: `DDTController@pdfVettore`
- **Template**: `resources/views/ddts/pdf/vettore.blade.php`
- **Caratteristiche**:
  - Watermark "VETTORE" in background
  - Informazioni essenziali per il trasporto
  - Focus su prodotti e dettagli consegna
  - Spazi per firma conducente e destinatario
  - Footer con data/ora generazione

#### Struttura PDF (conforme all'immagine fornita)
1. **Header**:
   - Spett.le [Nome Cliente]
   - Indirizzo cliente
   - Luogo di consegna: IDEM

2. **Titolo**: "Documento di Trasporto"

3. **Info Box**:
   - NR. DDT
   - DATA
   - COD. CLIENTE
   - PARTITA IVA

4. **Tabella Prodotti**:
   - CODICE
   - DESCRIZIONE PRODOTTO
   - U.M (Unità di Misura)
   - Q.TA' (Quantità)
   - Minimo 5 righe (con righe vuote se necessario)

5. **Dettagli Trasporto**:
   - Causale del Trasporto
   - Trasporto a cura del (checkbox: Mittente/Vettore/Destinatario)
   - Data e ora inizio del Trasporto
   - Trasporto a mezzo Vettore
   - Aspetto esteriore dei beni (checkbox: Taniche/Cartone/A vista)
   - Nr. Colli e Peso
   - Porto
   - Annotazioni (solo versione Amministratore)
   - Firma del Conducente
   - Firma del Destinatario

#### Accesso ai PDF

**Dalla lista DDT** (`/ddts`):
- Pulsante rosso "PDF" per versione Amministratore
- Pulsante blu "PDF" per versione Vettore

**Dalla scheda DDT** (`/ddts/{id}`):
- Gruppo pulsanti in alto a destra:
  - "PDF Amministratore" (rosso)
  - "PDF Vettore" (blu/info)
  - "Modifica" (giallo)
  - "Torna alla lista" (grigio)

### 🔧 Dipendenze Aggiunte

```json
{
    "barryvdh/laravel-dompdf": "^3.1"
}
```

### 📁 File Modificati

#### Controller
- `app/Http/Controllers/DDTController.php`
  - Aggiunto import `Barryvdh\DomPDF\Facade\Pdf`
  - Aggiunto metodo `pdfAmministratore(DDT $ddt)`
  - Aggiunto metodo `pdfVettore(DDT $ddt)`

#### Routes
- `routes/web.php`
  - Aggiunta rotta `GET /ddts/{ddt}/pdf-amministratore`
  - Aggiunta rotta `GET /ddts/{ddt}/pdf-vettore`

#### Views
- `resources/views/layouts/app.blade.php`
  - Aggiornato CSS con nuova palette colori
  - Implementate variabili CSS custom (`:root`)
  - Aggiornati stili sidebar, navbar, card, pulsanti, tabelle
  - Aggiunto effetto gradiente sidebar
  - Migliorati effetti hover e transizioni

- `resources/views/dashboard.blade.php`
  - Aggiornate card statistiche con gradienti colorati
  - Applicata nuova palette colori

- `resources/views/ddts/show.blade.php`
  - Aggiunti pulsanti "PDF Amministratore" e "PDF Vettore"
  - Riorganizzato gruppo pulsanti azioni

- `resources/views/ddts/index.blade.php`
  - Aggiunti pulsanti PDF nella colonna azioni
  - Icone PDF con colori distintivi

#### Nuovi File
- `resources/views/ddts/pdf/amministratore.blade.php`
  - Template PDF versione Amministratore
  - Layout conforme all'immagine fornita
  - Stili inline per compatibilità PDF

- `resources/views/ddts/pdf/vettore.blade.php`
  - Template PDF versione Vettore
  - Layout conforme all'immagine fornita
  - Stili inline per compatibilità PDF

- `config/dompdf.php`
  - File di configurazione DomPDF pubblicato

### 🎯 Funzionalità Implementate

✅ Generazione PDF DDT versione Amministratore
✅ Generazione PDF DDT versione Vettore
✅ Layout PDF conforme al template fornito
✅ Watermark distintivo per ogni versione
✅ Download automatico PDF con nome file descrittivo
✅ Pulsanti accesso rapido ai PDF da lista e dettaglio
✅ Nuova palette colori applicata a tutto il gestionale
✅ Sidebar con gradiente e animazioni
✅ Card dashboard con gradienti colorati
✅ Effetti hover migliorati su tutti gli elementi interattivi
✅ Transizioni smooth per migliore UX

### 📝 Note Tecniche

#### Generazione PDF
- Libreria utilizzata: `barryvdh/laravel-dompdf`
- Formato carta: A4 Portrait
- Encoding: UTF-8
- Font: Arial (compatibilità universale)
- Stili: Inline CSS per massima compatibilità

#### Performance
- PDF generati on-demand (non salvati su disco)
- Caricamento eager di relazioni (cliente, prodotti)
- Download diretto senza passaggi intermedi

#### Compatibilità
- Testato su Laravel 12
- Compatibile con PHP 8.2+
- Funziona con SQLite, MySQL, PostgreSQL

### 🚀 Come Utilizzare

#### Generare PDF da Lista DDT
1. Vai su "Gestione DDT"
2. Nella riga del DDT desiderato, clicca:
   - Icona PDF rossa per versione Amministratore
   - Icona PDF blu per versione Vettore
3. Il PDF verrà scaricato automaticamente

#### Generare PDF da Dettaglio DDT
1. Apri un DDT (clicca sull'icona occhio)
2. In alto a destra, clicca:
   - "PDF Amministratore" per versione completa
   - "PDF Vettore" per versione trasporto
3. Il PDF verrà scaricato automaticamente

#### Nome File PDF
- Formato: `DDT_{NUMERO_DDT}_{VERSIONE}.pdf`
- Esempio: `DDT_DDT000001_Amministratore.pdf`
- Esempio: `DDT_DDT000001_Vettore.pdf`

### 🎨 Guida Colori per Sviluppatori

Se devi aggiungere nuovi elementi UI, usa queste variabili CSS:

```css
var(--dp-blue-deep)         /* #216581 - Elementi primari */
var(--dp-blue-medium)       /* #2FA4C4 - Pulsanti, azioni */
var(--dp-blue-intermediate) /* #41B7D1 - Hover, transizioni */
var(--dp-blue-light)        /* #60D6F4 - Accenti */
var(--dp-blue-pastel)       /* #98DFEC - Sfondi secondari */
var(--dp-bg-main)           /* #F8FBFC - Background principale */
var(--dp-card-bg)           /* #FFFFFF - Card e box */
var(--dp-border-light)      /* #E0F5FA - Bordi sottili */
var(--dp-table-alt)         /* #F0FAFC - Righe alternate tabelle */
```

### 🐛 Bug Fix
- Nessun bug noto in questa versione

### 📋 TODO Futuri
- [ ] Possibilità di personalizzare header PDF con logo azienda
- [ ] Invio PDF via email direttamente dal gestionale
- [ ] Archiviazione PDF generati (opzionale)
- [ ] Stampa batch di più DDT
- [ ] Template PDF personalizzabili

---

**Versione**: 1.1.0  
**Data Rilascio**: Ottobre 2025  
**Compatibilità**: Laravel 12+, PHP 8.2+

