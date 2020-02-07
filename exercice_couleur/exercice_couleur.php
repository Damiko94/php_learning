<?php
// faire en sorte que la couleur sur le body, change à chaque rafraichissement de page.
// rand() permet de recuperer un chiffre aléatoire entre deux entier fourni en argument
$couleur = '';/*
for($i = 0; $i < 6; $i++) {
    $couleur.= rand(0, 9);
}*/
// pour avoir les lettres
$tab = array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f');
echo '<pre>'; print_r($tab); echo '</pre>';
for($i = 0; $i < 6; $i++) {
    $couleur.= $tab[rand(0, 15)];
}
echo $couleur;
echo '<br>' . count($tab);
?>
<body style="background-color: #<?php echo $couleur; ?>"></body>