
https://github.com/gabrybyroot/Security-Login-Dashboard/assets/157123715/17d435f4-dca2-450a-8128-5a7f3b673b0e
# Security Login Dashboard

Please note that the code and information are initially provided in Italian, and translation may be required based on the desired language.

## Descrizione

Questo progetto rappresenta un sistema di autenticazione e registrazione sviluppato in PHP, progettato per essere eseguito su un server locale utilizzando XAMPP. Il progetto è incentrato sulla sicurezza, incorporando reCAPTCHA di Google per proteggere contro attacchi di tipo bot.

Login e Registrazione: Consente agli utenti di accedere attraverso un processo di login sicuro o registrarsi per creare un nuovo account.
Integrazione reCAPTCHA: Utilizza reCAPTCHA per rafforzare la sicurezza del processo di registrazione, riducendo il rischio di accessi non autorizzati automatizzati.
Area Privata: Una volta effettuato l'accesso, gli utenti possono accedere a un'area privata del sistema.

## Security

SQL Injection: Il sistema utilizza statement preparati e binding dei parametri per proteggersi da attacchi SQL injection. La preparazione della query avviene con l'uso di prepare e bind_param.
reCAPTCHA: Implementa reCAPTCHA di Google per prevenire accessi non autorizzati e attacchi di tipo bot durante la registrazione.
Password Hashing: Le password degli utenti vengono hashate utilizzando la funzione password_hash in modo da garantire la sicurezza delle credenziali.

## Requisiti

Per eseguire correttamente questo progetto, assicurati di avere installato quanto segue:
- [XAMPP](https://www.apachefriends.org/index.html) - Pacchetto che include Apache, MySQL, PHP, e Perl.
- Chiavi reCAPTCHA: Ottieni le chiavi API reCAPTCHA da [Google reCAPTCHA](https://www.google.com/recaptcha).

## Installazione

1. Scarica e installa XAMPP seguendo le istruzioni sul sito ufficiale.
2. Clona questo repository nella directory `htdocs` di XAMPP.

## Definisci info su config.php

$host = "127.0.0.1";
$user = "";
$password = "";
$db = "";

![Immagine 2024-01-27 182917](https://github.com/gabrybyroot/Security-Login-Dashboard/assets/157123715/bdf6183a-660b-490a-8d58-3c2cee9ced7d)
![Immagine 2024-01-27 180238](https://github.com/gabrybyroot/Security-Login-Dashboard/assets/157123715/dd635904-58ce-4e66-836f-afc8604142b5)

