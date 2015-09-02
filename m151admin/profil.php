<?php
/*
  Created on : 02 septembre 2015
  Author     : Nicolas Boccard
 */

require_once('fonctions_bdd.php');
require_once('fonction_affichage.php');

$tableau_profil = recuperer_profil();
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
    </head>
    <body>
        <form method="get" action="profil.php">
            <?php afficher_profil($tableau_profil)?>
        </form>
    </body>
</html>