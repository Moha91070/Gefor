<?php

session_start();

if($_SESSION['groupe']== 1){
    header('location:admin/attente_candidat.php');
}elseif($_SESSION['groupe']== 2){
    header('location:dossier_devellopeur/accueil_dev.php');
}elseif($_SESSION['groupe']== 3 || $_SESSION['groupe']== 4 ){
    header('location:dossier_candidat/redirection_candidat.php');
}else{
    header('location:../index.php');
}