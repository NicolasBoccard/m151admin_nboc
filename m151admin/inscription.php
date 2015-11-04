<?php
/*
 *   Created on : 26 août 2015
 *   Author     : Nicolas Boccard
 */

session_start();

require_once('fonctions_bdd.php');
$modification = FALSE;
$admin = FALSE;
if(isset($_REQUEST['annuler']))
{
    header('Location: profil.php');
}
else
{
if(isset($_REQUEST['inscription']))
{
    inscription($_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['date_naissance'], $_REQUEST['description'], $_REQUEST['email'], $_REQUEST['pseudo'], md5($_REQUEST['mot_de_passe']));
}

if(isset($_REQUEST['modification']))
{
    modifier_profil($_REQUEST['id'], $_REQUEST['nom'], $_REQUEST['prenom'], $_REQUEST['date_naissance'], $_REQUEST['description'], $_REQUEST['email'], $_REQUEST['pseudo'], md5($_REQUEST['mot_de_passe']), $_REQUEST['admin']);
    header('Location: profil.php?' . $_REQUEST['id']);
}

if(isset($_REQUEST['id_user']))
{
    if(verifier_admin($_SESSION['id_utilisateurs']) == FALSE)
{
    if(recuperer_profil_detail($_REQUEST['id_user']) == NULL || $_SESSION['id_utilisateurs'] != $_REQUEST['id_user'])
{
    header('Location: profil.php');
}
}
else
{
    $admin = TRUE;
}
    $modification = TRUE;
    $tableau = recuperer_profil_detail($_REQUEST['id_user']);
}

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
                <?php if($modification == FALSE){?>
                <input type="text" id="nom" name="nom" required/><br/>
                <?php } else{?>
                <input type="hidden" name="id" value=<?php echo "\"" . $tableau[0][0] . "\"";?>/>
                <input type="text" id="nom" name="nom" value=<?php echo "\"" . $tableau[0][1] . "\"";?> required/><br/>
                <?php }?>
                
                <label for="prenom">Prénom :</label>
                <?php if($modification == FALSE){?>
                <input type="text" id="prenom" name="prenom" required/><br/>
                <?php } else{?>
                <input type="text" id="prenom" name="prenom" value=<?php echo "\"" . $tableau[0][2] . "\"";?> required/><br/>
                <?php }?>
                
                <label for="date_naissance">Date de naissance :</label>
                <?php if($modification == FALSE){?>
                <input type="date" id="date_naissance" name="date_naissance" required></textarea><br/>
                <?php } else{?>
                <input type="date" id="date_naissance" name="date_naissance" value=<?php echo "\"" . $tableau[0][3] . "\"";?> required></textarea><br/>
                <?php }?>
                
                <label for="description">Description :</label>
                <?php if($modification == FALSE){?>
                <textarea id="description" name="description" required></textarea><br/>
                <?php } else{?>
                <textarea id="description" name="description" required><?php echo $tableau[0][4];?></textarea><br/>
                <?php }?>
                
                <label for="email">Email :</label>
                <?php if($modification == FALSE){?>
                <input type="email" id="email" name="email" required/><br/>
                <?php } else{?>
                <input type="email" id="email" name="email" value=<?php echo "\"" . $tableau[0][5] . "\"";?> required/><br/>
                <?php }?>
                
                <label for="pseudo">Pseudo :</label>
                <?php if($modification == FALSE){?>
                <input type="text" id="pseudo" name="pseudo" required/><br/>
                <?php } else{?>
                <input type="text" id="pseudo" name="pseudo" value=<?php echo "\"" . $tableau[0][6] . "\"";?> required/><br/>
                <?php }?>
                
                <label for="mot_de_passe">Mot de passe :</label>
                <?php if($modification == FALSE){?>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required/><br/>
                <?php } else{?>
                <input type="password" id="mot_de_passe" name="mot_de_passe" value=<?php echo "\"" . $tableau[0][7] . "\"";?> required/><br/>
                <?php }
                
                if($admin == TRUE)
                {?>
                <label for="admin">Administrateur</label>
                <?php
                if(verifier_admin($_REQUEST['id_user']) == TRUE)
                {
                ?>
                <input type="radio" name="admin" value="1" checked="checked" /><br/>
                <input type="radio" name="admin" value="0"/>
                <?php
                }
                else
                {
                ?>
                <input type="radio" name="admin" value="1"/><br/>
                <input type="radio" name="admin" value="0" checked="checked"/>
                <?php
                }
                ?>
                <label for="admin">Utilisateur</label><br/>
                <?php}
                if($modification == FALSE)
                {
                ?>
                <input type="submit" name="inscription" value="Inscription"/>
                <input type="reset" name="effacer" value="Effacer"/>
                <a id="annuler_inscription" href="index.php">Annuler<a/>
                <?php
                } 
                else
                {
                ?>
                <input id="a" type="submit" name="modification" value="Modifier"/>
                <a id="annuler_modification" href="profil.php">Annuler<a/>
                <?php }?>
            </form>
        </div>
    </body>
</html>