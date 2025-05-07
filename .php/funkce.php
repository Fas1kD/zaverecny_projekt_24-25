<?php
function zhodnotCenu($celkem) {
    if ($celkem > 25000) return "To bude velký nákup!";
    elseif ($celkem > 10499) return "Střední nákup";
    else return "Malý nákup";
}
?>
