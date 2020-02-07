<?php
// connexion à la base de données

$host_db = 'mysql:host=localhost;dbname=eboutique'; //adresse serveur nom de la BDD
$login = 'root'; // identifiant pour la BDD
$password = ''; // le mdp de connexion a la BDD
$options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

$pdo = new PDO($host_db, $login, $password, $options);

// creation d'une variable destinée à afficher des messages utilisateurs
$msg = "";

// ouverture d'une session
session_start();

// déclaration d'une constante
define ('URL', 'http://php/eboutique/');