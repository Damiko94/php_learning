<?php
 // ************************Php Data Object

/*
la methode exec()
-----------------
    Pour des requetes de types Action : INSERT / UPDATE/ DELETE
    - excec() est utilisé pour des requetes ne retournant pas de resultat.
    - A la place lorsque l'on utilise exec() on obtient un chiffre représentant le nombre de ligne impactés par la requete.

    Valeur de retour :
    - Echec : false
    - Succés : un entier (int) représentant le nombre de lignes impactées

la methode query()
------------------
    Pour tout type de requete INSERT / UPDATE/ DELETE / SELECT / SHOW / CREATE ....

    Valeur de retour :
    - Echec : false
    - Succés : un nouvel objet issu de la classe PDOStatement

les methodes prepare() & execute()
----------------------------------
    Pour tout type de requete INSERT / UPDATE/ DELETE / SELECT / SHOW / CREATE ....
    A privilegier pour la sécurité
    - prepare() permet de preparer la requete mais ne l'execute pas.
    - execute() permet d'executer la requete préparée.

    Valuer de retour :
    - prepare() renvoie un toujours un objet  PDOStatement
    -execute()
        - Echec: false
        - Succés : un objet PDOStatement
*/

echo '<h1>01 - PDO : connexion</h1><br>';
// $pdo = new PDO('nom_serveur;nom_bdd', 'login', 'mdp', 'array_avec_des_options');
//$pdo = new PDO('mysql:host=localhost;dbname=entreprise', 'root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
// même chose, autre écriture.
$host_db = 'mysql:host=localhost;dbname=entreprise'; //adresse serveur nom de la BDD
$login = 'root'; // identifiant pour la BDD
$password = ''; // le mdp de connexion a la BDD
$options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

$pdo = new PDO($host_db, $login, $password, $options);

echo '<pre>'; var_dump(get_class_methods($pdo)); echo '</pre>';

echo '<h1>02 - PDO : exec()</h1><br>';
// insertion dasn la table employs de la BDD entreprise
//$resultat = $pdo->exec("INSERT INTO employes (id_employes, nom, prenom, sexe, service, salaire, date_embauche) 
//                        VALUES (NULL, 'Test_insert_nom', 'Test_insert_prenom', 'm', 'informatique', 2000, CURDATE())");

//echo 'Nombre de lignes impactée par cette requete : ' .$resultat. '<br>';
//echo 'Dernier id inséré dans la BDD : ' .$pdo->lastInsertId(). '<br>';

echo '<h1>03 - PDO : query() pour une seule ligne de résultat</h1><br>';

$resultat = $pdo->query("SELECT * FROM employes WHERE id_employes = 350");
echo '<pre>'; var_dump($resultat); echo '</pre>';
echo '<pre>'; var_dump(get_class_methods($resultat)); echo '</pre>';

// resultats represente la réponse de la BDD, masi en l'état inexploitable par php
// Pour rendre les informations contenues dans la réponse, nous devons utiliser les methodes fetch() ou fetchAll()
// Afin de transformer les informationsen format exploitable (notament en tableau array)

$employe = $resultat->fetch(PDO::FETCH_ASSOC); // pour un tableau associatif( le nom des colonnes comme indice du tableau)
// $employe = $resultat->fetch(PDO::FETCH_NUM); //pour un tableau array avec des indices numeriques
// $employe = $resultat->fetch(PDO::FETCH_BOTH); // melange de FECTH_ASSOC & FETCH_NUM PDO::FETCH_BOTH est le cas par defaut si on ne precise aucun mode
// $employe = $resultat->fetch(PDO::FETCH_OBJ); // pour un objet avec les informations sous formes de propriétés publiques
echo '<pre>'; var_dump($employe); echo '</pre>';

echo $employe['prenom'] . '<br>'; // avec FETCH_ASSOC
// echo $employe[1] . '<br>'; // avec FETCH_NUM
// echo $employe->prenom .'<br>'; // avec FETCH_OBJ

// en utilisant FETCH on traite la ligne en cours.
// Si la requete renvoie une seule ligne => un seul fetch
// Si la requete renvoie plusieurs lignes => une boucle avec un fetch à chaque tour

echo '<h1>04 - PDO : query() pour pluisieurs lignes de résultat</h1><br>';
$resultat = $pdo->query("SELECT * FROM employes");
echo 'Il y a '.$resultat->rowcount() . ' employés dans la table<br>';
// $resultat->rowcount() permet d'obtenir le nombre de ligne dans la réponse de la BDD

