<?php

$host = "127.0.0.1";
$user = "";
$password = "";
$db = "";

$connessione = new mysqli($host, $user, $password, $db);

if($connessione->connect_error){
    die("Errore durante la connessione: " . $connessione->connect_error);
}

?>
