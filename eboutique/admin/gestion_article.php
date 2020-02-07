<?php
include '../inc/init.inc.php';
include '../inc/fonction.inc.php';

if(!user_is_admin()) {
    header('location:'.URL.'connexion.php');
	exit(); //bloque l'execution du code de la page
}

/**********************************************************
 * ********************************************************
 *  \ SUPPRESSION D'UN ARTICLE ****************************
 * ********************************************************
 *********************************************************/
if(isset($_GET['action']) && $_GET['action'] == 'supprimer' && !empty($_GET['id_article'])) {
    $suppression = $pdo->prepare("DELETE FROM article WHERE id_article = :id_article");
    $suppression->bindParam(":id_article", $_GET['id_article'], PDO::PARAM_STR);
    $suppression->execute();

    $_GET['action'] = 'affichage'; // pour provoquer l'affichege des articles
}
/**********************************************************
 **********************************************************
 *  \ FIN DE SUPPRESSION D'UN ARTICLE *********************
 **********************************************************
 *********************************************************/

include '../inc/header.inc.php';
include '../inc/nav.inc.php';

$id_article = ''; // pour la modification
$reference = '';
$titre = '';
$categorie = '';
$couleur ='';
$taille = '';
$description ='';
$sexe ='';
$photo = '';
$prix = '';
$stock = '';
$photo_bdd ='';

/********************************************************************
 * ******************************************************************
 *  \ MODIFICATION  RECUPERATION DES INFOS DE L'ARTICLE EN BDD ******
 * ******************************************************************
 *******************************************************************/

if(isset($_GET['action']) && $_GET['action'] == 'modifier' && !empty($_GET['id_article'])) {
    $infos_article = $pdo->prepare("SELECT * FROM article WHERE id_article = :id_article");
    $infos_article->bindParam(":id_article", $_GET['id_article'], PDO::PARAM_STR);
    $infos_article->execute();

    if($infos_article->rowCount() > 0){
        $article_actuel = $infos_article->fetch(PDO::FETCH_ASSOC);

        $id_article = $article_actuel['id_article'];
        $reference = $article_actuel['reference'];
        $titre = $article_actuel['titre'];
        $categorie = $article_actuel['categorie'];
        $couleur = $article_actuel['couleur'];
        $taille = $article_actuel['taille'];
        $description = $article_actuel['description'];
        $sexe = $article_actuel['sexe'];
        $photo = $article_actuel['photo'];
        $prix = $article_actuel['prix'];
        $stock = $article_actuel['stock'];
        $photo_actuelle = $article_actuel['photo'];
    }
}

 /********************************************************************
 * *******************************************************************
 *  \ FIN MODIFICATION  RECUPERATION DES INFOS DE L'ARTICLE EN BDD ***
 * *******************************************************************
 ********************************************************************/

/**********************************************************
 * ********************************************************
 *  \ ENREGISTREMENT DES ARTICLES *************************
 * ********************************************************
 *********************************************************/

