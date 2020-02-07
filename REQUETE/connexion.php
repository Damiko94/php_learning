<?php
$host_db = 'mysql:host=localhost;dbname=connexion'; //adresse serveur nom de la BDD
$login = 'root'; // identifiant pour la BDD
$password = ''; // le mdp de connexion a la BDD
$options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');

$pdo = new PDO($host_db, $login, $password, $options);

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<style>
			.conteneur { width: 1000px; margin: 0 auto; }
			form { width: 50%; padding: 20px; border: 1px solid #333; margin: 0 auto; }
			input, select, textarea { width: 100%; border: 1px solid #333; min-height: 30px; resize: vertical; }
			#confirm { background-color: #333; color: white; }
		</style>
	</head>
	
	<body>
		<div class="conteneur">		
			<form method="post" action="">			
                <h1>Connexion</h1>
<?php
$pseudo = '';
if(isset($_POST['pseudo']) && isset($_POST['mdp'])){
    $pseudo = trim($_POST['pseudo']);
    $mdp = trim($_POST['mdp']);

    echo 'Pseudo : ' . $pseudo . '<br>';
    echo 'Mot de passe : ' . $mdp . '<hr>';
    
    //  on place la requete dans une variable  pour pouvoir l'afficher 
    // $req = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo' AND mdp = '$mdp'";
    // echo '<b>Requete : </b>' . $req . '<hr>';

    // on execute la requete avec le methode query
    // $resultat = $pdo->query($req);

    // avec prepare() & bindParam() & execute() il n'est pas possible d'avoir des injections SQL
    $resultat = $pdo->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo AND mdp = :mdp");
    $resultat->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $resultat->bindParam(':mdp', $mdp, PDO::PARAM_STR);
    $resultat->execute();

    //on vérifie le nombre de ligne dans la réponse
    if($resultat->rowCount() > 0){
        // s'il y a une ligne alors le pseudo et le mdp sont les bons
        echo '<div style="background-color: green; color; white; padding: 20px;">Connexion Ok !</div>';
        
        $infos = $resultat->fetch(PDO::FETCH_ASSOC);
        foreach($infos AS $indice => $valeur) {
            echo $indice . ' : ' . $valeur . '<br>';
        }
    } else {
        // s'il y a zéro ligne, le pseudo et / ou le mdp sont incorrects
        echo '<div style="background-color: red; color; white; padding: 20px;">Erreur sur les identifiants de connexio<br>Veuillez recommenrcer !</div>';
    }
}
?>
				<label for="pseudo">Pseudo</label>
				<input type="text" name="pseudo" id="pseudo" value="<?php echo $pseudo; ?>">
				<br>
				<label for="mdp">Mot de passe</label>
				<input type="text" name="mdp" id="mdp">
				<hr>
				<input type="submit" id="confirm" value="Connexion">
			</form>
		</div>
	</body>
</html>