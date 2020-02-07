<?php
    // Faire un formulaire avec les champs suivants :
    // - destinataires (input type="text")
    // - expediteur (input type="text")
    // - sujet (input type="text")
    // - message (textarea)
echo '<pre>'; var_dump($_POST); echo '</pre>';

if(isset($_POST['destinataire']) &&
   isset($_POST['expediteur']) && 
   isset($_POST['sujet']) && 
   isset($_POST['message']))
   {
       $destinataire = trim($_POST['destinataire']);
       $expediteur = trim($_POST['expediteur']);
       $sujet = trim($_POST['sujet']);
       $message = trim($_POST['message']);
       
       $expediteur = 'From: ' . $expediteur;

       mail($destinataire, $sujet, $message, $expediteur);
       // mail('mail@mail.fr', $sujet, $message, $expediteur);
   }
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>formulaire3 mail</title>
    <style>
        .conteneur { width: 1000px ; margin: 0 auto; }
        form { width: 50%; padding: 20px; border: 1px solid #333; margin: 0 auto; }
        input, select, textarea { width: 100%; border: 1px solid #333; min-height: 30px; }
        #confirm { background-color: #333; color: white; }
    </style>
</head>
<body>
    <div class="conteneur">
        <form method="POST" action="" enctype="multipart/form-data">
            <h1>Formulaire 3</h1>
            <label for="destinataire">Destinataire</label>
            <input type="text" name="destinataire" id="destinataire">
            <br>
            <label for="expediteur">Votre nom</label>
            <input type="text" name="expediteur" id="expediteur">
            <br>
            <label for="sujet">Sujet</label>
            <input type="text" name="sujet" id="sujet">
            <label for="message">Votre message</label>
            <textarea name="message" id="message"></textarea>
            <hr>
            <input type="submit" id="confirm" value="confirmer">
        </form>    
    </div>     
</body>

</html>