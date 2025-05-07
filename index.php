<?php
// Zobrazování chyb – užitečné při ladění
ini_set('display_errors', 1);
error_reporting(E_ALL);

//  připojení k databázi a načtení funkcí
require_once ".php/db.php";        // připojen mysqli
require_once ".php/funkce.php";    // vyhodnocení nákupu

// SQL dotaz na všechny produkty z databáze
$sql = "SELECT * FROM produkty";
$result = $conn->query($sql);

// Pole – ukládáme všechny produkty z databáze
$produkty = [];
if ($result->num_rows > 0) {
    // Cyklus while projde každý řádek a uloží ho do pole
    while ($row = $result->fetch_assoc()) {
        $produkty[] = $row;
    }
}

// Proměnné pro zpracování formuláře
$vybrane = [];  // pole pro vybrané produkty z formuláře
$soucet = 0;    // celková cena

// kontrolujeme, zda byl odeslán formulář
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["produkty"])) {
    $vybrane = $_POST["produkty"];  // pole s ID produktů

    echo "<h2>Vybrané položky:</h2>";

    // Cyklus foreach pro každé ID produktu
    foreach ($vybrane as $id) {
        $id = (int)$id;  // převod na int

        // SQL dotaz na konkrétní produkt podle ID
        $stmt = $conn->prepare("SELECT * FROM produkty WHERE id = ?"); // připraví SQL dotaz s ID
        $stmt->bind_param("i", $id); // naváže proměnnou $id jako int 
        $stmt->execute(); // spustí připravený SQL dotaz
        $result = $stmt->get_result(); // získá výsledky z databáze
        $produkt = $result->fetch_assoc(); 

        // Zobrazení názvu a ceny produktu
        if ($produkt) { 
            echo htmlspecialchars($produkt["nazev"]) . " – " . $produkt["cena"] . " Kč<br>";
            // Operátor sčítání – přičteme cenu produktu do celkové ceny
            $soucet += $produkt["cena"]; // přičteme cenu produktu do celkové ceny
        }
    }

    // Volání funkce pro vyhodnocení ceny (funkce je ve .php/funkce.php)
    echo "<p><strong>Celková cena: $soucet Kč</strong></p>";
    echo "<p><strong>" . zhodnotCenu($soucet) . "</strong></p>";
}
?>

<!DOCTYPE html> 
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webový obchod</title>
    <link rel="stylesheet" href="style.css"> <!-- externí CSS soubor -->
</head>
<body>
    <div class="container"> <!-- kontejner pro centrální zarovnání obsahu -->
        <header> <!-- hlavička stránky -->
            <h1>Webový obchod</h1> <!-- název obchodu -->
        </header>
        <main> <!-- hlavní část stránky -->
            <section> <!-- sekce pro produkty -->
                <h2>Produkty</h2> <!-- nadpis sekce -->
                <form method="post"> <!-- formulář pro výběr produktů -->
                    <?php foreach ($produkty as $produkt): ?>      <!-- Cyklus foreach vypisuje všechny produkty z databáze -->
                    <label>
                        <!-- vytvoření checkboxu pro výběr produktu -->
                        <input type="checkbox" name="produkty[]" value="<?= $produkt['id'] ?>"> <!-- Checkbox, hodnota je ID produktu -->
                        <?= htmlspecialchars($produkt['nazev']) ?> – <?= htmlspecialchars($produkt['cena']) ?> Kč <!-- Zobrazení názvu a ceny produktu -->
                    </label><br>
                    <?php endforeach; ?>
                    <button type="submit">Koupit</button> <!-- tlačítko pro odeslání formuláře -->
                </form>
            </section>
        </main>
    </div>
<h1>Webový obchod</h1>

</body>
</html>


