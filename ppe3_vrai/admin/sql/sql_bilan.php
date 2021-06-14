<?php

require_once('../bdd/connect.php');

function securite($data){
    $data=strip_tags($data);
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;
    }

  
    
    // Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['idcandidat']) && !empty($_GET['idcandidat'])){


// On nettoie l'id envoyé
$id = securite($_GET['idcandidat']);

// On prépare la requête
$query = $db->prepare("SELECT nom_dusage,nom_jeunefille,prenom,email,adresse,cp,ville,nationalite,p.session,
situation_pro.libelle as situ_pro,formation.libelle as form_pro,organisme_connu,autre_soutien,decision,
candidat.elementdeclencheur, candidat.objectif2,charges_familiales,soutien_entourage, diplome,entretien,
candidat.objectif3,candidat.objectif4,candidat.objectif5,candidat.objectif7, adequation,remarque_decision,
candidat.objectif8,candidat.pk_formation,candidat.points_forts,epreuve_dispense, stages, avis_projet,
candidat.axe_progres, court, moyen, long_terme, reunion_info,resultat_test, motivations,remarque_entretien
FROM candidat 
INNER JOIN formation
on candidat.id_formation = formation.idformation
INNER JOIN situation_pro
on situation_pro.idsituation_pro = candidat.id_situation
LEFT JOIN periode as p
ON p.idsession = candidat.id_session

WHERE candidat.idcandidat = $id
");
$query->execute();
$resultat = $query->fetch();

}
$div = $db->prepare("SELECT * FROM effectuer
INNER JOIN divers
on divers.iddivers = effectuer.id_d 
WHERE id_c = $id");
$div->execute();
$divers = $div->fetchall();

$lang = $db->prepare("SELECT * FROM parler
INNER JOIN langues
ON langues.idlangues = parler.idlangues 
WHERE idcandidat = $id");
$lang->execute();
$langue = $lang->fetchall();

$log = $db->prepare("SELECT * FROM utiliser
INNER JOIN logiciel
ON logiciel.idlogiciel = utiliser.idlogiciel
WHERE id_candidat = $id");
$log->execute();
$logi = $log->fetchall();


$entrepri = $db->prepare("SELECT * FROM entreprise
INNER JOIN demarche_entreprise
on demarche_entreprise.iddemarche_entreprise = entreprise.id_demarche
WHERE id_cand = $id");
$entrepri->execute();
$demarche = $entrepri->fetchall();

$vehicule = $db->prepare("SELECT * FROM vehiculer
INNER JOIN transport
on transport.idtransport = vehiculer.id_trans
WHERE id_candi = $id");
$vehicule->execute();
$vehiculer = $vehicule->fetchall();

$dossier = $db->prepare("SELECT * FROM etat_dossier
INNER JOIN dossier_etat
on dossier_etat.id_etat = etat_dossier.id
WHERE id_candidat = $id");
$dossier->execute();
$dossier_etat = $dossier->fetch();

$statut= $db->prepare("SELECT * FROM `etat_dossier`");
$statut->execute();
$dossier_statut = $statut->fetchall();

  
if (empty($dossier_etat['initie'])) {
    $dossier_initie= '<form action="post/traitement_dossier2.php" method= "POST">
                <label for="initie"> Dossier initié le : </label>
                <input type="date" name="initie" required>
                <input type="hidden" name= " id_etat" value= 4 >
                <input type="hidden" name="id_candidat" value='. $id.' >
                <input type="submit" value="valider">
                </form>';
}else{     
    $dossier_initie = " <p>Dossier initié le : ".  $dossier_etat['initie']. "</p>
    <p>Session : ". $resultat['session']."</p>" ;
}

if (empty($dossier_etat['transmis']) && !empty($dossier_etat['initie'])) {
    $dossier_transmis= "<form action='post/traitement_dossier2.php' method= 'POST'>
                        <label for='dossier'>Dossier transmis le :</label>
                        <input type='date' name='dossier_reçu' required >
                        <label for='financeur'>Financeur : </label>
                        <input type='text' name='financeur' required> 
                        <input type='hidden' name= ' id_etat' value= 4 >
                        <input type='hidden' name='id_candidat' value= $id>
                        <input type='submit' value='valider'>
                        "; 
}else{
    $dossier_transmis = "<p>Dossier transmis le : ".$dossier_etat['transmis']."</p>".
    "<p>Dossier financé par : ".$dossier_etat['financeur']."</p>"    ;
}

if (empty($dossier_etat['date']) && !empty($dossier_etat['transmis'])) {
    $dossier_stat = "<form action='post/traitement_dossier2.php' method= 'POST'>
    <div>
    <input type='radio' name='decision' value = 6 required>
    <label for='accord'>Accord de prise en charge</label>
    <input type='radio' name='decision' value= 7 required>
    <label for='refus'>Refus</label>
    <input type='radio' name='decision' value= 3 required>
    <label for='annulation'>annulation</label>
    <input type='radio' name='decision' value=2 required>
    <label for='repor'>Report</label>
   
</div>
    <div>
        <label for='etat'>date : accord/refus/annulation/report : </label>
        <input type='date' name='date' required >
    </div>
    <input type='hidden' name= ' id_etat' value= 4 >
    <input type='hidden' name='id_candidat' value= $id>
    <input type='submit' value='valider'>
    "; 
}else{
    $dossier_stat = "<p>Dossier finaliser le : ".$dossier_etat['date']."</p>".
    "<p> état du Dossier : ".$dossier_etat['nom']."</p>"    ;
}
?>