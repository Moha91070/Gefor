<?php
require_once('../../bdd/connect.php');

 // Fonction faille de sécurité
 function securite($data){
    $data=strip_tags($data);
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;
    }

    // Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['id']) && !empty($_GET['id'])){
    
    $id = securite($_GET['id']);
    $choix = securite($_GET['choix']);

    $pre_select= $db->prepare("UPDATE candidat SET `id_groupe` = $choix WHERE idcandidat = $id");
    $pre_select->execute();
header('location: ../attente_candidat.php?choix= Votre décision à bien été pris en compte');
}











?>