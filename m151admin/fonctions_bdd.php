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
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    $donnees = $bdd->query($requete)->fetchAll(PDO::FETCH_NUM);
    return $donnees;
}

function requete_update($requete) {
    $bdd = connexion();
    $donnees = $bdd->query($requete);
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
    $requete = <<< REQUETE
            INSERT INTO utilisateurs(nom_utilisateurs, prenom_utilisateurs,
            date_de_naissance_utilisateurs, description_utilisateurs,
            email_utilisateurs, pseudo_utilisateurs, mot_de_passe_utilisateurs)
            VALUES("$nom", "$prenom", "$date_naissance", 
            "$description", "$email", "$pseudo", "$mot_de_passe");
REQUETE;
    requete($requete);
}

function recuperer_profil_general()
{
    $requete = "SELECT * FROM utilisateurs;";
    $resultat = requete($requete);
    return $resultat;
}

function recuperer_profil_detail($id)
{
    $requete = "SELECT * FROM utilisateurs WHERE id_utilisateurs = $id";
    $resultat = requete($requete);
    return $resultat;
}

function modifier_profil($id,$nom,$prenom,$date_naissance,$description,$email,$pseudo,$mot_de_passe)
{
    $requete = <<< REQUETE
            UPDATE utilisateurs 
            SET    nom_utilisateurs = "$nom",
                   prenom_utilisateurs = "$prenom",
                   date_de_naissance_utilisateurs = "$date_naissance",
                   description_utilisateurs = "$description",
                   email_utilisateurs = "$email",
                   pseudo_utilisateurs = "$pseudo",
                   mot_de_passe_utilisateurs = "$mot_de_passe"
            WHERE  id_utilisateurs = "$id";
REQUETE;
    requete_update($requete);
}