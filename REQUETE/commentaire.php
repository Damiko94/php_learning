<?php
$host_db = 'mysql:host=localhost;dbname=commentaire'; 
$login = 'root'; 
$password = ''; 
$options = array(
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
				PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' 
				);				
$pdo = new PDO($host_db, $login, $password, $options);

// si pseudo et message existent, déclencher un inser into dans la BDD pour enregistrer le message
// la valeur du champ date enregistrement sera la fonction prédéfinie now().  
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
				<h1>Commentaire</h1>
				
				<hr>
				<label for="pseudo">Pseudo</label>
				<input type="text" name="pseudo" id="pseudo" value="">
				<br>
				<label for="message">Message</label>
				<textarea name="message" id="message"></textarea>
				<hr>
				<input type="submit" id="confirm" value="Valider">
			</form>
			<hr>
			<div id="affichage">
            <?php 
            setlocale(LC_TIME, "fr_FR");
            echo strftime(" %A and");
            if(isset($_POST['pseudo']) && isset($_POST['message'])){
                $pseudo = trim($_POST['pseudo']);
                $message = trim($_POST['message']);

                $insertion = $pdo->prepare("INSERT INTO message (pseudo, message, date_enregistrement)  VALUES (:pseudo, :message, NOW())");
                $insertion->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
                $insertion->bindParam(":message", $message, PDO::PARAM_STR);
                $insertion->execute();

                if($insertion->rowCount() > 0){
                    // s'il y a une ligne alors le pseudo et le mdp sont les bons
                    echo '<div style="background-color: green; color; white; padding: 20px;">Message enregistré</div>';
                    $affichage = $pdo->query("SELECT pseudo, message, DATE_FORMAT(date_enregistrement, '%a %d %b %Y %T') AS date FROM message ORDER BY date_enregistrement DESC");
                    $infos = $affichage->fetchAll(PDO::FETCH_ASSOC);
                    foreach($infos AS $valeur) {
                        echo  'Par : <b>'.htmlentities($valeur['pseudo'], ENT_QUOTES) .'</b> le : '.$valeur['date'] .'<br>';
                        echo '<div style=" background-color: steelblue; color: white; papdding 15px; border: 2px solid black">'
                        .htmlentities($valeur['message'], ENT_QUOTES).
                        '</div><hr>';
                    }
                } else {
                    // s'il y a zéro ligne, le pseudo et / ou le mdp sont incorrects
                    echo '<div style="background-color: red; color; white; padding: 20px;">Pas de message enregistré !<br>Veuillez recommenrcer !</div>';
                }
            }

			?>
			</div>
		</div>
	</body>
</html>