if(
	isset($_POST['reference']) &&
	isset($_POST['titre']) &&
	isset($_POST['categorie']) &&
	isset($_POST['couleur']) &&
	isset($_POST['taille']) &&
	isset($_POST['description']) &&
    isset($_POST['sexe']) &&
    isset($_POST['prix']) &&
	isset($_POST['stock']) ) {
		$reference = trim($_POST['reference']);
        $titre = trim($_POST['titre']);
        $categorie = trim($_POST['categorie']);
        $couleur = trim($_POST['couleur']);
        $taille = trim($_POST['taille']);
        $description = trim($_POST['description']);
        $sexe =trim($_POST['sexe']);
        $prix = trim($_POST['prix']);
        $stock = trim($_POST['stock']);

        // controle sur la reference car elle est unique en BDD
        $verif_reference = $pdo->prepare("SELECT * FROM article WHERE reference = :reference");
        $verif_reference->bindParam(':reference', $reference, PDO::PARAM_STR);
        $verif_reference->execute();

        if(empty($prix) || !is_numeric($prix)){
            $msg .= '<div class="alert alert-danger mt-3">Atention le prix est obligatoire et doit etre numérique.</div>';
        }
        if(empty($stock) || !is_numeric($stock)){
            $msg .= '<div class="alert alert-danger mt-3">Atention le stocks est obligatoire et doit etre numérique.</div>';
        }

        // si on a une ligne, alors la reference existe en BDD
        if($verif_reference->rowCount() > 0) {
            $msg .= '<div class="alert alert-danger mt-3">Atention référence indisponible, car déja attribuée.</div>';            
        } else {
            // vérification du format de l'image, formats acceptés : jpeg, jpg, png, gif.
            // es-c qu'une image a été postée
            if(!empty($_FILES['photo']['name'])){
                // on, vérifie le format de l'image en récupérant son extension
                $extension = strrchr($_FILES['photo']['name'], '.');
                // strrchr() découpe une chaîne fournie en premier argument en partant de la fin.
                // On remonte jusqu'au caractère fourni en deuxième argument et on récupère tout depuis ce caractère.
                // exemple strrchr('image.png','.'); +> on récupère .png
                // vd($extension);
                
                // on enlève le point et on passe l'extension en minuscule pour pouvoir la comparer.
                $extension = strtolower(substr($extension, 1));
                // exemple : .PNG => png   .Jpeg => jpeg
                
                // on déclare un tableau array contenant les extensions autorisées:
                $tab_extension_valide = array('png', 'gif', 'jpg', 'jpeg');
                
                // in_array(ce_quon_cherche, tableau_ou_on_cherche);
                // in_array() renvoie true si le premier argument correspond à une des valeurs présentes dans le tableau array fourni en argument. Sinon false.
                $verif_extension = in_array($extension, $tab_extension_valide);
                
                if($verif_extension) {
                    
                    // pour ne pas écraser un image du meme nom, on renomme l'image en rajoutant le référence qui est une information unique
                    $nom_photo = $reference .'-'.$_FILES['photo']['name'];
                    
                    $photo_bdd = $nom_photo; // represente l'insertion en BDD


                    // on prepare le chemin ou on va enregistrer l'image
                    $photo_dossier = SERVER_ROOT . SITE_ROOT . 'img/' . $nom_photo;
                    // vd($photo_dossier);

                    // copy(); permet de copier un fichier depuis un emplacement fourni en premier argument vers un emplacement fourni en deuxieme.
                    copy($_FILES['photo']['tmp_name'], $photo_dossier); 

                } else {
                    $msg .= '<div class="alert alert-danger mt-3">Atention le format de la phot est invalide, extension autorisées : jpg, jpeg, png, gif.</div>';           
                }
            }
        }
        // on peut déclencher l'enregistrement s'il y n'y a pas eu d'erreur dans les traitements précédents
        if(empty($msg)){
            $enregistrement = $pdo->prepare("INSERT INTO article (reference, titre, categorie, couleur, taille, description, sexe, prix, stock, photo) VALUES (:reference, :titre, :categorie, :couleur, :taille, :description, :sexe, :prix, :stock, :photo) ");
            $enregistrement->bindParam(":titre", $titre, PDO::PARAM_STR);
            $enregistrement->bindParam(":categorie", $categorie, PDO::PARAM_STR);
            $enregistrement->bindParam(":couleur", $couleur, PDO::PARAM_STR);
            $enregistrement->bindParam(":taille", $taille, PDO::PARAM_STR);
            $enregistrement->bindParam(":description", $description, PDO::PARAM_STR);
            $enregistrement->bindParam(":sexe", $sexe, PDO::PARAM_STR);
            $enregistrement->bindParam(":prix", $prix, PDO::PARAM_STR);
            $enregistrement->bindParam(":stock", $stock, PDO::PARAM_STR);
            $enregistrement->bindParam(":reference", $reference, PDO::PARAM_STR);
            $enregistrement->bindParam(":photo", $photo_bdd, PDO::PARAM_STR);
            $enregistrement->execute();
        } 
}
// vd($_POST);
// vd($_FILES);
/**********************************************************
 * ********************************************************
 *  \  FIN ENREGISTREMENT DES ARTICLES *************************
 * ********************************************************
 *********************************************************/

?>

<div class="starter-template">
    <h1><i class="fas fa-ghost" style="color: #4c6ef5;"></i> Gestion articles <i class="fas fa-ghost"
            style="color: #4c6ef5;"></i></h1>
    <p class="lead"><?php echo $msg ?></p>
    <p class="text-center">
        <a href="?action=ajouter" class="btn btn-outline-danger">Ajout article</a>
        <a href="?action=affichage" class="btn btn-outline-primary">Affichage article</a>
    </p>
</div>

