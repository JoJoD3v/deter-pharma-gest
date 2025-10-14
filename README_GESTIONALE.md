# DeterPharma Gest - Gestionale CMS Laravel

Gestionale CMS in Laravel per la gestione di clienti, lavori svolti e DDT (Documenti di Trasporto) per una ditta che si occupa di vendita prodotti di sanificazione o servizi di sanificazione ambienti.

## Tecnologie Utilizzate

- **Laravel 12** - Framework PHP
- **Bootstrap 5.3** - Framework CSS (via CDN, senza Vite/Node)
- **SQLite** - Database (configurabile per MySQL/PostgreSQL)
- **Bootstrap Icons** - Icone

## Caratteristiche Principali

### 1. Sistema di Autenticazione
- Login con credenziali admin predefinite
- Gestione sessioni utente
- Protezione delle rotte con middleware

### 2. Dashboard
- Statistiche generali (Utenti, Clienti, DDT)
- Visualizzazione ultimi DDT creati
- Accesso rapido alle sezioni principali

### 3. Gestione Utenti
- CRUD completo per utenti
- Campi: Nome, Cognome, Email, Password, Ruolo (Admin/Operatore)
- Validazione email univoca
- Protezione eliminazione account corrente

### 4. Gestione Clienti
- CRUD completo per clienti
- Tipo cliente: Persona Fisica o Giuridica
- Campi:
  - **Persona Fisica**: Nome, Cognome, Codice Fiscale
  - **Persona Giuridica**: Ragione Sociale, Partita IVA
  - Telefono, Email, Indirizzo
- Visualizzazione DDT associati al cliente

### 5. Gestione DDT (Documenti di Trasporto)
- CRUD completo per DDT
- Numerazione automatica progressiva (DDT000001, DDT000002, ecc.)
- Form di creazione con:
  - **Selezione Cliente**: Cliente registrato o inserimento manuale
  - **Prodotti**: Gestione dinamica prodotti con pulsante "+" per aggiungere
    - Codice, Nome Prodotto, Unità di Misura, Quantità
  - **Dettagli Trasporto**:
    - Causale trasporto
    - Trasporto a cura di (Mittente/Vettore/Destinatario)
    - Data e ora inizio trasporto
    - Trasporto Ditta
    - Aspetto esteriore beni (Taniche/Cartone/A vista)
    - Numero colli e Peso
    - Porto
    - Annotazioni

## Installazione

### Prerequisiti
- PHP >= 8.2
- Composer
- SQLite (o MySQL/PostgreSQL)

### Passi di Installazione

1. **Clona il repository** (se applicabile)
   ```bash
   cd deter-pharma-gest
   ```

2. **Installa le dipendenze**
   ```bash
   composer install
   ```

3. **Configura l'ambiente**
   Il file `.env` è già configurato con SQLite. Se vuoi usare MySQL/PostgreSQL, modifica:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nome_database
   DB_USERNAME=username
   DB_PASSWORD=password
   ```

4. **Esegui le migrazioni**
   ```bash
   php artisan migrate
   ```

5. **Popola il database con l'utente admin**
   ```bash
   php artisan db:seed
   ```

6. **Avvia il server**
   ```bash
   php artisan serve
   ```

7. **Accedi all'applicazione**
   - URL: http://127.0.0.1:8000
   - Email: admin@deterpharma.it
   - Password: admin123

## Credenziali di Accesso Predefinite

**Admin:**
- Email: `admin@deterpharma.it`
- Password: `admin123`

⚠️ **IMPORTANTE**: Cambia la password admin dopo il primo accesso!

## Struttura del Database

### Tabella `users`
- id, name, cognome, email, password, ruolo (admin/operatore)

### Tabella `clientes`
- id, tipo_cliente (fisica/giuridica), nome, cognome, ragione_sociale
- codice_fiscale, partita_iva, telefono, email, indirizzo

### Tabella `d_d_t_s`
- id, numero_ddt (auto-generato), cliente_id
- codice_cliente, codice_fiscale_piva
- causale_trasporto, trasporto_a_cura, data_ora_trasporto
- trasporto_ditta, aspetto_beni, num_colli, peso, porto, annotazioni

### Tabella `prodotto_d_d_t_s`
- id, ddt_id, codice, nome_prodotto, unita_misura, quantita

## Funzionalità Implementate

✅ Sistema di autenticazione con Laravel UI
✅ Dashboard con statistiche
✅ CRUD Utenti con ruoli (Admin/Operatore)
✅ CRUD Clienti (Persona Fisica/Giuridica)
✅ CRUD DDT con gestione prodotti dinamica
✅ Numerazione automatica DDT
✅ Relazioni tra Cliente e DDT
✅ Validazione form completa
✅ Messaggi di successo/errore
✅ Layout responsive con Bootstrap 5
✅ Sidebar di navigazione
✅ Paginazione risultati
✅ Protezione rotte con middleware auth

## Note Tecniche

- **Bootstrap via CDN**: Non richiede compilazione con Vite/Node
- **SQLite**: Database leggero, ideale per sviluppo e piccole installazioni
- **Validazione**: Tutti i form hanno validazione lato server
- **Sicurezza**: Password hashate, protezione CSRF, middleware auth
- **Relazioni Eloquent**: Cliente hasMany DDT, DDT hasMany ProdottoDDT

## Possibili Miglioramenti Futuri

- [ ] Esportazione DDT in PDF
- [ ] Ricerca avanzata e filtri
- [ ] Statistiche e report
- [ ] Gestione permessi più granulare
- [ ] API REST per integrazioni
- [ ] Backup automatico database
- [ ] Log attività utenti
- [ ] Notifiche email

## Supporto

Per problemi o domande, contatta l'amministratore del sistema.

## Licenza

Proprietario - DeterPharma

---

**Versione**: 1.0.0  
**Data**: Ottobre 2025  
**Sviluppato con**: Laravel 12 + Bootstrap 5

