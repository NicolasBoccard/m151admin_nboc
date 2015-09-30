<?php
/* 
    Created on : 02 septembre 2015
    Author     : Nicolas Boccard
*/
session_start();

require_once('fonctions_bdd.php');
require_once('fonction_affichage.php');

if(isset($_REQUEST['connexion']))
{
    verifier_connexion($_REQUEST['pseudo'], md5($_REQUEST['mdp']));
}

if(isset($_SESSION['connecte']) && $_SESSION['connecte'])
{
    header('Location: profil.php');
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
        <div id="login">
            <form  method="POST" action="index.php">
                <h1>LOGIN</h1>
                <table>
                    <tr>
                        <td><label for="nom">Pseudo :</label></td>
                        <td><input type="text" id="nom" name="pseudo" required/><br/></td>
                    </tr>
                    <tr>
                        <td><label for="mdp">Mot de passe : </label></td>
                        <td><input type="password" id="nom" name="mdp" value="" required/><br/></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="connexion" value="Se connecter"/>
                            <a id="btn_inscription" href="inscription.php">S'inscrire</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>