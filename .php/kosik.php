<?php
$i = 0;
while ($i < 1) {
    if (!isset($_SESSION['kosik']) || empty($_SESSION['kosik'])) {
        echo "Košík je prázdný.";
    } else {
        vypisKosik($_SESSION['kosik'], $conn);
    }
    $i++;
}
?>
