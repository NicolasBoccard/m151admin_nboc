<?php
/*
  Created on : 02 septembre 2015
  Author     : Nicolas Boccard
 */

require_once('fonctions_bdd.php');
require_once('fonction_affichage.php');

$tableau_profil = recuperer_profil_general();


?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css.css">
    </head>
    <body>
        <form method="get" action="profil.php">
            <?php $tableau_profil_general = afficher_profil($tableau_profil)?>
        </form>
    </body>
</html>