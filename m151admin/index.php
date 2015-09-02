<?php
/*
 *   Created on : 26 août 2015
 *   Author     : Nicolas Boccard
 */

require_once('fonctions.php');

if(isset($_POST['inscription']))
{
    inscription($_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['description'], $_POST['email'], $_POST['pseudo'], $_POST['mot_de_passe']);
}

if(isset($_POST['effacer']))
{
    connexion();
}

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
            <form  method="POST" action="index.php">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom"/><br/>
                
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom"/><br/>
                
                <label for="date_naissance">Date de naissance :</label>
                <input type="date" id="date_naissance" name="date_naissance"></textarea><br/>
                
                <label for="description">Description :</label>
                <textarea id="description" name="description"></textarea><br/>
                
                <label for="email">Email :</label>
                <input type="email" id="email" name="email"/><br/>
                
                <label for="pseudo">Pseudo :</label>
                <input type="text" id="pseudo" name="pseudo"/><br/>
                
                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe"/><br/>
                
                <input type="submit" name="inscription" value="Inscription"/>
                <input type="submit" name="effacer" value="Effacer"/>
            </form>
        </div>
    </body>
</html>