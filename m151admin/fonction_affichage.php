<?php

/*
  Created on : 02 septembre 2015
  Author     : Nicolas Boccard
 */

require_once('fonctions_bdd.php');



/* * -----------------------------------------------------------------------------
 * Fonction qui vérifie si l'on a appuyé sur supprimer, détails ou rien
 * @param type $tableau || Tableau contenant tout les profils
 */

function afficher_profil($tableau) {
    $profil_choisit = FALSE;
    for ($i = 0; $i < count($tableau); $i++) {
        if (isset($_REQUEST['id_user']) && $_REQUEST['id_user'] == $tableau[$i][0]) {
            if (isset($_REQUEST['action']) && $_REQUEST['action'] == "supprimer") {
                supprimer_profil($tableau[$i][0]);
                header('Location: profil.php');
            } else {
                $profil_choisit = TRUE;
                afficher_profil_detail($tableau[$i][0]);
            }
        }
    }
    if ($profil_choisit == FALSE) {
        afficher_profil_general($tableau);
    }
}

function afficher_profil_general($tableau) {
    echo "<table id=\"tableau_profil_general\">";
    for ($i = 0; $i < count($tableau); $i++) {
        echo "<tr>";
        for ($j = 1; $j < 3; $j++) {
            echo "<td>";
            echo $tableau[$i][$j];
            echo "</td>";
        }
        echo "<td>"
        . "<a id=\"btn_profil\" href=\"profil.php?id_user=" . $tableau[$i][0] . "\">détail</a>"
        . "</td>";
        $admin = verifier_admin($_SESSION['id_utilisateurs']);
        afficher_btn_modifier_supprimer($admin, $tableau[$i][0]);
        echo "</tr>";
    }
}

function afficher_profil_detail($id) {
    $tableau = recuperer_profil_detail($id);
    echo "<table id=\"tableau_profil_detail\">";

    for ($i = 0; $i < count($tableau); $i++) {
        for ($j = 1; $j < count($tableau[$i]); $j++) {
            if ($j != 8) {
                echo "<tr>";
                echo "<td>";
                if ($j == 9) {
                    $classe = afficher_classes_par_id($tableau[$i][$j]);
                    if ($classe == NULL) {
                        echo "Professeur";
                    } else {
                        echo $classe[0][1];
                    }
                } else {
                    echo $tableau[$i][$j];
                }
                echo "</td>";
                echo "</tr>";
            }
        }
    }
    echo "<tr>";
    echo "<td>";
    echo "<a id=\"annuler_modification\" href=\"profil.php\">Retour<a/>";
    echo "</td>";
    echo "</tr>";
    echo "</table\">";
}

function afficher_btn_modifier_supprimer($admin, $id) {
    if ($admin == TRUE) {
        echo "<td>"
        . "<a id=\"btn_profil\" href=\"inscription.php?id_user=" . $id . "\">modifier</a>"
        . "</td>"
        . "<td>"
        . "<a id=\"btn_profil\" href=\"profil.php?id_user=" . $id . "&action=supprimer\">supprimer</a>"
        . "</td>";
    } else {
        if ($id == $_SESSION['id_utilisateurs']) {
            echo "<td>"
            . "<a id=\"btn_profil\" href=\"inscription.php?id_user=" . $id . "\">modifier</a>"
            . "</td>"
            . "<td>"
            . "<a id=\"btn_profil\" href=\"profil.php?id_user=" . $id . "&action=supprimer\">supprimer</a>"
            . "</td>";
        } else {
            echo "<td></td><td></td>";
        }
    }
}

function afficherSports() {
    $sports = recuperer_sports();
    echo 'Bonjour';
    var_dump($sports);
    
    for ($i = 0; $i < count($sports); $i++)
    {
        echo "<option>";
        echo $sports[$i][1];
        echo "</option>";
    }
}
