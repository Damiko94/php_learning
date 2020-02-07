<!DOCTYPE html>
<html lang="fr_FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <?php
echo '<pre>'; var_dump($_POST); echo '</pre>';
// afficher proprement les informations présentent dans $_POST via des echo ATTENTION verifier si cela existe !
// vérifier la taille du pseudo, le pseudo doit faire entre 4 et 14 caractères
// Si la taille du pseudo ne correspond pas, on affiche u nmessage d'erreur.
if(isset($_POST['pseudo']) && isset($_POST['email']) ){

    $erreur= 0; // variable de controle

    $pseudo = trim($_POST['pseudo']);
    $email = trim($_POST['email']);

    echo '<b>Pseudo : </b>' . $pseudo . '<br>';
    echo '<b>Email : </b>' . $email . '<br>';
    //Vérification de la taille du pseudo
    $taille_pseudo = iconv_strlen($pseudo);
    echo '<b>Taille pseudo : </b>' . $taille_pseudo . '<hr>';

    if($taille_pseudo < 4 || $taille_pseudo > 14){
        echo '<div style="colr: white; background-color: red; padding: 20px;">Atention, <br>Le pseudo doit avoir entre 4 et 14 caractères inclus.<br>Veuillez recommencer</div>';
        // cas d'erreur
        $erreur =1; // on change la valeur de cette variable pour la tester ensuite.
        // 0 => pas d'erreur // 1 => erreur
    } else {
        echo '<div style="color: white; background-color: darkgreen; padding: 20px; margin-top: 20px;">Pseudo ok</div>'; 
    }

    /*
    if(isset($_POST['pseudo']) &&
    isset($_POST['email'])) {
        if( iconv_strlen($_POST['pseudo']) > 3 && iconv_strlen($_POST['pseudo']) < 15) {
            foreach($_POST AS $a => $b){
                echo 'Votre ' . $a . ' est  : ' . $b . '<br>';
            } 
        } 
        else{echo 'Le pseudo doit avoir entre 4 et 14 caractères inclus.<br>';}
    }
    */
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        echo '<div style="colr: white; background-color: red; padding: 20px;">Atention, <br>Le format du mail n\'est pas valide</div>';
        // cas d'erreur
        $erreur =1;
    } else {
        echo '<div style="color: white; background-color: darkgreen; padding: 20px; margin-top: 20px;">Email ok</div>';
    }

    // on vérifie s'il n'y a pas eu d'erreur
    // if(!$erreur){
    if($erreur == 0){
        // si erreur a la valeur 0, alors il n'y a pas eu d'erreur dans nos traitement.

        // création ou ouverture d'un fichier sur le serveur
        $f = fopen('liste.txt', 'a');
        // fopen() en mode "a" (deuxieme argument) permet de créer un fichier ou de l'ouvrir s'il existe déja
        
        // on écrit dasn ce fichier le pseudo et le mail qu'on a récuperé.
        fwrite($f, $pseudo . ' - ' . $email . "\n"); // "\n" entre guillemets (obligatoire) permet un retour à llligne dans un fichier.

        // on ferme le fichier pour libérer de l'espace sur le serveur
        fclose($f);
    }
}

// maintenant que nous avons enregistré les informations dans un fichier texte ,nous allons afficher du contenu dans la page.
// on vérifie si le fichier existe
if(file_exists('liste.txt')){
    // on récupère le contenu :
    $contenu = file('liste.txt');
    // la fonction prédéfinie file() place chaque ligne d'un fichier dans des indices différents d'un tableau array

    echo '<pre>'; var_dump($contenu); echo '</pre>';
    echo '<ul>';
    foreach($contenu AS $elements){
        echo '<li>' . $elements . '</li>';
    }
    echo '</ul>';
}
?>

</body>

</html>