// plusieurs lignes donc une boucle
while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
    // à chaque tour de boucle, la variable $ligne reçoit le traitement fetch() de la ligne en cours.
    // Avec PDO::FETCH_ASSOC; $ligne est un tableau associatif.

    // echo '<pre>'; var_dump($ligne); echo '</pre><hr>';
    // echo $ligne['prenom'] . '<br>';
    
    echo '<div style="display: inline-block; margin: 1%; width: 22%; box-sizing: border-box; padding: 10px; color: white; background-color: steelblue; overflow; hidden;">';
    /*
    echo '<b>Id employé : </b>' . $ligne['id_employes']. '<br>'; 
    echo '<b>Prénom : </b>' . $ligne['prenom']. '<br>'; 
    echo '<b>Nom : </b>' . $ligne['nom']. '<br>'; 
    echo '<b>Sexe : </b>' . $ligne['sexe']. '<br>'; 
    echo '<b>Service : </b>' . $ligne['service']. '<br>'; 
    echo '<b>Salaire : </b>' . $ligne['salaire']. '<br>'; 
    echo '<b>Date d\'embauche : </b>' . $ligne['date_embauche']. '<br>';
    */
    /*foreach($ligne AS $indice => $valeur) {
        echo '<br>' . ucfirst($indice) . '<br> : ' . $valeur . '<br>';
    }
    echo '</div>';   */ 
}

echo '<h1>05 - PDO : query() pour plusieurs lignes de résultat avec fecthAll()</h1><br>';
// fetchAll permet de ne pas faire une boucle pour appliquer le fetch à la ligne en cours à chaque tour.
// fetchAll() nous renvoie un tableau array mutli dimensionnel avec tpoutes les lignes traitées à des indices différents du tableau.

$resultat = $pdo->query("SELECT * FROM employes WHERE sexe = 'f'");

$les_lignes = $resultat->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>'; var_dump($les_lignes); echo '</pre>';
foreach($les_lignes AS $valeur) {
    echo $valeur['prenom'] . '<br>';
}
echo '<hr>';
for($i = 0; $i < count($les_lignes); $i++){
    echo $les_lignes[$i]['prenom'] . '<br>';
}

echo '<h1>05 - PDO : Exercice : recuperer la liste des BDD du serveur et les afficher dans une liste ul li</h1><br>';
// SHOW DATABASES
$resultat = $pdo->query("SHOW DATABASES");
$les_databases = $resultat->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>'; var_dump($les_databases); echo '</pre>';

echo '<ul>';
foreach($les_databases AS $valeur){
    echo '<li>' . $valeur['Database'] . '</li>';
}
echo '</ul>';

// avec FETCH_ASSOC
$resultat = $pdo->query("SHOW DATABASES");
echo '<pre>'; var_dump($resultat); echo '</pre>';

echo '<ul>';
while($les_databases = $resultat->fetch(PDO::FETCH_ASSOC)){
        echo '<li>' . $les_databases['Database'] . '</li>';
}
echo '</ul>';

echo '<h1>06 - PDO : Affichage de n\'importe quelle réponse de la BDD sous forme de tableau</h1><br>';
$resultat = $pdo->query("SELECT * FROM employes");

echo '<table style="border-collapse: collapse; width: 100%; border: 2px solid black; ">';

echo '<tr>';
// columnCount() => nous renvoie le nombre de colonnes dasn un résultat de requète
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

echo '<h1>07 - PDO : prepare() + bindParam() ou bindValue & execute()</h1><br>';
// les requetes  avec la methode prepare() est à privilégier pour la sécurité.
$nom = 'laborde';
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom");
// :nom est un marqueur nominatif qui attend une information fournie via bindParam() ou bindValue()
$resultat->bindParam(':nom', $nom, PDO::PARAM_STR);
// $resultat->bindValue(':nom', 'laborde', PDO::PARAM_STR);
// bindParam('le_marquer', sa valeur, son_type)
// avec bindParam() la valeur ne peut qu'être sous forme de variable
// avec bindValue() la valeur peut être fournie directement
$resultat->execute(); // on execute la requete
// echo '<pre>'; var_dump($resultat); echo '</pre>';
$result = $resultat->fetch(PDO::FETCH_ASSOC);
echo '<pre>'; var_dump($result); echo '</pre>';
