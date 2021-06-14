<?php
// démarrage d'une session
session_start();
// Destruction de la session
session_destroy();
//On redirige vers la page d'accueil
header("location:../index.php");
?>