<?php
//Création de la session dans la page
session_start();
//On recupere l'email de la session
$login=$_SESSION['login'];
$id = $_SESSION['id_employe'];
$nom = $_SESSION['nom'];
$groupe = $_SESSION['groupe'];
$prenom = $_SESSION['prenom'];

// Condition au cas ou mauvais identifiant se connecte
if(empty($_SESSION)) 
    {
        header ('location:../index.php');
    }
elseif($groupe != 2) 
    {
        header ('location:../index.php');
    }
elseif($_SESSION['login'] != $login)
    {
    header('location:../index.php');
    }
?>