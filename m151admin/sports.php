<?php
/*
  Created on : 25 novembre 2015
  Author     : Nicolas Boccard
 */

session_start();

require_once('fonctions_bdd.php');
require_once('fonction_affichage.php');
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
                <h1>Sports</h1>
                <table>
                    <tr>
                        <td>
                            <label>Sport n°1</label>
                        </td>
                        <td>
                            <select name="sport1">
                                <?=afficherSports() ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Sport n°2</label>
                        </td>
                        <td>
                            <select name="sport2">
                                <?=afficherSports() ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Sport n°3</label>
                        </td>
                        <td>
                            <select name="sport3">
                                <?=afficherSports() ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Sport n°4</label>
                        </td>
                        <td>
                            <select name="sport4">
                                <?=afficherSports() ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>