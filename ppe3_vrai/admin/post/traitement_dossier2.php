<?php 
require_once('../../bdd/connect.php');
function securite($data){
    $data=strip_tags($data);
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;
    }
    
    
    if( isset($_POST['initie']) && !empty(['initie']) &&
    isset($_POST['id_candidat']) && !empty(['id_candidat']) &&
    isset($_POST['id_etat']) && !empty(['id_etat']) 
      ){
         $id = securite($_POST['id_candidat']);
         $id_etat = securite($_POST['id_etat']);
         $initie = securite($_POST['initie']);

    $dossier= $db->prepare("INSERT INTO `dossier_etat`(`id_candidat`, `id_etat`, `initie`)
     VALUES (:id_candidat, :id_etat, :initie)");
                $dossier->bindValue(':initie',$initie,PDO::PARAM_STR);
                $dossier->bindValue(':id_etat',$id_etat,PDO::PARAM_INT);
                $dossier->bindValue(':id_candidat',$id,PDO::PARAM_INT );
                $dossier->execute();
    
        header("location: ../dossier.php?idcandidat=$id");

            }

             
    if( isset($_POST['dossier_reçu']) && !empty(['dossier_reçu']) &&
        isset($_POST['financeur']) && !empty(['financeur'])&&
        isset($_POST['id_candidat']) && !empty(['id_candidat']) &&
        isset($_POST['id_etat']) && !empty(['id_etat']) 
    ){
        $id = securite($_POST['id_candidat']);
        $id_etat = securite($_POST['id_etat']);
        $dossier_reçu = securite($_POST['dossier_reçu']);
        $dossier1 = securite($_POST['financeur']);
        var_dump($_POST);

        $dossier= $db->prepare("UPDATE `dossier_etat` SET 
        `transmis`= :dossier,`financeur`= :dossier1 
        WHERE `id_candidat`= :id_candidat && `id_etat`= :id_etat");
          $dossier->bindValue(':dossier',$dossier_reçu,PDO::PARAM_STR);
          $dossier->bindValue(':id_etat',$id_etat,PDO::PARAM_INT);
          $dossier->bindValue(':id_candidat',$id,PDO::PARAM_INT );
          $dossier->bindValue(':dossier1',$dossier1,PDO::PARAM_STR);
          $dossier->execute();
    
        header("location: ../dossier.php?idcandidat=$id");

            }

    
             
    if( isset($_POST['date']) && !empty(['date']) &&
    isset($_POST['decision']) && !empty(['decision'])&&
    isset($_POST['id_candidat']) && !empty(['id_candidat']) &&
    isset($_POST['id_etat']) && !empty(['id_etat']) 
){
    $id = securite($_POST['id_candidat']);
    $id_etat = securite($_POST['id_etat']);
    $dossier_fin= securite($_POST['date']);
    $decision = securite($_POST['decision']);

    $dossier= $db->prepare("UPDATE `dossier_etat` SET 
    `date`= :dossier,`id_etat`= :decision 
    WHERE `id_candidat`= :id_candidat && `id_etat`= :id_etat");
      $dossier->bindValue(':dossier',$dossier_fin,PDO::PARAM_STR);
      $dossier->bindValue(':id_etat',$id_etat,PDO::PARAM_INT);
      $dossier->bindValue(':id_candidat',$id,PDO::PARAM_INT );
      $dossier->bindValue(':decision',$decision,PDO::PARAM_STR);
      $dossier->execute();

    header("location: ../dossier.php?idcandidat=$id");
        }
        
var_dump($_POST);
?>