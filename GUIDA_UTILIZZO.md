# Guida all'Utilizzo - DeterPharma Gest

## Accesso al Sistema

1. Apri il browser e vai su: **http://127.0.0.1:8000**
2. Inserisci le credenziali:
   - **Email**: admin@deterpharma.it
   - **Password**: admin123
3. Clicca su "Login"

## Dashboard

Dopo il login, verrai reindirizzato alla Dashboard dove potrai vedere:
- Numero totale di Utenti, Clienti e DDT
- Lista degli ultimi 5 DDT creati
- Menu laterale per navigare tra le sezioni

## Gestione Utenti

### Visualizzare gli Utenti
1. Clicca su "Gestione Utenti" nel menu laterale
2. Vedrai la lista di tutti gli utenti con Nome, Cognome, Email e Ruolo

### Creare un Nuovo Utente
1. Clicca sul pulsante "Nuovo Utente"
2. Compila il form:
   - Nome *
   - Cognome *
   - Email * (deve essere univoca)
   - Ruolo * (Admin o Operatore)
   - Password * (minimo 6 caratteri)
   - Conferma Password *
3. Clicca su "Salva Utente"

### Modificare un Utente
1. Nella lista utenti, clicca sull'icona matita (✏️)
2. Modifica i campi desiderati
3. Per cambiare la password, inseriscila nei campi "Nuova Password"
4. Clicca su "Aggiorna Utente"

### Eliminare un Utente
1. Nella lista utenti, clicca sull'icona cestino (🗑️)
2. Conferma l'eliminazione
3. **Nota**: Non puoi eliminare il tuo account corrente

## Gestione Clienti

### Visualizzare i Clienti
1. Clicca su "Gestione Clienti" nel menu laterale
2. Vedrai la lista di tutti i clienti con tipo, nome, CF/P.IVA, telefono ed email

### Creare un Nuovo Cliente
1. Clicca sul pulsante "Nuovo Cliente"
2. Seleziona il **Tipo Cliente**:
   - **Persona Fisica**: Compila Nome, Cognome, Codice Fiscale
   - **Persona Giuridica**: Compila Ragione Sociale, Partita IVA
3. Compila i campi opzionali:
   - Telefono
   - Email
   - Indirizzo
4. Clicca su "Salva Cliente"

### Modificare un Cliente
1. Nella lista clienti, clicca sull'icona matita (✏️)
2. Modifica i campi desiderati
3. Clicca su "Aggiorna Cliente"

### Visualizzare Dettagli Cliente
1. Nella lista clienti, clicca sull'icona occhio (👁️)
2. Vedrai tutti i dettagli del cliente e i DDT associati

### Eliminare un Cliente
1. Nella lista clienti, clicca sull'icona cestino (🗑️)
2. Conferma l'eliminazione
3. **Nota**: I DDT associati non verranno eliminati, ma il riferimento al cliente sarà rimosso

## Gestione DDT (Documenti di Trasporto)

### Visualizzare i DDT
1. Clicca su "Gestione DDT" nel menu laterale
2. Vedrai la lista di tutti i DDT con numero, cliente, data trasporto e causale

### Creare un Nuovo DDT
1. Clicca sul pulsante "Nuovo DDT"

#### Sezione Cliente
2. Scegli il tipo di inserimento:
   - **Cliente già registrato**: Seleziona dalla lista
   - **Inserimento manuale**: Inserisci Codice Cliente e CF/P.IVA manualmente

#### Sezione Prodotti
3. Compila i dati del primo prodotto:
   - Codice (opzionale)
   - Nome Prodotto * (obbligatorio)
   - Unità di Misura (es. Kg, Lt, Pz)
   - Quantità * (obbligatorio, default 1)
4. Per aggiungere altri prodotti, clicca sul pulsante "Aggiungi Prodotto" (+)
5. Per rimuovere un prodotto, clicca sull'icona cestino (🗑️) nella riga del prodotto

#### Sezione Dettagli Trasporto
6. Compila i campi (tutti opzionali):
   - **Causale Trasporto**: Motivo del trasporto
   - **Trasporto a cura di**: Mittente, Vettore o Destinatario
   - **Data e Ora Inizio Trasporto**: Seleziona data e ora
   - **Trasporto Ditta**: Nome della ditta di trasporto
   - **Aspetto Esteriore dei Beni**: Taniche, Cartone o A vista
   - **Numero Colli**: Numero di colli trasportati
   - **Peso**: Peso in Kg
   - **Porto**: Informazioni sul porto
   - **Annotazioni**: Note aggiuntive

7. Clicca su "Salva DDT"

**Nota**: Il numero DDT viene generato automaticamente in formato DDT000001, DDT000002, ecc.

### Visualizzare Dettagli DDT
1. Nella lista DDT, clicca sull'icona occhio (👁️)
2. Vedrai tutti i dettagli del DDT inclusi:
   - Informazioni cliente
   - Dettagli trasporto
   - Lista prodotti
   - Annotazioni

### Modificare un DDT
1. Nella lista DDT, clicca sull'icona matita (✏️)
2. Modifica i campi desiderati
3. Clicca su "Aggiorna DDT"
4. **Nota**: Il numero DDT non può essere modificato

### Eliminare un DDT
1. Nella lista DDT, clicca sull'icona cestino (🗑️)
2. Conferma l'eliminazione
3. **Nota**: Verranno eliminati anche tutti i prodotti associati

## Funzionalità Aggiuntive

### Paginazione
- Tutte le liste (Utenti, Clienti, DDT) sono paginate
- Usa i pulsanti in fondo alla lista per navigare tra le pagine

### Messaggi di Conferma
- Ogni operazione di successo mostra un messaggio verde in alto
- Gli errori vengono mostrati in rosso con i dettagli

### Logout
1. Clicca sul tuo nome in alto a destra
2. Seleziona "Logout"

## Consigli Utili

### Per i DDT
- Crea prima i clienti che usi frequentemente per velocizzare la creazione dei DDT
- Usa l'inserimento manuale solo per clienti occasionali
- Compila sempre almeno un prodotto (obbligatorio)
- Salva i DDT con annotazioni dettagliate per riferimenti futuri

### Per i Clienti
- Inserisci sempre il Codice Fiscale o la Partita IVA per facilitare la ricerca
- Compila telefono ed email per avere contatti rapidi
- Per le aziende, usa "Persona Giuridica" e compila la Ragione Sociale

### Sicurezza
- Cambia la password admin dopo il primo accesso
- Crea utenti con ruolo "Operatore" per il personale che non deve gestire utenti
- Fai logout quando non usi il sistema

## Risoluzione Problemi

### Non riesco ad accedere
- Verifica di aver inserito correttamente email e password
- Controlla che il server sia avviato (php artisan serve)

### Errore durante il salvataggio
- Controlla che tutti i campi obbligatori (con *) siano compilati
- Verifica che l'email utente non sia già in uso
- Per i DDT, assicurati di aver inserito almeno un prodotto

### La pagina non si carica
- Verifica che il server Laravel sia in esecuzione
- Controlla la console per eventuali errori
- Prova a ricaricare la pagina (F5)

## Supporto

Per assistenza tecnica o segnalazione bug, contatta l'amministratore del sistema.

---

**Versione Guida**: 1.0  
**Ultimo Aggiornamento**: Ottobre 2025

