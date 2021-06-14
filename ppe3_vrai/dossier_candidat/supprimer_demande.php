<?php
   require_once('../bdd/connect.php');
     //Tu recuperes l'id du contact
     $id = $_GET["id"];
     //Requete SQL pour supprimer le contact dans la base
     $query = $db->prepare("DELETE FROM candidat WHERE idcandidat = $id" );
     $query->execute();
     $_SESSION['erreur']="Votre compte à bien été supprimer, veuillez créer un compte si vous souhaiter candidater à une autre offre";
     header('location:../index.php');
     
?>