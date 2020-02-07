<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire PHP</title>
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
            echo '<pre>'; var_dump($_POST); echo '</pre>';
            if (isset($_POST['pseudo']) &&
            isset($_POST['description'])
            ){
            echo 'Votre pseudo est : ' . $_POST['pseudo'] . '<br>';
            echo 'Votre description : ' . $_POST['description'] . '<br>';
            }        
        ?>
        <form method="POST" action="" enctype="multipart/form-data">
        <!-- 
            method="post" => la methode utilisé pour envoter les données provenant du formulaire get/post (get par defaut)
            action="" => l'url cible lors de la validation du formulaire
            enctype="multipart/form-data" => obligatoire s'il y a des pièces jointe dans le formulaire (input type="file")
         -->
            <h1>Formulaire 1</h1>
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo">
            <br>
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
            <hr>
            <input type="submit" id="confirm" value="confirmer">
        </form>
        
        <?php
        
        ?>

    </div>
</body>
</html>