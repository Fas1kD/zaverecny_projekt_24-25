<?php
session_start();

// Připojení k databázi
$servername = "localhost";      //název serveru
$username = "fasorad";          //jmeno uživatele (defaultně je "root")
$password = "Agama987.Qe23:";   //heslo (pro local host je obvykle prázdné)
$dbname = "fasorad_zaverecny_projekt_24-25";     //název databázes

// Vytvoření připojení
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrola připojení
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
