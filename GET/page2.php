<?php
//GET est un protocole HTTP 
// l'outil php est une superglobale => $_GET
// les superglobales sont des tableaux array
// $_GET existe toujours

echo '<pre>'; var_dump($_GET); echo'</pre>';
// faire un affichage propre (echo) des informations présente dans la superglobale $_GET
if (isset($_GET['article']) &&
    isset($_GET['couleur']) &&
    isset($_GET['quantite']) &&
    isset($_GET['prix'])
){
    echo 'Votre avez commander un : ' . ($_GET['article']) . '<br>';
    echo 'De la couleur : ' . ($_GET['couleur']) . '<br>';
    echo 'Vous en voulez : ' . ($_GET['quantite']) . '<br>';
    echo 'Votre prix total est de  : ' . ($_GET['prix']) . '<br>';
}
echo '<hr>';

foreach($_GET AS $i => $v){
    echo 'Votre ' . ucfirst($i) . ' : ' . $v . '<br>';
 }

// syntaxe dans l'URL pour passer des informations  dans GET 
// s'il y a un  "?" dans l'url, avant c'est l'adresse au sens propre, après le "?" ceux sont des informations
// complémentaires qu l'on peut récuperer dans $_GET
// ?indice1=valeur1&indice2=valeur2&indice3=valeur3
?>

<h1 style="padding : 20px; color: blue; background-color: yellow">La page 2</h1>
<a href="page1.php">aller en page 1</a>