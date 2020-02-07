<?php
include '../inc/init.inc.php';
include '../inc/fonction.inc.php';

if(!user_is_admin()) {
    header('location:'.URL.'connexion.php');
	exit(); //bloque l'execution du code de la page
}

include '../inc/header.inc.php';
include '../inc/nav.inc.php';

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
        $stock = trim($_POST['stock']);}

        // controle sur la reference car elle est unique en BDD
        $verif_reference = $pdo->prepare("SELECT * FROM article WHERE reference = :reference");
        $verif_reference->bindParam(':reference', $reference, PDO::PARAM_STR);
        $verif_reference->execute();

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
// vd($_POST);
// vd($_FILES);
/**********************************************************
 * ********************************************************
 *  \ ENREGISTREMENT DES ARTICLES *************************
 * ********************************************************
 *********************************************************/

?>

<div class="starter-template">
    <h1><i class="fas fa-ghost" style="color: #4c6ef5;"></i> Gestion articles <i class="fas fa-ghost"
            style="color: #4c6ef5;"></i></h1>
    <p class="lead"><?php echo $msg ?>Lorem ipsum</p>
</div>

<div class="row">
    <div class="col-12">
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
                            class="form-control"value="<?php echo $description; ?>" ></textarea>
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
    </div>
</div>

<?php
include '../inc/footer.inc.php';