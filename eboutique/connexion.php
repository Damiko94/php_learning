<?php
include 'inc/init.inc.php';
include 'inc/fonction.inc.php';

// déconnexion
if (isset($_GET['action']) && $_GET['action'] == 'deconnexion') {
    session_destroy();
}

// restriction d'accés, si l'utilisateur n'est pas connecté, on le renvoie sur connexion.php
if(user_is_connect()) {
	header('location:profil.php');
}


include 'inc/header.inc.php';
include 'inc/nav.inc.php';
$pseudo = '';
// es ce que le formulaire a été validé
if(isset($_POST['pseudo']) && isset($_POST['mdp'])) {
    $pseudo = trim($_POST['pseudo']);
    $mdp = trim($_POST['mdp']);
    
    // on recupre les informations en BDD de l'utilisateur sur la base du pseudo (unique en BDD)
    $verif_connexion = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
    $verif_connexion->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
    $verif_connexion->execute();
    
    if($verif_connexion->rowCount() > 0){
        // si il y a une ligne dans $verif_connexion alors le pseudo est bon
        $info = $verif_connexion->fetch(PDO::FETCH_ASSOC);
        // echo '<pre>'; var_dump($info); echo '</pre>';
        // on compare le mot de passe qui a été crypté avec le password-hash() via la fonction prédéfinie password_verify
        /*$verif_mdp = password_verify($mdp, $info['mdp']);
        if($verif_mdp){
            $msg .= '<div class="alert alert-success mt-3">Connexion Ok !</div>';            
        }*/
        if(password_verify($mdp, $info['mdp'])){
            // le pseudo et le mot de passe sont corrects, on enregistre les informations dans la session
            
            $_SESSION['membre'] = array();
            
            $_SESSION['membre'] ['id_membre'] = $info['id_membre'];
            $_SESSION['membre'] ['pseudo'] = $info['pseudo'];
            $_SESSION['membre'] ['nom'] = $info['nom'];
            $_SESSION['membre'] ['prenom'] = $info['prenom'];
            $_SESSION['membre'] ['sexe'] = $info['sexe'];
            $_SESSION['membre'] ['email'] = $info['email'];
            $_SESSION['membre'] ['ville'] = $info['ville'];
            $_SESSION['membre'] ['cp'] = $info['cp'];
            $_SESSION['membre'] ['adresse'] = $info['adresse'];
            $_SESSION['membre'] ['statut'] = $info['statut'];
            
            // avec foreach
            /*foreach($info AS $indice => $valeur){
                if($indice != 'mdp'){
                    $_SESSION['membre'][$indice] = $valeur;
                }
            }*/

            //maintenant que l'utilisateur est connecté, on le redirige vers profil.php
            header('location:profil.php');
            // header('location doit etre executé AVANT le moindre affichage dans la page sinon => BUG)
        } else {
            $msg .= '<div class="alert alert-danger mt-3">Erreur sur le pseudo et / ou le mot de passe</div>';
        }   
    } else {
        $msg .= '<div class="alert alert-danger mt-3">Erreur sur le pseudo et / ou le mot de passe</div>';
    }
}
// vd($_SESSION);
?>

<div class="starter-template">
    <h1><i class="fas fa-sign-in-alt" style="color: #4c6ef5;"></i> Connexion <i class="fas fa-ghost" style="color: #4c6ef5;"></i></h1>
    <p class="lead"><?php echo $msg ?>accedez à votre espace membre</p>
</div>

<div class="col-4 mx-auto">
    <form method="POST" action="">
        <div class="form-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" value="<?php echo $pseudo ?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="mdp">Mot de passe <i class="fas fa-key"></i></label>
            <input type="password" name="mdp" id="mdp" value="" class="form-control">
        </div>
        <div>
            <button type="submit" name="inscription" id="inscription" class="form-control btn btn-primary">
            <i class="fas fa-lock"></i> Connexion <i class="fas fa-lock"></i>
            </button>
        </div>
    </form>
</div>

<?php
include 'inc/footer.inc.php';