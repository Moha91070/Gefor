<?php
require_once('../bdd/connect.php');

// On determine sur quelle page on se trouve
if(isset($_GET['id_employe']) && !empty($_GET['id_employe'])){
    $currentPage = (int)securite($_GET['id_employe']);
}
else{
    $currentPage = 1;
}

$sql = "SELECT COUNT(*) AS nb_employe FROM employe ;";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetch();
    //On affiche ensuite le nombre total de membres
$nbemploye = (int)$result['nb_employe'];
    //On determine le nombre de logiciels par page
$parpage = 5;
    //On calcule le nombre de page total et arrondi grace a la fonction ceil
$pages = ceil($nbemploye / $parpage);
$premier = ($currentPage * $parpage) - $parpage;
    // On écrit la requete

$sql = "SELECT * FROM employe 
        ORDER BY prenom_employe ASC  
        LIMIT :premier, :parpage;";
    // On prepare la requete
$query = $db->prepare($sql);
$query->bindValue(':premier', $premier, PDO::PARAM_INT);
$query->bindValue(':parpage', $parpage, PDO::PARAM_INT);
$query->execute();
    // On recupere les valeurs dans un tableau associatif 
$employe = $query->fetchall(PDO::FETCH_ASSOC);
?>