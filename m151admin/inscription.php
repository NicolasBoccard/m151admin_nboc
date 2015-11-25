<?php
/*
 *   Created on : 26 août 2015
 *   Author     : Nicolas Boccard
 */

session_start();

//déclaration et initialisation des variables
$id = "";
$nom = isset($_REQUEST['nom']) ? $_REQUEST['nom'] : "";
$prenom = isset($_REQUEST['prenom']) ? $_REQUEST['prenom'] : "";
$date_naissance = isset($_REQUEST['date_naissance']) ? $_REQUEST['date_naissance'] : "";
$description = isset($_REQUEST['description']) ? $_REQUEST['description'] : "";
$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : "";
$pseudo = isset($_REQUEST['pseudo']) ? $_REQUEST['pseudo'] : "";
$mdp = isset($_REQUEST['mot_de_passe']) ? $_REQUEST['mot_de_passe'] : "";



require_once('fonctions_bdd.php');
$modification = FALSE;
$admin = FALSE;
if (isset($_REQUEST['annuler'])) {
    header('Location: profil.php');
} else {
    if (isset($_REQUEST['inscription'])) {
        $classe = afficher_classes_detail($_REQUEST['classe']);
        inscription($_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['date_naissance'], $_REQUEST['description'], $_REQUEST['email'], $_REQUEST['pseudo'], md5($_REQUEST['mot_de_passe']), $classe[0][0]);
    }

    if (isset($_REQUEST['modification'])) {
        $_REQUEST['mot_de_passe'] = ($_REQUEST['mot_de_passe'] == "") ? recuperer_profil_detail($_REQUEST['id'])[0][7] : md5($_REQUEST['mot_de_passe']);
        modifier_profil($_REQUEST['id'], $_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['date_naissance'], $_REQUEST['description'], $_REQUEST['email'], $_REQUEST['pseudo'], $_REQUEST['mot_de_passe'], $_REQUEST['admin']);
        header('Location: profil.php?' . $_REQUEST['id']);
    }

    if (isset($_REQUEST['id_user'])) {
        if (verifier_admin($_SESSION['id_utilisateurs']) == FALSE) {
            if (recuperer_profil_detail($_REQUEST['id_user']) == NULL || $_SESSION['id_utilisateurs'] != $_REQUEST['id_user']) {
                header('Location: profil.php');
            }
        } else {
            $admin = TRUE;
        }
        $modification = TRUE;
        $tableau = recuperer_profil_detail($_REQUEST['id_user']);
        $id = $tableau[0][0];
        $nom = $tableau[0][1];
        $prenom = $tableau[0][2];
        $date_naissance = $tableau[0][3];
        $description = $tableau[0][4];
        $email = $tableau[0][5];
        $pseudo = $tableau[0][6];
        $mdp = $tableau[0][7];
    }
    $classe = afficher_classes();
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
            <form  method="POST" action="inscription.php">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" value="<?= $nom ?>" required/><br/>
                <input type="hidden" name="id" value="<?= $id ?>"/>

                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="<?= $prenom ?> " required/><br/>

                <label for="date_naissance">Date de naissance :</label>
                <input type="date" id="date_naissance" name="date_naissance" value="<?= $date_naissance ?>" required></textarea><br/>

                <label for="description">Description :</label>
                <textarea id="description" name="description" required><?= $description ?></textarea><br/>

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" value="<?= $email ?>" required/><br/>

                <label for="pseudo">Pseudo :</label>
                <input type="text" id="pseudo" name="pseudo" value="<?= $pseudo ?>" required/><br/>

                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" value="<?= $mdp ?>" required/><br/>
                
                <label for="">Classe :</label>
                <select name="classe">
                        <?php
                        for ($i = 0; $i < count($classe[0]); $i++)
                        {
                            ?> <option><?=$classe[$i][1];?></option><?php
                        }
                        ?>
                </select><br/>

                <?php
                if ($admin == TRUE) {
                    ?>
                    <label for="admin">Administrateur</label>
                    <?php
                    if (verifier_admin($_REQUEST['id_user']) == TRUE) {
                        ?>
                        <input type="radio" name="admin" value="1" checked="checked" /><br/>
                        <input type="radio" name="admin" value="0"/>
                        <?php
                    } else {
                        ?>
                        <input type="radio" name="admin" value="1"/><br/>
                        <input type="radio" name="admin" value="0" checked="checked"/>
                        <?php
                    }
                    ?>
                    <label for="admin">Utilisateur</label><br/>
                    <?php
                }
                if ($modification == FALSE) {
                    ?>
                    <input type="submit" name="inscription" value="Inscription"/>
                    <input type="reset" name="effacer" value="Effacer"/>
                    <a id="annuler_inscription" href="index.php">Annuler<a/>
                        <?php
                    } else {
                        ?>
                        <input id="a" type="submit" name="modification" value="Modifier"/>
                        <a id="annuler_modification" href="profil.php">Annuler<a/>
                        <?php } ?>
                        </form>
                        </div>
                        </body>
                        </html>