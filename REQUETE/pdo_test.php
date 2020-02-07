<?php
function show_dbb-table () {
    // connexion à la base de données
    $host_db = 'mysql:host=localhost;dbname=entreprise'; //adresse serveur nom de la BDD
    $login = 'root'; // identifiant pour la BDD
    $password = ''; // le mdp de connexion a la BDD
    $options = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    
    $pdo = new PDO($host_db, $login, $password, $options);

    $resultat = $pdo->query("SELECT * FROM employes");

    echo '<table style="border-collapse: collapse; width: 100%; border: 2px solid black; ">';

    echo '<tr>';
    // columnCount() => nous renvoie le nombre de colonnes dans un résultat de requète
    // getColumnMeta(n) => nous renvoie les informations de la colonne correspondant au chiffre fourni en argument

    for($i = 0; $i < $resultat->columnCount(); $i++){
        // echo '<pre>'; var_dump($resultat->getColumnMeat($i)); echo '</pre>';
        // on récupère les informations de la colonne en cours sous forme de tableau array 
        $colonne = $resultat->getColumnMeta($i);
        echo '<th style="padding: 10px; border: 2px solid black">' .$colonne['name'] . '</th>';
    }
    echo '</tr>';
    // une boucle while avec un fetch à chaque tour pour afficher les données du tableau
    while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr style="padding: 10px; border: 2px solid black">';
        foreach($ligne AS $valeur){
            echo '<td style="padding: 10px; border: 2px solid black">'. $valeur .'</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}