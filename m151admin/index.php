<?php
/*
 *   Created on : 26 août 2015
 *   Author     : Nicolas Boccard
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css.css">
    </head>
    <body>
        <div id="formulaire">
        <form action="index.php">
            <label for="nom">Nom :</label><input type="text" id="nom"/><br/>
            <label for="prenom">Prénom :</label><input type="text" id="prenom"/><br/>
            <label for="date_naissance">Date de naissance :</label><input type="date" id="date_naissance"/><br/>
            <label for="description">Description :</label><input type="text" id="description"/><br/>
            <label for="email">Email :</label><input type="email" id="email"/><br/>
            <label for="pseudo">Pseudo :</label><input type="text" id="pseudo"/><br/>
            <label for="mot_de_passe">Mot de passe :</td></label><input type="password" id="mot_de_passe"/><br/>
            <input type="submit" id="valider"/>
            <input type="reset" id="effacer"/>
        </form>
        </div>
    </body>
</html>