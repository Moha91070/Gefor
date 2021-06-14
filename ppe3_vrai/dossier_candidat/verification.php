<?php

session_start();

$id=$_SESSION['idcandidat'];


// Condition au cas ou mauvais identifiant se connecte
if(empty($_SESSION)) 
    {
        header ('location:../index.php');
    }
elseif($_SESSION['groupe'] != 3 && $_SESSION['groupe'] != 4) 
    {
        header ('location:../redirection.php');
    }
elseif($_SESSION['idcandidat'] != $id)
    {
    header('location:../index.php');
    }