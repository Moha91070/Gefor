<?php 
var_dump($_POST);
function securite($data){
    $data=strip_tags($data);
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;
    }
    require_once('../../bdd/connect.php');
if(isset($_POST) && !empty($_POST)){
    $candidat=[];
    (isset($_POST['decision']) && !empty($_POST['decision'])) ? $candidat['decision'] = securite($_POST['decision']) : $candidat['decision'] =NULL;
    (isset($_POST['date']) && !empty($_POST['date'])) ? $candidat['entretien'] = securite($_POST['date']) : $candidat['entretien'] =NULL;
    (isset($_POST['charges']) && !empty($_POST['charges'])) ? $candidat['charges_familiales'] = securite($_POST['charges']) : $candidat['charges_familiales'] = NULL;
    (isset($_POST['soutien']) && !empty($_POST['soutien'])) ? $candidat['soutien_entourage'] = securite($_POST['soutien']) : $candidat['soutien_entourage'] = NULL;
    (isset($_POST['autre']) && !empty($_POST['autre'])) ? $candidat['autre_soutien'] = securite($_POST['autre']) : $candidat['autre_soutien'] = NULL;
    (isset($_POST['avis_form']) && !empty($_POST['avis_form'])) ? $candidat['adequation'] = securite($_POST['avis_form']) :  $candidat['adequation'] = NULL;
    (isset($_POST['stages']) && !empty($_POST['stages'])) ? $candidat['stages'] = securite($_POST['stages']) : $candidat['stages'] = NULL;
    (isset($_POST['diplome']) && !empty($_POST['diplome'])) ? $candidat['diplome'] = securite($_POST['diplome']) : $candidat['diplome'] = NULL;
    (isset($_POST['epreuve']) && !empty($_POST['epreuve'])) ? $candidat['epreuve_dispense'] = securite($_POST['epreuve']) : $candidat['epreuve_dispense'] = NULL;
    (isset($_POST['remarque']) && !empty($_POST['remarque'])) ? $candidat['remarque_entretien'] = securite($_POST['remarque']) : $candidat['remarque_entretien'] = NULL;
    (isset($_POST['motivation']) && !empty($_POST['motivation'])) ? $candidat['motivations'] = securite($_POST['motivation']) : $candidat['motivations'] = NULL;
    (isset($_POST['resultat']) && !empty($_POST['resultat'])) ? $candidat['resultat_test'] = securite($_POST['resultat']) : $candidat['resultat_test'] = NULL;
    (isset($_POST['faisabilite']) && !empty($_POST['faisabilite'])) ? $candidat['avis_projet'] = securite($_POST['faisabilite']) : $candidat['avis_projet'] = NULL;
    (isset($_POST['remarque_decision']) && !empty($_POST['remarque_decision'])) ? $candidat['remarque_decision'] = securite($_POST['remarque_decision']) : $candidat['remarque_decision'] =NULL;
    (isset($_POST['id']) && !empty($_POST['id'])) ? $id= securite($_POST['id']) : "";
    (isset($_POST['session']) && !empty($_POST['session'])) ? $candidat['id_session'] = securite($_POST['session']) : $candidat['id_session'] =NULL;

    foreach($candidat as $colonne => $valeur){
        if(!empty($valeur)){
            $table_candidat= $db->prepare("UPDATE candidat SET $colonne = :valeur WHERE idcandidat = :id ");
            $table_candidat->bindValue(":valeur",$valeur,PDO::PARAM_STR);
            $table_candidat->bindValue(":id",$id,PDO::PARAM_INT);
            $table_candidat->execute();
        }
    }

        $transport=[];
    (isset($_POST['trans_commun']) && !empty($_POST['trans_commun'])) ? $transport[1]= securite($_POST['trans_commun']) : $transport[1]=NULL;
    (isset($_POST['vehicule']) && !empty($_POST['vehicule'])) ? $transport[2]= securite($_POST['vehicule']) : $transport[2]=NULL;

    foreach($transport as $colonnes => $valeurs){
        if(!empty($valeurs)){
            $table_transport= $db->prepare("INSERT INTO  vehiculer (id_trans, id_candi) VALUES (:valeurs, :id )");
            $table_transport->bindValue(":valeurs",$valeurs,PDO::PARAM_INT);
            $table_transport->bindValue(":id",$id,PDO::PARAM_INT);
            $table_transport->execute();
        }

    }

     
    if(isset($_POST['decision']) && !empty($_POST['decision']) && $_POST['decision'] == "Favorable"){
        $table_candidat= $db->prepare("UPDATE candidat SET id_groupe = 3, cursus_formulaire = 3 WHERE idcandidat = :id ");
        $table_candidat->bindValue(":id",$id,PDO::PARAM_INT);
        $table_candidat->execute();
    }elseif(isset($_POST['decision']) && !empty($_POST['decision']) && $_POST['decision'] == "Reserve"){
        $table_candidat= $db->prepare("UPDATE candidat SET id_groupe = 9 WHERE idcandidat = :id ");
        $table_candidat->bindValue(":id",$id,PDO::PARAM_INT);
        $table_candidat->execute();
    }elseif(isset($_POST['decision']) && !empty($_POST['decision']) && $_POST['decision'] == "Défavorable"){
            $table_candidat= $db->prepare("UPDATE candidat SET id_groupe = 6 WHERE idcandidat = :id ");
            $table_candidat->bindValue(":id",$id,PDO::PARAM_INT);
            $table_candidat->execute();}
         
    }
    header('location:../liste_attente_admin.php?valide= Enregistré'); 
?>