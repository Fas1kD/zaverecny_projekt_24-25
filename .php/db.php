<?php
function connectToDb() {
    $conn = new mysqli("localhost", "fasorad", "Agama987.Qe23:", "fasorad_zaverecny_projekt_24-25");
    if ($conn->connect_error) {
        die("Chyba připojení: " . $conn->connect_error);
    }
    return $conn;
}
?>
