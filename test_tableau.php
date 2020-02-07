<?php
// Exercice faire un tableau qui affiche de 0 à 90 sur 10 lignes en PHP // une boucle dans une boucle ou utiliser le modulo pour le faire en une boucle

echo '<table style="border-collapse: collapse; width: 50%; background: dodgerblue; margin: 0 auto;" border="1">';
$b = 0;
for ($i = 0; $i <10; $i++){
    echo '<tr>';
    for($a = 0; $a <10;$a++) {echo '<td>'. $b++ .'</td>';}
    echo '</tr>';
}
echo '</table>';
