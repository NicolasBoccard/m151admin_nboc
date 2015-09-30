<?php

/*
  Created on : 02 septembre 2015
  Author     : Nicolas Boccard
 */

require_once('fonctions_bdd.php');

function afficher_profil($tableau)
{
    $profil_choisit = FALSE;
    for ($i = 0; $i < count($tableau); $i++)
    {
        if(isset($_REQUEST['id_user']) && $_REQUEST['id_user'] == $tableau[$i][0])
            {
                if(isset($_REQUEST['action']) && $_REQUEST['action'] == "supprimer")
                {
                    supprimer_profil($tableau[$i][0]);
                    header('Location: profil.php');
                }
                else 
                {
                $profil_choisit = TRUE;
                afficher_profil_detail($tableau[$i][0]);
                }
            }
    }
    if($profil_choisit == FALSE)
    {
        afficher_profil_general($tableau);
    }
    
}

function afficher_profil_general($tableau)
{
    echo "<table id=\"tableau_profil_general\">";
        for($i = 0; $i < count($tableau); $i++)
        {
            echo "<tr>";
            for ($j = 1; $j < 3; $j++)
            {
                echo "<td>";
                echo $tableau[$i][$j];
                echo "</td>";
            }
            echo "<td>"
            .    "<a id=\"btn_profil\" href=\"profil.php?id_user=" . $tableau[$i][0] . "\">détail</a>"
            .    "</td>"
            .    "<td>"
            .    "<a id=\"btn_profil\" href=\"inscription.php?id_user=" . $tableau[$i][0] . "\">modifier</a>"
            .    "</td>"
            .    "<td>"
            .    "<a id=\"btn_profil\" href=\"profil.php?id_user=" . $tableau[$i][0] . "&action=supprimer\">supprimer</a>"
            .    "</td>"
            .    "</tr>";
            echo "</tr>";
        }
}

function afficher_profil_detail($id)
{
    $tableau = recuperer_profil_detail($id);
    echo "<table id=\"tableau_profil_detail\">";
    
    for($i = 0; $i < count($tableau); $i++)
    {
        for ($j = 1; $j < count($tableau[$i]); $j++)
            {
                echo "<tr>";
                echo "<td>";
                echo $tableau[$i][$j];
                echo "</td>";
                echo "</tr>";
            }   
    }
    echo "<tr>";
    echo "<td>";
    echo "<a id=\"annuler_modification\" href=\"profil.php\">Retour<a/>";
    echo "</td>";
    echo "</tr>";
    echo "</table\">";
}
