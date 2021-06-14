<?php
require_once('../bdd/connect.php');

function securite($data){
    $data=strip_tags($data);
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;
}

//condition de session:
//require("redirection_admin.php");

    if(isset($_GET['page']) && !empty($_GET['page'])){
        $currentPage = (int) strip_tags($_GET['page']);
    }else{
        $currentPage = 1;
    }
    
    
    
    
    
    $parPage = 20;
    // On calcule le nombre de pages total
  
  
 
    if(isset($_GET['idforma']) && !empty($_GET['idforma'])){
         $formation= securite($_GET['idforma']);

         $compter= $db->prepare("SELECT COUNT(*) as nbPersonne FROM candidat 
            WHERE   id_groupe = 7 and id_formation = :formation");
            $compter->bindValue(':formation', $formation, PDO::PARAM_INT);
            $compter->execute();
            $nbPersonne= $compter->fetch();
            $nbPerso = (int) $nbPersonne['nbPersonne'];
            $pages = ceil($nbPerso / $parPage);
            $premier = ($currentPage * $parPage) - $parPage;

         $base_joint = $db->prepare("SELECT idcandidat,date_naissance,prenom,nom_dusage,
         cp,ville,email,tel,formation.libelle,candidat.date_ajout FROM candidat 
         INNER JOIN formation
         on candidat.id_formation = formation.idformation
         WHERE  id_groupe =7 and id_formation = :formation
         LIMIT :premier, :parpage
         ");
         $base_joint->bindValue(':premier', $premier, PDO::PARAM_INT);
         $base_joint->bindValue(':parpage', $parPage, PDO::PARAM_INT);
         $base_joint->bindValue(':formation', $formation, PDO::PARAM_INT);
 
         $base_joint->execute();
         $candidat= $base_joint->fetchall(pdo::FETCH_ASSOC);

    }  else{
        $compter= $db->prepare("SELECT COUNT(*) as nbPersonne FROM candidat 
        WHERE  id_groupe = 7 ");
        $compter->execute();
        $nbPersonne= $compter->fetch();
        $premier = ($currentPage * $parPage) - $parPage;

        $base_joint = $db->prepare("SELECT idcandidat,date_naissance,prenom,nom_dusage,
        cp,ville,email,tel,formation.libelle,candidat.date_ajout FROM candidat 
        INNER JOIN formation
        on candidat.id_formation = formation.idformation
        WHERE  id_groupe =7
        LIMIT :premier, :parpage
        ");

        $base_joint->bindValue(':premier', $premier, PDO::PARAM_INT);
        $base_joint->bindValue(':parpage', $parPage, PDO::PARAM_INT);
        $base_joint->execute();
        $candidat= $base_joint->fetchall(pdo::FETCH_ASSOC);
        $nbPerso = (int) $nbPersonne['nbPersonne'];
        $pages = ceil($nbPerso / $parPage);



    }


        

?>
