<?php
//require("redirection_admin.php");
require_once("../../bdd/connect.php");
if(isset($_GET['id_employe']) && !empty($_GET['id_employe'])){
	$id=$_GET['id_employe'];
    $query = $db->prepare("DELETE FROM `employe` WHERE `id_employe`= :id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
	$query->execute();
}

header('Location: ../tab_employe.php');
require_once("../../bdd/close.php"); 
		
?>