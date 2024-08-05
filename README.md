# Call me Winde test

## Descrizione progetto

### Domanda 1.
In questo caso l'applicativo da sviluppare e molto semplice, quindi terrei fede alla truttura MVC di laravel, che offre sicuramente i svuoi vantaggi in termine di organizzazione del codice, è fondamentale l'utilizzo di Dependency Injection o Facade, per permettere anche una scrittura di test in modo più agevole.

### Domanda 2.
L'ulitizzo in modalità ascinrono offre sicuramente i suoi vantaggi come, un'interfaccia utente più reattiva, tutte le operazioni intensive vengono eseguite in background di contro è più complesso nello sviluppo
Laravel ha diverse funzionalità per l'implementazione tra cui:
- code
- Jobs 
- Scheduler per programmare attività ricorrenti.

La modalita sincrona, invece è sicuramente più semplice nello sviluppo e permette di avere i dati aggiornati nell'immediato al load del DOM
In questo caso parmialo di richieste HTTP

### Domanda 3.
Per inviare una mail ogni mattina, oltre al servizio mailer di laravel, utilizziamo uno scheduler job in modo da far partire la lavorazione in modo pianificato

### Domanda 4.
Per salvare i dati in DB ( in questo piccolo progetto è stato utilizzato sqlite ), creiamo le migrazione e utiliziamo Eloquet per la manipolazione e la selezione di dati semplici

### Domanda 5.
In lavarel non credo esista qualcosa di preciso, ma facendo una ricerca si potrebbe usare un package come torann/geoip per filtrare gli utenti, configurando un apposito middleware in modo da fare da filtro.
Però onestamente utilizzerei tecnologie diverse come CloudFront sicuramente più efficace e sicuro rispetto allo sviluppo di una situazione custom