<div class="row">
    <div class="col-12">

    <?php
        /*************************************/
        /* AFFICHAGE DES ARTICLES
        / ************************************/

        if(isset($_GET['action']) && $_GET['action'] == "affichage") {
            // on recupere les articles en BDD
            $liste_article = $pdo->query("SELECT * FROM article");
            echo '<p>Nombre d\'article : <b>' . $liste_article->rowCount() .'</p>';

            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered">';
            echo '<tr>';
            echo '<th>Id Article</th>';
            echo '<th>Reference</th>';
            echo '<th>Catégories</th>';
            echo '<th>Titre</th>';
            echo '<th>Description</th>';
            echo '<th>Couleur</th>';
            echo '<th>Taille</th>';
            echo '<th>Sexe</th>';
            echo '<th>Photo</th>';
            echo '<th>Prix</th>';
            echo '<th>Stock</th>';
            echo '<th>Modif</th>';
            echo '<th>Suppr</th>';
            echo '</tr>';

            while($article = $liste_article->fetch(PDO::FETCH_ASSOC)) {
                echo'<tr>';
                echo '<td>'. $article['id_article'] . '</td>';
                echo '<td>'. $article['reference'] . '</td>';
                echo '<td>'. $article['categorie'] . '</td>';
                echo '<td>'. $article['titre'] . '</td>';
                echo '<td>'. substr($article['description'],0 ,14) . '...</td>';
                echo '<td>'. $article['couleur'] . '</td>';
                echo '<td>'. $article['taille'] . '</td>';
                echo '<td>'. $article['sexe'] . '</td>';
                echo '<td><img src="'. URL . 'img/' . $article['photo'] . '" class="img-thumbnail" width="140"</td>';
                echo '<td>'. $article['prix'] . '</td>';
                echo '<td>'. $article['stock'] . '</td>';

                echo '<td><a href="?action=modifier&id_article='. $article['id_article'] . '" class="btn btn-warning"><i class="fas fa-pen-nib"></i></a></td>';
                echo '<td><a href="?action=supprimer&id_article='. $article['id_article'] . '" class="btn btn-danger" onclick="return(confirm(\'Etes-vous sûr ?\'))"><i class="fas fa-minus-square"></i></a></td>';
                
                echo'</tr>';
            }

            echo '</table>';
            echo '</div>';
        }

        /*************************************/
        /* AFFICHAGE DES ARTICLES
        / ************************************/


        /************************************ */
        /*************************************** */
        // FORMULAIRE D'AJOUT D'ARTICLE
        /******************************************/
        /******************************************/

        // on affiche le form si l'utilisateur a cliqué sur le bouton ajout article 
        if(isset($_GET['action']) && ($_GET['action'] == "ajouter" || $_GET['action'] == "modifier")) {
    ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="reference">Référence</label>
                        <input type="text" name="reference" id="reference" value="<?php echo $reference ?>"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="titre">Titre</label>
                        <input type="text" name="titre" id="titre" value="<?php echo $titre ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description"
                            class="form-control" ><?php echo $description; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categorie">Categorie</label>
                        <select name="categorie" id="categorie" value="<?php echo $categorie; ?>" class="form-control">
                            <option>Chemise</option>
                            <option <?php if($categorie == 'Tshirt') { echo 'selected';} ?>>Tshirt</option>
                            <option <?php if($categorie == 'Pantalon') { echo 'selected';} ?>>Pantalon</option>
                            <option <?php if($categorie == 'Caleçon') { echo 'selected';} ?>>Caleçon</option>
                            <option <?php if($categorie == 'Echarpe') { echo 'selected';} ?>>Echarpe</option>
                            <option <?php if($categorie == 'Polo') { echo 'selected';} ?>>Polo</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="couleur">Couleur</label>
                        <select name="couleur" id="couleur" value="<?php echo $couleur; ?>" class="form-control">
                            <option>Bleu</option>
                            <option <?php if($couleur == 'Blanc') { echo 'selected'; } ?>>Blanc</option>
                            <option <?php if($couleur == 'Vert') { echo 'selected'; } ?>>Vert</option>
                            <option <?php if($couleur == 'Rouge') { echo 'selected'; } ?>>Rouge</option>
                            <option <?php if($couleur == 'Gris') { echo 'selected'; } ?>>Gris</option>
                            <option <?php if($couleur == 'Rose') { echo 'selected'; } ?>>Rose</option>
                            <option <?php if($couleur == 'Beige') { echo 'selected'; } ?>>Beige</option>
                            <option <?php if($couleur == 'Marron') { echo 'selected'; } ?>>Marron</option>
                            <option <?php if($couleur == 'Jaune') { echo 'selected'; } ?>>Jaune</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                        <label for="taille">Taille</label>
                        <select name="taille" id="taille" value="<?php echo $taille; ?>" class="form-control">
                            <option>XS</option>
                            <option <?php if($taille == 'S') { echo 'selected'; } ?>>S</option>
                            <option <?php if($taille == 'M') { echo 'selected'; } ?>>M</option>
                            <option <?php if($taille == 'L') { echo 'selected'; } ?>>L</option>
                            <option <?php if($taille == 'XL') { echo 'selected'; } ?>>XL</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sexe">Sexe</label>
                        <select name="sexe" id="sexe" value="<?php echo $sexe; ?>" class="form-control">
                            <option value="m">Homme</option>
                            <option value="f" <?php if($sexe == 'f') { echo 'selected'; } ?>>Femme</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" name="photo" id="photo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" name="prix" id="prix" value="<?php echo $prix ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="text" name="stock" id="stock" value="<?php echo $stock ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="enregistrement" id="enregistrement" class="form-control btn btn-primary">
                        <i class="fas fa-save"></i> Enregistrer l'article <i class="fas fa-archive"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <?php
        } // fin du if(isset($_GET['action']) && $_GET['action'] == "ajouter")
        ?>
    </div>
</div>

<?php
include '../inc/footer.inc.php';