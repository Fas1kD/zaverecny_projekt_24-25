<?php
session_start();
require_once ".php/db.php";
require_once ".php/functions.php";

$conn = connectToDb();

// Přidání do košíku
if (isset($_POST['id']) && isset($_POST['mnozstvi'])) {
    $id = $_POST['id'];
    $mnozstvi = $_POST['mnozstvi'];

    if (!isset($_SESSION['kosik'])) $_SESSION['kosik'] = [];

    if (isset($_SESSION['kosik'][$id])) {
        $_SESSION['kosik'][$id] += $mnozstvi;
    } else {
        $_SESSION['kosik'][$id] = $mnozstvi;
    }
}

// Filtrování
$kategorie = isset($_GET['kategorie']) ? $_GET['kategorie'] : "";
$zbozi = getZbozi($conn, $kategorie);
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Jednoduchý obchod</title>
</head>
<body>
    <h2>Filtr podle kategorie</h2>
    <form method="get">
        <select name="kategorie">
            <option value="">Vše</option>
            <option value="elektronika">Elektronika</option>
            <option value="oblečení">Oblečení</option>
        </select>
        <button>Filtrovat</button>
    </form>

    <h2>Zboží</h2>
    <ul>
        <?php include "zbozi.php"; ?>
    </ul>

    <h2>Košík</h2>
    <?php include "kosik.php"; ?>
</body>
</html>
