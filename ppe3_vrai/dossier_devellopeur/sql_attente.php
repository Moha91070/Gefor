<?php
function securite($data){
    $data=strip_tags($data);
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;
    }
    // On determine sur quelle page on se trouve
if(isset($_GET['idcandidat']) && !empty($_GET['idcandidat'])){
    $currentPage = (int)securite($_GET['idcandidat']);
}
else{
    $currentPage = 1;
}
    require_once("../bdd/connect.php"); // connexion à la BDD
    //On creer la requete
$sql = "SELECT COUNT(*) AS nb_candidat FROM candidat WHERE id_groupe != 4;";
    // On prepare la requete
$query = $db->prepare($sql);
    // On execute la requete 
$query->execute();
$result = $query->fetch();
    //On affiche ensuite le nombre total de membres
$nbcandidat = (int)$result['nb_candidat'];
    //On determine le nombre de logiciels par page
$parpage = 5;
    //On calcule le nombre de page total et arrondi grace a la fonction ceil
$pages = ceil($nbcandidat / $parpage);
$premier = ($currentPage * $parpage) - $parpage;
    // On écrit la requete
$sql = "SELECT idcandidat,nom_dusage, nom_jeunefille, prenom, date_naissance, adresse, cp, ville, email, tel,
 nationalite, elementdeclencheur, objectif2, objectif3, objectif4, objectif5, objectif7, objectif8, 
 pk_formation, apres_formation, points_forts, formation.libelle, 
 axe_progres, charges_familiales, avis_formatrice, amenagement_parcours,
 remarque_entretien, motivations, resultat_test, avis_projet, decision, 
 remarque_decision, organisme_connu, id_situation, commentaire_situation,
  id_formation, id_session, id_groupe, candidat.date_ajout, candidat.date_modification, cursus_formulaire 
        FROM candidat
        INNER JOIN formation
        ON formation.idformation = candidat.id_formation
         WHERE id_groupe = 4
         ORDER BY prenom DESC LIMIT :premier, :parpage;";
    // On prepare la requete
$query = $db->prepare($sql);
$query->bindValue(':premier', $premier, PDO::PARAM_INT);
$query->bindValue(':parpage', $parpage, PDO::PARAM_INT);
    // On execute 
$query->execute();
    // On recupere les valeurs dans un tableau associatif 
$candidat = $query->fetchall(PDO::FETCH_ASSOC);
   
?>