<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formuaire 2</title>
    <style>
        .conteneur { width: 1000px ; margin: 0 auto; }
        form { width: 50%; padding: 20px; border: 1px solid #333; margin: 0 auto; }
        input, select, textarea { width: 100%; border: 1px solid #333; min-height: 30px; }
        #confirm { background-color: #333; color: white; }
    </style>
</head>
<body>
    <div class="conteneur">
        <?php
        // formulaire2.php
        // affichage_formulaire2.php

        // Sur la page formulaire2.php, faire un formulaire method="post" avec les champs suivant :
        // pseudo (input type="text")
        // email (input type="text")

        // cette page doit envoyer les données vers la page affichage_formulaire2.php
        
        ?>
        <form method="POST" action="affichage_formulaire2.php" enctype="multipart/form-data">
            <h1>Formulaire 2</h1>
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo">
            <br>
            <label for="description">Votre email</label>
            <input type="text" name="email" id="email">
            <hr>
            <input type="submit" id="confirm" value="confirmer">
        </form>
        
        <?php
        
        ?>

    </div>    
</body>
</html>

