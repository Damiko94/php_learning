<?php
function separateur(){ echo '<hr><hr><hr>';}
// 1- récupérer 5 images en les rennomant de cette manière :
// image1.jpg image2.jpg image3.jpg image4.jpg image5.jpg 
// 2- Afficher une image avec un echo <ig src="">
echo '<h2>Afficher une image avec un echo</h2>';
echo '<img src="images/image1.jpg">';
separateur();
// 3- Afficher Afficher 5 fois l'image1 avec un seul <img src=""> (boucle)
for($i = 0; $i <5; $i++){
    echo '<img src="images/image1.jpg">';
}
separateur();
// 4- Aficher les 5 images avec un seul <img src=""> (boucle)
for($i = 1; $i <6; $i++){
    echo '<img src="images/image'.$i.'.jpg">';
}  
separateur();
$images= array('image1.jpg', 'image2.jpg', 'image3.jpg', 'image4.jpg', 'image5.jpg',);
echo '<pre>'; var_dump($images); echo '</pre>';
foreach($images AS $ligne) {
    echo '<img src="images/' .$ligne. '"width="300">';
}

// rand() est une fonction prédéfinie permettant de renvoyer un entier aléatoire compris entre 2 entiers fournies en argument.  
echo rand(1, 5);