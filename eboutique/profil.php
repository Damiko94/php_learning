<?php
include 'inc/init.inc.php';
include 'inc/fonction.inc.php';

// restriction d'accés, si l'utilisateur n'est pas connecté, on le renvoie sur connexion.php
if(!user_is_connect()) {
	header('location:connexion.php');
	exit();
}


include 'inc/header.inc.php';
include 'inc/nav.inc.php';
// vd($_SESSION);
?>

<div class="starter-template">
	<h1><i class="fas fa-ghost" style="color: #4c6ef5;"></i> Template <i class="fas fa-ghost"
			style="color: #4c6ef5;"></i></h1>
	<p class="lead"><?php echo $msg ?>Lorem ipsum</p>
</div>

<div class="row">
	<div class=" row col-12">
		<div class="col-6">
			<?php
			if($_SESSION['membre']['sexe'] == 'm' || $_SESSION['membre']['sexe'] == 'masculin') {
				$_SESSION['membre']['sexe'] = 'masculin';
			} else {
				$_SESSION['membre']['sexe'] = 'feminin';

			}
			echo '<ul class="list-group">';
			foreach($_SESSION['membre'] AS $ind => $val){
				echo'<li class="list-group-item">'.$ind.' : '.$val.'</li>';				
			}		
			echo '</ul>';
			?>
		</div>
		<div class="col-6">
			<img src="img/profil.jpg" alt="profil">
		</div>
	</div>
</div>

<?php
include 'inc/footer.inc.php';