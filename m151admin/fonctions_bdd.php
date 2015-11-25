<?php
/* 
    Created on : 26 août 2015
    Author     : Nicolas Boccard
*/
require_once('sql.php');



/**-----------------------------------------------------------------------------
 * Fonction pour se connecter à la base donées
 * @staticvar type $connexion || Connexion établie ou non
 * @return \PDO               || Retourne un objet PDO
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





/**-----------------------------------------------------------------------------
 * Executer les requêtes SELECT reçu
 * @param type $requete || Requête à executer
 * @return type         || Retourne un tableau de données 
 */
function requete_R($requete)
{
    $bdd = connexion();
    $donnees = $bdd->query($requete)->fetchAll(PDO::FETCH_NUM);
    return $donnees;
}





/**-----------------------------------------------------------------------------
 * Execute les requêtes CREAT, UPDATE et DELETE reçu
 * @param type $requete || Requête à executer
 * @return type         || Retourne un tableau de données
 */
function requete_CUD($requete) {
    $bdd = connexion();
    $donnees = $bdd->query($requete);
    return $donnees;
}





/**-----------------------------------------------------------------------------
 * Fonction qui crée la requête pour insérer un utilisateurs
 * @param type $nom            || Nom de l'utilisateur
 * @param type $prenom         || Prénom de l'utilisateur
 * @param type $date_naissance || Date de naissance de l'utilisateur
 * @param type $description    || Description de l'utilisateur
 * @param type $email          || Email de l'utilisateur
 * @param type $pseudo         || Pseudo de l'utilisateur
 * @param type $mot_de_passe   || Mot de passe de l'utilisateur
 */
function inscription($nom,$prenom,$date_naissance,$description,$email,$pseudo,$mot_de_passe,$classe)
{
    $resultat = verifier_pseudo($pseudo);
    if ($resultat == NULL)
    {
        $requete = <<< REQUETE
                INSERT INTO utilisateurs(nom_utilisateurs, prenom_utilisateurs,
                date_de_naissance_utilisateurs, description_utilisateurs,
                email_utilisateurs, pseudo_utilisateurs, mot_de_passe_utilisateurs, id_classes)
                VALUES("$nom", "$prenom", "$date_naissance", 
                "$description", "$email", "$pseudo", "$mot_de_passe", "$classe");
REQUETE;
        requete_CUD($requete);
    }
    else
    {
        echo "Ce pseudonyme existe déja veuillez en choisir un autre.";
    }
}





/**-----------------------------------------------------------------------------
 * Fonction pour récupérer tout les profils de la table utilisateurs
 * @return type || Retourne un tableau de données
 */
function recuperer_profil_general()
{
    $requete = "SELECT * FROM utilisateurs;";
    $resultat = requete_R($requete);
    return $resultat;
}





/**-----------------------------------------------------------------------------
 * Fonction pour récupérer seulement un profil de la table utilisateurs
 * @param type $id || Id de l'utilisateur
 * @return type    || Retourne un tableau de données
 */
function recuperer_profil_detail($id)
{
    $requete = "SELECT * FROM utilisateurs WHERE id_utilisateurs = $id";
    $resultat = requete_R($requete);
    return $resultat;
}
//------------------------------------------------------------------------------





/**-----------------------------------------------------------------------------
 * Fonction pour modifier le profil d'un utilisateur
 * @param type $id             || Id de l'utilisateur
 * @param type $nom            || Nom de l'utilisateur
 * @param type $prenom         || Prénom de l'utilisateur
 * @param type $date_naissance || Date de naissance de l'utilisateur
 * @param type $description    || Description de l'utilisateur
 * @param type $email          || Email de l'utilisateur
 * @param type $pseudo         || Pseudo de l'utilisateur
 * @param type $mot_de_passe   || Mot de passe de l'utilisateur
 */
function modifier_profil($id,$nom,$prenom,$date_naissance,$description,$email,$pseudo,$mot_de_passe,$pouvoir)
{
    $requete = <<< REQUETE
            UPDATE utilisateurs 
            SET    nom_utilisateurs = "$nom",
                   prenom_utilisateurs = "$prenom",
                   date_de_naissance_utilisateurs = "$date_naissance",
                   description_utilisateurs = "$description",
                   email_utilisateurs = "$email",
                   pseudo_utilisateurs = "$pseudo",
                   mot_de_passe_utilisateurs = "$mot_de_passe",
                   statut_utilisateurs = "$pouvoir"
            WHERE  id_utilisateurs = "$id";
REQUETE;
    requete_CUD($requete);
}





/**-----------------------------------------------------------------------------
 * Fonction pour supprimer le profil d'un utilisateur
 * @param type $id || Id de l'utilisateur
 */
function supprimer_profil($id)
{
    $requete = <<< REQUETE
            DELETE FROM utilisateurs
            WHERE id_utilisateurs = "$id";
REQUETE;
    requete_CUD($requete);
    header('Location: deconnexion.php');
    
}





/**-----------------------------------------------------------------------------
 * Fonction pour vérifier si l'utilisateur existe lors de la connexion
 * @param type $pseudo || Pseudo de l'utilisateur
 * @param type $mdp    || Mot de passe de l'utilisateur
 */
function verifier_connexion($pseudo, $mdp)
{
    $requete = <<< REQUETE
            SELECT * FROM `utilisateurs` WHERE pseudo_utilisateurs = "$pseudo" AND mot_de_passe_utilisateurs = "$mdp";
REQUETE;
    $validation = requete_R($requete);
    if($validation != NULL)
    {
		//attention ne pas mettre les infos de session dans une fonction qui traite avec la BD, 
		//on essaie de séparer, vous l'avez très bien fait avec le reste du code
        $tableau = array(
            "connecte"        => TRUE,
            "id_utilisateurs" => $validation[0][0],
            "pouvoir"         => $validation[0][8]
        );
    }
    else
        $tableau = array("connecte" => FALSE);
    return $tableau;
}





/**
 * Fonction pour verifier si la personne connectée est un admin ou un utilisateur
 * @param type $id || Id de la personne
 * @return boolean || Retourne un booléen
 */
function verifier_admin($id)
{
    $resultat = recuperer_profil_detail($id);
    if ($resultat[0][8] == 1)
        $admin = TRUE;
    else
        $admin = FALSE;
    return $admin;
}





/**
 * Fonction qui vérifie si le pseudo existe déja dans la base de données
 * @param type $pseudo || Pseudo choisit par la personne
 * @return type || Retourne soit un tableau soit NULL
 */
function verifier_pseudo($pseudo)
{
    $requete = <<< REQUETE
                SELECT * FROM utilisateurs WHERE pseudo_utilisateurs = "$pseudo";
REQUETE;
    $resultat = requete_R($requete);
    return $resultat;
}


function afficher_classes()
{
    $requete = <<< REQUETE
            SELECT * FROM classes;
REQUETE;
    $resultat = requete_R($requete);
    return $resultat;
}


function afficher_classes_detail($classe) {
    $requete = <<< REQUETE
            SELECT * FROM classes WHERE nom_classes = "$classe";
REQUETE;
    $resultat = requete_R($requete);
    return $resultat;
}