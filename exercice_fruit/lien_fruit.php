<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lien fruit</title>
</head>
<body>
<?php
// faire une liste ul li avec les fruits suivants en lien : bananes, pommes, peches, cerises
// si l'utilisateur clic sur un lien, il faut afficher son prix au kilo. 
include 'functions.inc.php';
$message = '';
if(isset($_GET['choix'])){
    $message =  calcul($_GET['choix'], 1000);
}
?>
<h1>Veuillez cliquez sur un fruit pour connaitre son prix au kilo</h1>
<?php echo $message; ?>
<ul>
<li><a href="?choix=bananes">bananes</a></li>
<li><a href="?choix=pommes">pommes</a></li>
<li><a href="?choix=peches">peches</a></li>
<li><a href="?choix=cerises">cerises</a></li>
</ul>
    
</body>
</html>
