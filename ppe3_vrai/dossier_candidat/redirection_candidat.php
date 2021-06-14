<?php

session_start();

    if($_SESSION['cursus'] == 0 ){
        header('location:formulaire_inscription.php');  
    }elseif ($_SESSION['cursus'] == 1 ){
        header('location:formulaire2_inscription.php');
    }elseif ($_SESSION['cursus'] == 2 || $_SESSION['cursus'] == 3 ){
        header('location:accueil_candidat.php');
    }else{
        header('location:../index.php');
    } 
