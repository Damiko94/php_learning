<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
	<a class="navbar-brand" href="<?php echo URL ?>index.php">eBoutique</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>

	  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
		<ul class="navbar-nav mr-auto">
		  <li class="nav-item active">
			<a class="nav-link" href="<?php echo URL ?>index.php">Boutique <span class="sr-only">(current)</span></a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="<?php echo URL ?>panier.php">Panier</a>
		  </li>

		  <?php if(!user_is_connect()) { ?>

		  <li class="nav-item">
			<a class="nav-link" href="<?php echo URL ?>inscription.php">Inscription</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="<?php echo URL ?>connexion.php">Connexion</a>
		  </li>

		  <?php } else { ?>

		  <li class="nav-item">
			<a class="nav-link" href="<?php echo URL ?>profil.php">Profil</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="<?php echo URL ?>connexion.php?action=deconnexion">Deconnexion</a>
		  </li>

		  <?php } ?>

		  <?php if(user_is_admin()) { ?>

		  <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="<?php echo URL ?>#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administration</a>
			<div class="dropdown-menu" aria-labelledby="dropdown01">
			  <a class="dropdown-item" href="<?php echo URL ?>admin/gestion_article.php">Gestion des articles</a>
			  <a class="dropdown-item" href="<?php echo URL ?>admin/gestion_membre.php">Gestion des membres</a>
			  <a class="dropdown-item" href="<?php echo URL ?>admin/gestion_commande.php">Gestion des commandes</a>
			  <a class="dropdown-item" href="<?php echo URL ?>admin/statistiques.php">Statistiques</a>
			</div>
		  </li>

		  <?php } ?>
		  
		</ul>
		<form class="form-inline my-2 my-lg-0">
		  <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
		  <button class="btn btn-secondary my-2 my-sm-0" type="submit">Rechercher</button>
		</form>
	  </div>
	</nav>

<main role="main" class="container">
