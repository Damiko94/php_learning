<?php
session_start(); // ouverture d'une session et création d'un cookie côté utilisateur.
//permet de créer un fichier session ou de l'ouvrir si il existe déja.
$_SESSION['login'] = 'admin';
$_SESSION['password'] = '12345';
$_SESSION['email'] = 'admin@mail.fr';
$_SESSION['adresse'] = '1 rue de paris';

echo '<b>Premier affichage de la session</b> : <br>';
echo '<pre>'; var_dump($_SESSION); echo '</pre>';

// pour enlever un élémnet de tableau array : 
unset($_SESSION['password']);

echo '<b>Deuxieme affichage de la session</b> : <br>';
echo '<pre>'; var_dump($_SESSION); echo '</pre>';

// pour supprimer une session
// unset($_SESSION); // suppression innédiate
session_destroy(); // cette fonction permet de supprimer un fochier de session, en revanche,
// cette suppression se fera après l'exécution complète du script en cours. C'est pourquoi le var_dump() suivant
// peut afficher son contenu car la session sera supprimé après !

echo '<b>Troisième affichage de la session</b> : <br>';
echo '<pre>'; var_dump($_SESSION); echo '</pre>';

