<style>
h2 { padding: 20px; background-color: #333; color: white;}
</style>
<h2>Ecriture & Affichage</h2>
<!-- Tout d'abord, il est possible d'écrire de l'html dans un fichier .php 
/!\ Attention l'inverse n'est pas possible -->

<?php //double slash égal commentaire, ATENTION NE JAMAIS RIEN COLLER A LA BALISE PHP

// balise de fermeture :
?>

<?php

// les bonnes pratiques de php https://phptherightway.com/
// les bons standarts https://www.php-fig.org/psr/
// stack overflow, phph.net, reddit

//SOMMAIRE
// - Instructions d'affichage
// - Variables: type, déclaration et affectation
// - Concatenation
// - Guillemets & apostrophes
// - Constantes
// - Conditions et opérateurs de comparaison
// - Fonctions prédéfinies
// - Fonctions utilisateur
// - Boucles
// - Inclusion
// - Array
// - Classes & objets

// - Instructions d'affichage +++++++++++++++++++++++++++++
echo 'Bonjour'; // echo est une instruction nous permettant de générer un affichage dans le code source.
echo '<br>'; //il est possible de générer du html
echo 'Bienvenue';

print '<hr>print permet également de générer un affichage';
// print est une autre instruction du langage nous permettant de générer des affichages. Pour le cours nous utiliserons echo

echo '<h2>Commentaires</h2>';
// ceci est un commentaire sur une seule ligne
# autre façon de faire un commentaire sur une seule ligne

/*
ceci
est un commentaire
sur plusieurs lignes.
*/
?>
<?= 'Balise permettant de générer un affichage'; ?>
<?php
echo'<h2>Variables : types  / déclarations / affectations</h2>';
// definition : une variable est un espace nommé permettant de conserver une valeur.
// déclaration d'une variable en php avec le signe $
// caractères autorisés : a-z A-Z 0-9 _ en revanche, une variable ne peut pas commencer par un chiffre.
// $a1 => ok
// $1a => non ok
// $_a => ok
// $a_b_c => ok

$a = 127; // déclaration de la variable a et affectation de la valeur 127
echo gettype($a); // gettype() est une fonction prédéfinie mous permettant de connaitre le type d'une information.
echo'<br>';
$a = 1.5; // on change la valeur contenue dans la variable a
echo gettype($a); // double (chiffre à virgule)

echo '<br>';
$b = 'une chaine';
echo gettype($b); // string (une chaine de caractère)

echo '<br>';
$b = '127';
echo gettype($b); //string

echo '<br>';
$c = true; // ou false ou TRUE ou FALSE
echo gettype($c); // boolean (vrai / faux - 1 / 0)

echo'<h2>Concatenation</h2>';
// la concatenation mous permet d'assembler des chaines de caractères les unes avec les autres.
// en PHP, ma concatenation se fait avec le point . que l'ont peut toujours traduire par "suivi de"
$x = 'Bonjour';
$y = 'Tout le monde';
echo $x . ' ' . $y . '<br>';

// differnece entre guillemets & apostrophes
echo "$x $y <br>"; // dans des guillemets une variable est reconnue et enterpretée !
echo '$x $y <br>';

echo $x , ' ' , $y, '<br>'; // il est possible d'utiliser la virgule pour la concaténation.
// /!\ ne fonctionne pas avec l'instruction print !!!
// concaténation lors de l'affectation
$prenom = 'Bruno';
$prenom = 'Marie';
echo $prenom . '<br>'; // affiche Marie

$prenom2 = 'Bruno';
$prenom2 .= ' Marie'; // équivaut à écrire : $prenom2 = $prenom2 . 'Marie';
echo $prenom2; // affiche Bruno Marie

echo '<h2>Les constantes et les constantes magiques</h2>';
// Une constante comme une variable permet de conserver une valeur sauf que comme son nom l'indique, cette valeur ne pourra pas etre modifiée durant l'execution du script.
// pour déclarer une constante

// par convention, une constante s'écrit en majuscule
define("CAPITALE", 'Paris'); // define(nom_de_la_constante, sa_valeur);
//appel de la constante :
echo CAPITALE . '<br>';
// constantes magiques
echo __FILE__ . '<br>'; // le chemin complet du fichier actuel
echo __LINE__ . '<br>'; // le numéro de la ligne

// echo __FUNCTION__ . '<br>'; // le nom de la fonction concernée
// echo __CLASS__ . '<br>'; // le nom de la classe concernée
// echo __METHODE__ . '<br>'; // le nom de la methode concernée

echo '<h2>Exercice variable</h2>';
// Exercice : Afficher Bleu-Blanc-Rouge en mettant les couleurs dans des variables !
$a = '<span style="color :blue">Bleu</span>';
$b = '<span style="color : white">Blanc</span>';
$c = '<span style="color : red">Rouge</span>';
$t = '-';
echo '<div style="background: black">' . $a . $t . $b . $t . $c. '</div><br>';

echo '<h2>Opérateurs arithmétiques</h2>';
$a = 10;
$b = 2;
echo $a + $b . '<br>'; // affiche 12
echo $a - $b . '<br>'; // affiche 8
echo $a * $b . '<br>'; // affiche 20 
echo $a / $b . '<br>'; // affiche 5

//modulo (le restant de la division en entier)
echo $a % $b . '<br>'; // affiche 0

// raccourci => opération/affectations
$a = 10; $b = 2;
$a += $b; // équivaut à $a = $a + $b; // 12
$a -= $b; // équivaut à $a = $a - $b; // 10
$a /= $b; // équivaut à $a = $a * $b; // 5
$a *= $b; // équivaut à $a = $a / $b; // 10 
$a %= $b; // équivaut à $a = $a % $b; // 0

echo '<br>Structure conditionnelle : (if / elseif / else) & les opérateurs de comparaison</br>';
// isset & empty
// isset() teste si une variable est définie (si elle existe) sans regarder la valeur à l'intérieur
// empty() teste si une variable existe mais en plus vérifie si elle est vide.

$var1 = 0; // ou '' ou false
// on teste l'existence de la variable var1
if(isset($var1)){
    echo 'la variable var1 existe <br>';
} else {
    echo 'La variable var1 n\'existe pas <br> ';
}

// on teste l'éxistence de la variable var1 mais aussi si elle est vide
if(empty($var1)) {
    echo 'La variable var1 n\'existe pas ou elle est vide<br>';
} else {
    echo 'La variable existe est n\'est pas vide <br>';
}
 // if / elseif / else
 $a = 10; $b = 5; $c = 2;
 if($a > $b) { // si la valeur de a est strictement supérieur à b
    echo $a . ' est bien supérieur à '. $b .'<br>';
 } else { // sinon
    echo 'a n\'est pas supérieur à b<br>';
 }
// meme condition => autre écriture
if($a > $b) : 
    echo $a . ' est bien supérieur à '. $b .'<br>';
 else : 
    echo $a . ' n\'est pas supérieur à ' . $b . '<br>';
 endif;

// meme condition => autre écriture
// possible uniquement s'il y a une seule instruction liée au if et au else
if($a > $b) 
    echo $a . ' est bien supérieur à '. $b .'<br>';
 else
    echo $a . ' n\'est pas supérieur à ' . $b . '<br>';

// Plusieurs conditions obligatoires => &&
$a = 10; $b = 5; $c = 2;
if($a > $b && $b > $c) {
    echo 'Ok pour les deux conditions<br>';
}

// l'une ou l'autre des conditions
if($a > 20 || $b > $c) {
    echo 'Ok pour au moins une des deux conditions<br>';
} else {
    echo 'Aucune des deux conditions n\'est vrai<br>';
}

// elseif (sinon si)
if($a == 8) {
    echo 'Réponse 1<br>';
} elseif($a != 10) {
    echo 'Réponse 2<br>';
} else {
    echo 'Réponse 3<br>';
}

// autre façon d'écrire des conditions : forme contractée => ternaire
echo ($a == 10) ? 'La valeur de a est 10<br>' : 'La valeur de a est différente de 10<br>';
// le ? represente le if
// les : represente le else
// meme conditions en écriture classique
if ($a == 10) {
    echo 'La valeur de a est 10<br>';
} else {
    echo 'La valeur de a est différente de 10<br>';
}

// les opérateurs de comparaison
$a = 1;
$b ='1';

if ($a == $b) {
    echo 'la variable "a" et la variable "b" on la meme valeur<br>';
}

if ($a === $b) {
    echo 'la variable "a" et la variable "b" on la meme valeur et le meme type<br>';
} else {
    echo ' a et b ont soit une valeur différente ou un type différent<br>';
}
/*
    = Affectation d'une valeur
    == Comparaison des valeurs uniquement
    != Différent en termes de valeur
    === Comparaison des valeurs et des types (comparaison stricte)
    !== différent en termes de valeur et de type (comparaison stricte)
    > strictement supérieur
    >= supérieur ou égal
    < strictement inférieur
    <= inférieur ou égal
*/

echo '<h2>Conditions switch()</h2>';
// les 'case' represente des cas différents dans lesquel nous pouvons potentiellement tomber.
$couleur = 'jaune';
switch($couleur) {
    case 'bleu' : 
        echo 'Vous aimez le bleu<br>';
    break;
    case 'vert' : 
        echo 'Vous aimez le vert<br>';
    break;
    case 'rouge' : 
        echo 'Vous aimez le rouge<br>';
    break;
    default :
        echo 'Vous n\'aimez ni le Bleu, ni le vert, ni le rouge.<br>';
    break;
}

// Exercice : fair ela meme condition avec des if / elseif / else
if($couleur == 'bleu') {
    echo 'Vous aimez le bleu<br>';
} elseif($couleur == 'vert') {
    echo 'Vous aimez le vert<br>';
} elseif($couleur == 'rouge') {
    echo 'Vous aimez le rouge<br>';
} else {
    echo 'Vous n\'aimez ni le Bleu, ni le vert, ni le rouge.<br>';
}

echo'<h2>Les focntions prédéfinies</h2>';
// une fonction prédéfinie est inscrite au langage, le développeur ne fait que l'exécuter.

echo'<b>Date : </b><br>';
echo date('d/m/Y à H:i:s') . '<br>';
// d pour le numéro du jour
// m pour le numéro du mois
// Y pour l'année en 4 chiffres

//Fonctions de traitements de chaine (string) : strpos() / strlen() / substr()

// strpos()
$email = 'jean@gmail.com';
echo strpos($email, '@') . '<br>'; // on obtient un entier représentant la position du premier caractère du deuxième argument dans la chaine fournie en premier argument
$email2 = 'Bonjour';
echo strpos($email2, '@') . '<br>'; // cet ligne n'affiche rien, mais on récupère quelque chose.
// on récupère false
// pour voir le false on utilise vardump qui est une instruction d'affichage améliorée
echo '<pre>'; var_dump(strpos($email2, '@')); echo '</pre>';
/*
strpos (chaine_ou_on_cherche, valeur_qu'on_cherche);
Succes : on obtient un entier (int) représentant la position
Echec : on obtient un booleen false
*/

// strlen
$phrase = 'Lorem ipsum';
echo strlen($phrase) . '<br>'; // affiche la taille d'une chaine de caractère

// strlen compte la taille d'une chaine en terme d'octet, 1 caractère = 1 octet sauf pour les commentaires spéciaux
// pour la pris een compte des caractère spéciaux : iconv_strlen()
// iconv_strlen() compte la taille d'une chaine en terme de caractère et non pas d'octet.
// Si un caractère vaut plus d'1 octet cette fonction le comptera comme valant 1 octet
 // exemple :
 echo strlen ('ç') . '<br>';
 echo iconv_strlen ('ç') . '<br>';
 /*
 succes : un entier (int)
 echec : 0
 */
 //substr()
 $texte = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolor optio non ratione ipsam ea hic earum corporis tenetur dolorum vero nulla explicabo, tempore illum veritatis quidem esse, neque autem ullam.";
 echo substr($texte, 0, 20) . '... <a href="">Lire la suite</a><br>';
 // substr(la_chaine_a_couper, position_de_depart, nombre_de_caractere_a_renvoyer)
 // iconv_substr() // pour la prise en charge des caractères spéciaux

 echo '<h2>Fonctions utilisateur</h2>';
 // fonction déclarée et exécutée par le développeur

 // déclaration d'une fonction permettant d'afficher 3 hr dans la page, cette fonction ne recoit pas d'argument
 function separateur() {
     echo '<hr><hr><hr>';
 }
 separateur();

 // fonction avec argument : les arguments sont des paramètres fournis à la fonction permettant de completer ou modifier un traitement
 function bonjour ($qui) {
     return 'Bonjour <b>' . $qui . '</b><br>';
     // la ligne suivante ne sera jamais exécutée car elle se trouve après un return.
     // Lorsque l'on tombe sur un return dans une fonction,on sort immédiatement de la fonction !
     echo 'TEST';
 }
 // avec un return l'information est renvoyée, si l'on veut un affichage il faut un echo pour appeler la fonction
 echo bonjour('Marie'); // si un argument attendu, nous sommes obligé de le fournir
 $pseudo = 'Mathieu';
 echo bonjour($pseudo); // il est possible de fournir un argument sous forme de variable.

 // fonction permettant de calculer un tarif ttc
 function applique_tva($valeur) {
     // pour une tva à 20%
     return $valeur * 1.2;
 }
 echo '1000 euros avec 20% de tva font : ' . applique_tva(1000) . 'euros TTC<br>';
 echo '365454 euros avec 20% de tva font : ' . applique_tva(365454) . 'euros TTC<br>';

 // exercice : fair eun focntion similaire, mais permettant à l'utilisateur de choisir le taux de tva appliqué
 function applique_tva_variable($valeur, $taux) {
    return $valeur . ' avec un taux de ' . $taux . '% vaut : ' . ($valeur * (($taux+100)/100)) .' euros<br>';
}
echo applique_tva_variable(1000,15.5);

function applique_tva_taux($valeur, $taux) {
    return $valeur * $taux;
    // return $valeur * (1+($taux/100))
}
// la meme fonction que précedemment en rendant l'argument facultatif
function applique_tva_tau($valeur, $taux = 1.2) {
    return $valeur * $taux;
    // return $valeur * (1+($taux/100))
}
echo applique_tva_tau(1000) . '<br>';
// avec un seul argument, $taux a sa valeur par defaut (1.2)
echo applique_tva_tau(1000, 1.055) . '<br>';
// avec deux argument, le deuxieme remplace la valeur par defaut $taux (ici 1.055)
separateur();

meteo('hiver', 0);
// il est possible d'exécuter une fonction avant de l'avoir déclarée.
// ce n'est pas possible avec une variable
function meteo($saison, $temperature){
    $deg = 'degré';
    $pre = 'en';
    if($temperature < -1 || $temperature > 1) { $deg = 'degrés';}
    if($saison == 'printemps') { $pre = 'au';}
    echo 'Nous sommes ' . $pre . ' ' . $saison . ' et il fait ' . $temperature . ' ' . $deg . '<br>';
}
meteo('été', 30);
meteo('printemps', 18);
meteo('automne', 1);
separateur();

function meteo2($saison, $temperature){
    if($saison == 'printemps') {
        echo 'Nous sommes au ' . $saison;
    }
    else {
        echo 'Nous sommes en ' . $saison;
    }
    if($temperature > -2 && $temperature <2){
        echo ' et il fait ' . $temperature . ' degré<br>';
    }else {
        echo ' et il fait ' . $temperature . ' degrés<br>';
    }
}

// La portée des variables (scope)
// espace global & local
// Le script complet répresente l'espace global
// dans une fonction nous sommes en espace dit local !
function jour_semaine(){
    $jour = 'jeudi'; // variable locale
    return $jour;
}
jour_semaine();
echo $jour . '<br>'; // erreur car la variable $jour n'existe que dans la fonction //Notice: undefined variable : jour

$recup = jour_semaine();
echo $recup . '<br>';
echo jour_semaine() .'<br>';

// ESPACE GLOBAL
$pays = 'France';
function affichage_pays(){
    global $pays; // avec le mot clé global il est possible de récuperer une variable déclarée dasn l'espace global sinon la ligne en dessous afficherait une erreur
    echo $pays . '<br>';
}
affichage_pays();

echo '<h2>Structure itérative : les boucles</h2>';

// while() {} tant que
$i = 0; // valeur de départ
while ($i <10) { // condition d'entrée
    echo $i . ' - ';
    $i++; // $i = $i +1; incrémentation
    // $i--; // $i = $i - 1; // décrémentation
}
echo '<br>';
$i = 0; // valeur de départ
while ($i <10) {
    if ($i < 9){echo $i . ' - ';}
    else { echo $i;}
    $i++;
}

echo '<br>';
separateur();
// Boucle FOR () {}
// for (valeur_de_depart; condition_d'entrée; incrémentation)

for($i = 0; $i < 10; $i++) {
    echo $i;
}
separateur();
// champs année pour un formulaire
echo '<select> style="width: 210px"; height: 30px; border: 1px solid #333;">';
for($i = date('Y'); $i >= 1930; $i-- ) {
    echo '<option>' . $i . '</option>';
}
echo '</select>';
separateur();

echo '<table style="border-collapse: collapse; width: 50%; background: dodgerblue; margin: 0 auto;" border="2"><tr>';
for($i = 0; $i < 10; $i++) {
    echo '<td style="text-align: center;">' . $i . '</td>';
}
echo '</tr></table>';

echo '<h2>Inclusion de fichier</h2><br>';
// Création d'un fichier exemple exemple.inc.php et copier coller le texte dedans.
echo '<b>Appel du fichier avec include</b> : <br>';
include 'exemple.inc.php';
separateur();
 echo '<b>Appel du fichier avec include_once</b> : <br>';
 include_once 'exemple.inc.php';
 // include_once vérifie si le fichier a déja été appelé, si c'est le cas le fichier n'est pas rappelé sinon on l'appele.
 separateur();
 
 echo '<b>Appel du fichier avec include</b> : <br>';
require 'exemple.inc.php';
separateur();
 echo '<b>Appel du fichier avec include_once</b> : <br>';
 require_once 'exemple.inc.php';
 // require_once vérifie si le fichier a déja été appelé, si c'est le cas le fichier n'est pas rappelé sinon on l'appele.
 separateur();

 echo '<h2>les tableaux de données array</h2><br>';
 // un tableau est un peu comme une variable simple, mais au lieu de contenir une seule valeur, un tableau contient un ensemble de tableau.
 // déclaration d'un tableau array
 $liste = array('jaune','rouge','bleu','vert','blanc','noir','gris');
  // 2 outils d'affichage amélioré : prunt_r() & var_dump()
  echo '<b>Affichage du tableau avec print_r</b><br>';
  echo '<pre>'; print_r($liste); echo '</pre>';
  echo '<b>Affichage du tableau avec var_dump</b><br>';
  echo '<pre>'; var_dump($liste); echo '</pre>';

  // avec un echo afficher la valeur "bleu" en passant par le array $liste
  echo $liste[2] . '<br>';
  echo $liste[0] . '<br>';
separateur();
  // la boucle foreach() {} pour les tableaux array ou les objets
foreach( $liste AS $value) { echo '- ' .$value.'<br>';}
// foreach(le_tableau AS variable_contenant_la_valeur_en_cours) {}
// dans une boucle foreach() le ot clé AS est obligatoire.
// S'il y a une seul variable après le AS cette variable contient la valeur en cours du tableau
// S'il y a deux variables après le AS, la première contient l'indice en cours et la deuxième la valeur en cours.
echo '<br>';
foreach($liste AS $ind => $val) {
    echo '- ' . $ind . '- ' . $val . '<br>';
}
// autre façon de déclarer un array
$liste_pays[] = 'France';
$liste_pays[] = 'Espagne';
$liste_pays[] = 'Italie';
$liste_pays[] = 'Portugal';
$liste_pays[] = 'Belgique';
echo '<pre>'; var_dump($liste_pays); echo '</pre>';

// pour changer une valeur
$liste_pays [2] = 'Suisse';
echo '<pre>'; var_dump($liste_pays);echo '</pre>';

// avec une boucle for() {}
$taille_tableau = count($liste_pays); // count() renvoie le nombre d'éléments d'un tableau
$taille_tableau = sizeof($liste_pays); // sizeof() similaire à count()
echo 'Il y a ' . $taille_tableau . ' éléments dans notre tableau<br>';

for($i = 0; $i < $taille_tableau; $i++) {
    echo '- ' . $liste_pays[$i] . '<br>';
}
// il est possible de choisir nous même les indices
$utilisateur = array('pseudo' => 'test', 'nom' => 'Durand', 'prenom' => 'david', 'age' => 35);
echo '<pre>'; var_dump($utilisateur); echo '</pre>';
echo $utilisateur['nom'] . '<br>';
$utilisateur['email'] = 'toto@mail.fr';
echo '<pre>'; var_dump($utilisateur); echo '</pre>';
// ksort($utilisateur); // pour réordonner le tableau dans l'ordre alphabétique ou numérique
// echo '<pre>'; var_dump($utilisateur); echo '</pre>'; 

echo '<h2>Tableaux multidimensionnel</h2><br>';
//  un tableau array contenant un ou plusieurs tableaux array
 $tab_multi = array(
                    0 => array(
                        'prenom' => 'Marie',
                        'mail' => 'marie@mail.fr',
                        'age' => '32'),
                    1 => array(
                        'prenom' => 'Pierre',
                        'mail' => 'pierre@mail.fr',
                        'age' => '21'),
                    2 => array(
                        'prenom' => 'Franck',
                        'mail' => 'franck@mail.fr',
                        'age' => '40')
                    );

// ppour afficher une information d'un sous tableau :                    
echo $tab_multi[1]['mail'] .'<br>';

echo '<pre>'; print_r($tab_multi); echo '</pre>';

// on affiche toutes les informations avec 2 foreach
echo '<ul>';
foreach($tab_multi AS $indice => $valeur){
    echo '<li>' .$indice. '<ul>';
    foreach($valeur AS $indice2 => $valeur2){
        echo '<li>' .$indice2. ' : ' .$valeur2. '</li>';
    }
    echo '</ul></li>';
}
echo '</ul>';

echo '<ul>';
foreach($tab_multi AS $indice => $valeur){
    foreach($valeur AS $indice2 => $valeur2){
        echo '- ' .$indice2. ' : ' .$valeur2. '<br>';
    }
}
echo '</ul>';
// pour afficher uniquement les prénoms des sous tableaux avec une boucle for()
$taille_tab_multi = count($tab_multi);
for($i = 0; $i < $taille_tab_multi; $i++){
    echo $tab_multi[$i]['mail'] .'<br>';
}

echo '<h2>Les classes et objets</h2><br>';
// Une classe est un modèle de construction
// Un objet est issu d'une classe (c'est une instance de la classe)
// Un objet est un conteneur virtuel permettant de conserver un ensemble d'informations (appelées proriétés ou attribut de l'objet)
// mais aussi des fonctions (appelées methode de l'objet).

//pour déclarer une classse
class Etudiant
{
    public $prenom = 'Marie';
    public $mail = 'marie@mail.fr';
    public $age = 32;

    // le mot clé public permet de préciser que l'on peut appeler l'information directement
    // sur l'objet généré sinon il faudrait passer par des methodes (fontions) prévues pour
    // modifier ou récuperer l'information. Il existe d'autres possibilités notamment protected /private

    // methode
    public function pays(){
        return 'France';
    }
}
 // pour instancier un objet depuis la classe : 
 $objet1 = new Etudiant();
 $objet2 = new Etudiant();
 $objet1 = new Etudiant();
echo '<pre>'; var_dump($objet1); echo '</pre>';
echo '<pre>'; var_dump($objet2); echo '</pre>';

 // pour voir les methodes d'un objet
 echo '<pre>'; var_dump(get_class_methods($objet2)); echo '</pre>';
// get_class_methods permet de voir les methodes d'un objet

// pour récuperer une information ou une methode dans un objet
echo $objet1->prenom .'<br>'; 
echo $objet1->mail .'<br>'; 
echo $objet1->age .'<hr>'; 
// la methode
echo $objet1->pays() .'<hr>';

// il est possible de modifier les propriétés :
$objet1->age =33;
echo $objet1->age .'<hr>'; 
echo $objet2->age .'<hr>';

// dans un tableau array on appelle une information avec les crochets[]
// dans un objet avec la fleche ->

