<?php


// inclusion du header dans la page 
require_once("../header.php");
require_once("nav.php");
require_once("redirection_dev.php");

 // Fonction faille de sécurité
 function securite($data){
    $data=strip_tags($data);
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;
    }
    require_once("../bdd/connect.php");

    if(isset($_GET['page']) && !empty($_GET['page'])){
        $currentPage = (int) strip_tags($_GET['page']);
    }else{
        $currentPage = 1;
    }
    
    $compter= 
    $db->prepare("SELECT COUNT(*) as nbPersonne FROM candidat 
    INNER join periode
    on candidat.id_session = periode.idsession
    INNER JOIN formation
    on candidat.id_formation = formation.idformation
    INNER JOIN situation_pro
    on situation_pro.idsituation_pro = candidat.id_situation
    LEFT OUTER JOIN utiliser
    ON candidat.idcandidat = utiliser.id_candidat
    INNER JOIN logiciel
    ON logiciel.idlogiciel = utiliser.idlogiciel
    LEFT OUTER JOIN entreprise
    on candidat.idcandidat = entreprise.id_cand
    INNER JOIN demarche_entreprise
    on demarche_entreprise.iddemarche_entreprise = entreprise.id_demarche
    LEFT OUTER JOIN effectuer
    ON candidat.idcandidat = effectuer.id_c
    INNER JOIN divers
    on divers.iddivers = effectuer.id_d
    LEFT OUTER JOIN parler
    on candidat.idcandidat = parler.idcandidat
    INNER JOIN langues
    ON langues.idlangues = parler.idlangues
    LEFT OUTER JOIN vehiculer
    on vehiculer.id_candi = candidat.idcandidat
    INNER JOIN transport
    on transport.idtransport = vehiculer.id_trans");
    
    $compter->execute();
    $nbPersonne= $compter->fetch();
    
    
    $nbPerso = (int) $nbPersonne['nbPersonne'];
    $parPage = 25;
    // On calcule le nombre de pages total
    $pages = ceil($nbPerso / $parPage);
    $premier = ($currentPage * $parPage) - $parPage;

    
    if(isset($_GET['idformation1']) && !empty($_GET['idformation1']) && $_GET['idformation1'] =='idformation'){
        $test = 1;
    }elseif(isset($_GET['idformation2']) && !empty($_GET['idformation2'])&& $_GET['idformation2'] =='idformation'){
        $test = 2;
    }elseif(isset($_GET['idformation3']) && !empty($_GET['idformation3'])&& $_GET['idformation3'] =='idformation'){
        $test = 3;
    }elseif(isset($_GET['idformation4']) && !empty($_GET['idformation4'])&& $_GET['idformation4'] =='idformation'){
        $test = 4; 
    }elseif(isset($_GET['idformation5']) && !empty($_GET['idformation5'])&& $_GET['idformation5'] =='idformation'){
        $test = 5;
    }elseif(isset($_GET['idformation6']) && !empty($_GET['idformation6'])&& $_GET['idformation6'] =='idformation'){
        $test = 6;
    }elseif(isset($_GET['idformation7']) && !empty($_GET['idformation7'])&& $_GET['idformation7'] =='idformation'){
        $test = 7;
    }else {
        $test = 'idformation' ;
    }

    if(isset($_GET['idformation1']) && !empty($_GET['idformation1']) && $_GET['idformation1'] =='idformation'){
        $doc = 'idformation1';
    }elseif(isset($_GET['idformation2']) && !empty($_GET['idformation2'])&& $_GET['idformation2'] =='idformation'){
        $doc = 'idformation2';
    }elseif(isset($_GET['idformation3']) && !empty($_GET['idformation3'])&& $_GET['idformation3'] =='idformation'){
        $doc ='idformation3';
    }elseif(isset($_GET['idformation4']) && !empty($_GET['idformation4'])&& $_GET['idformation4'] =='idformation'){
        $doc ='idformation4'; 
    }elseif(isset($_GET['idformation5']) && !empty($_GET['idformation5'])&& $_GET['idformation5'] =='idformation'){
        $doc = 'idformation5';
    }elseif(isset($_GET['idformation6']) && !empty($_GET['idformation6'])&& $_GET['idformation6'] =='idformation'){
        $doc = 'idformation6';
    }elseif(isset($_GET['idformation7']) && !empty($_GET['idformation7'])&& $_GET['idformation7'] =='idformation'){
        $doc = 'idformation7';
    }else {
        $doc = 'idformation' ;
    }
    $base_joint = $db->prepare
    ("SELECT idcandidat,nom_dusage,prenom,date_naissance,adresse,
    cp,ville,email,nationalite,id_groupe,formation.libelle as form_libelle,idformation
    FROM candidat
    INNER JOIN formation
    ON formation.idformation = candidat.id_formation
    where'idformation'='$test'
    and id_groupe = 4
    OR idformation='$test'
    and id_groupe = 4
    LIMIT :premier, :parpage");
    $base_joint->bindValue(':premier', $premier, PDO::PARAM_INT);
    $base_joint->bindValue(':parpage', $parPage, PDO::PARAM_INT);
    $base_joint->execute();
    $vue = $base_joint->fetchall(pdo::FETCH_ASSOC);
    

    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style.css">
        <title>Page d'accueil Admin</title>
</head>
<body>
  
                <h2>Liste des demandes en attente</h2>
                <a href="accueil_dev.php" class="btn btn-primary"> Retour</a>

                <Table class= "table table-hover">
        <thead>
           
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>adresse</th>
            <th>code postal</th>
            <th>ville</th>
            <th>Mail</th>
            <th>Nationalité</th>
            <th>Libellé de la formation</th>
            <th>statut</th>
            <th>Date demande</th>
            <FORM>
             <SELECT onChange="document.location=this.options[this.selectedIndex].value">
            <OPTION VALUE="#" SELECTED>     CHOISIR     </OPTION>
            <OPTION VALUE="demandeur.php?idformation=idformation">Tous</OPTION>
            <OPTION VALUE="demandeur.php?idformation1=idformation">BTS Assurance</OPTION>
            <OPTION VALUE="demandeur.php?idformation2=idformation">BTS Banque</OPTION>
            <OPTION VALUE="demandeur.php?idformation3=idformation">BTS Comptabilité et Gestion</OPTION>
            <OPTION VALUE="demandeur.php?idformation4=idformation">BTS Gestion de la PME</OPTION>
            <OPTION VALUE="demandeur.php?idformation5=idformation">BTS Management des Unités Commerciales</OPTION>
            <OPTION VALUE="demandeur.php?idformation6=idformation">BTS SIO option SLAM</OPTION>
            <OPTION VALUE="demandeur.php?idformation7=idformation">BTS SIO option SISR</OPTION>
            </SELECT>
            </FORM>
           
        </thead>
        <?php
            foreach($vue as $perso){
        ?>
                <tr>
                    <td><?= $perso['nom_dusage'] ?></td>
                    <td><?= $perso['prenom'] ?></td>
                    <td><?= $perso['date_naissance'] ?></td>
                    <td><?= $perso['adresse'] ?></td>
                    <td><?= $perso['cp'] ?></td>
                    <td><?= $perso['ville'] ?></td>
                    <td><?= $perso['email'] ?></td>
                    <td><?= $perso['nationalite'] ?></td>
                    <td><?= $perso['form_libelle'] ?></td>
                    <td><?= $perso['id_groupe'] ?></td>
                    <td></td>
                  
                    <td> <div class="btn-group">
                            <a href="detail_demandeur.php?idcandidat=<?= $perso['idcandidat'] ?>"><button type="button" class="btn btn-info" value="enable"> Info</button></a>
                            <a href="update_demandeur.php?idcandidat=<?= $perso['idcandidat'] ?>"><button type="button" class="btn btn-warning">Modifier </button></a>
                        </div> </td>
                </tr>
        <?php
            }
        ?>
    </table>
    <nav>
                    <ul class="pagination">
                        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a href="demandeur.php?page=<?= $currentPage - 1 ?>" class="page-link">Précédent</a>
                        </li>
                        <?php for($page = 1; $page <= $doc; $page++): ?>
                          <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                          <li class="page-item <?= ($currentPage == $doc) ? "active" : "" ?>">
                                <a href="demandeur.php?idformation=<?= $doc ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php endfor ?>
                          <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                          <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                            <a href="demandeur.php?<?=$doc?>=idformation" class="page-link">Suivant</a>
                        </li>
                    </ul>
                </nav>
</body>

<?php //require_once("../footer.php");?> 
</html>
