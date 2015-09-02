<?php
/* 
    Created on : 26 août 2015
    Author     : Nicolas Boccard
*/

require_once('sql.php');


/**
 * Fonction pour se connecter à la base donées
 * @staticvar type $connexion //Connexion établie ou non
 * @return \PDO
 */
function connexion()
{ 
    static $connexion = null;

    if ($connexion == null)
    {
        try
        {
            $bdd = new PDO('mysql:host=' . BD_HOST. ';dbname=' . BD_NAME . '', BD_USER, BD_PASSWORD);
        }
        catch (Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }
    return $bdd;
}


/**
 * Executer les requêtes reçu
 * @param type $requete // Requête à executer
 * @return type
 */
function requete($requete)
{
    $bdd = connexion();
    $sql = <<< REQUETE
            $requete;
REQUETE;
    $donnees = $bdd->query($sql)->fetchAll(PDO::FETCH_NUM);
    return $donnees;
}


/**
 * Fonction qui crée la requête pour insérer un utilisateurs
 * @param type $nom //Nom de l'utilisateur
 * @param type $prenom //Prénom de l'utilisateur
 * @param type $date_naissance //Date de naissance de l'utilisateur
 * @param type $description //Description de l'utilisateur
 * @param type $email //Email de l'utilisateur
 * @param type $pseudo //Pseudo de l'utilisateur
 * @param type $mot_de_passe //Mot de passe de l'utilisateur
 */
function inscription($nom,$prenom,$date_naissance,$description,$email,$pseudo,$mot_de_passe)
{
    $requete = "INSERT INTO utilisateurs(nom_utilisateurs, prenom_utilisateurs,"
            . " date_de_naissance_utilisateurs, description_utilisateurs, "
            . "email_utilisateurs, pseudo_utilisateurs, mot_de_passe_utilisateurs)"
            . " VALUES(\"$nom\", \"$prenom\", \"$date_naissance\", "
            . "\"$description\", \"$email\", \"$pseudo\", \"$mot_de_passe\")";
    requete($requete);
}