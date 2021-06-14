<?php
//condition de session:
//require("redirection_admin.php");
require_once("../../bdd/connect.php"); // connexion à la BDD

// Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['idcandidat']) && !empty($_GET['idcandidat']))
{
	$id=$_GET['idcandidat'];
    //On creer notre requete
    $sql = "DELETE FROM `candidat` WHERE `idcandidat`= $id;";
	// On prépare la requête
    $query = $db->prepare($sql);
	// On execute la requete
	$query->execute();
    header('Location:../refus.php');
}

		require_once('../../bdd/close.php');
		
?>