<?php
require_once('../bdd/connect.php');
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
    // Est-ce que l'id existe et n'est pas vide dans l'URL
    if(isset($_GET['idcandidat']) && !empty($_GET['idcandidat'])){
    

        // On nettoie l'id envoyé
        $id = securite($_GET['idcandidat']);
      
        // On prépare la requête
        $query = $db->prepare("SELECT nom_dusage,nom_jeunefille,prenom,email,adresse,cp,ville,nationalite,
        situation_pro.libelle as situ_pro,formation.libelle as form_pro,organisme_connu,
        candidat.elementdeclencheur, candidat.objectif2,
        candidat.objectif3,candidat.objectif4,candidat.objectif5,candidat.objectif7,
        candidat.objectif8,candidat.pk_formation,candidat.points_forts,
        candidat.axe_progres, court, moyen, long_terme, reunion_info
        FROM candidat 
        INNER JOIN formation
        on candidat.id_formation = formation.idformation
        INNER JOIN situation_pro
        on situation_pro.idsituation_pro = candidat.id_situation
        WHERE candidat.idcandidat = ?");
        $query->bindValue(1, $id, PDO::PARAM_INT);
        $query->execute();
        $resultat = $query->fetch();
        
    }
        $div = $db->prepare("SELECT id_c,id_d,commentaire,iddivers,divers.libelle
        FROM effectuer
        INNER JOIN divers
        on divers.iddivers = effectuer.id_d 
        WHERE id_c = ?");
        $div->bindValue(1, $id, PDO::PARAM_INT);
        $div->execute();
        $divers = $div->fetchall();
        
    
        $lang = $db->prepare("SELECT parler.idcandidat,parler.idlangues,niveau,langues.idlangues,langues.langues
        FROM parler
        INNER JOIN langues
        ON langues.idlangues = parler.idlangues 
        WHERE idcandidat = ?");
        $lang->bindValue(1, $id, PDO::PARAM_INT);
        $lang->execute();
        $langue = $lang->fetchall();
    
        $log = $db->prepare("SELECT utiliser.id_candidat,utiliser.idlogiciel,niveau_logiciel,commentaire,logiciel.idlogiciel,logiciel.libelle 
        FROM utiliser
        INNER JOIN logiciel
        ON logiciel.idlogiciel = utiliser.idlogiciel
        WHERE id_candidat = ?");
        $log->bindValue(1, $id, PDO::PARAM_INT);
        $log->execute();
        $logi = $log->fetchall();
        
    
        $entrepri = $db->prepare("SELECT entreprise.id_cand,entreprise.id_demarche,entreprise.commentaire,iddemarche_entreprise,demarche_entreprise.libelle  
        FROM entreprise
        INNER JOIN demarche_entreprise
        on demarche_entreprise.iddemarche_entreprise = entreprise.id_demarche
        WHERE id_cand = ?");
        $entrepri->bindValue(1, $id, PDO::PARAM_INT);
        $entrepri->execute();
        $demarche = $entrepri->fetchall();
     /*

   
    LEFT OUTER JOIN vehiculer
    on vehiculer.id_candi = candidat.idcandidat
    INNER JOIN transport
    on transport.idtransport = vehiculer.id_trans"
    */
?>

     
<p><a href="demandeur.php">Retour a la page demandeur</a></p>  
<h2>Dossier candidature - Formation continue</h2>
                <fieldset>
                    <legend><h2>Identité</h2></legend> 
                    <p>Nom de candidat : <?= $resultat['nom_dusage']?></p>
                    <p>Nom de jeune fille :<?= $resultat['nom_jeunefille']?></p>
                    <p>Prenom du candidat : <?= $resultat['prenom']?></p>
                    <p>E-mail du membre : <?= $resultat['email']?></p>
                    <p>Adresse : <?= $resultat['adresse']?></p>
                    <p>Code postal : <?= $resultat['cp']?></p>
                    <p>Ville : <?= $resultat['ville']?></p>
                    <p>Nationalité : <?= $resultat['nationalite']?></p>
                </fieldset>
                <fieldset>
                    <legend>
                        <h2>Situation actuelle</h2>
                    </legend>
                    <p> <?= $resultat['situ_pro']?></p>
                </fieldset> 
                <fieldset>
                    <legend>
                        <h2>Formation visée</h2>
                    </legend>
                    <p> <?= $resultat['form_pro']?></p>
                </fieldset> 
                <fieldset>
                    <legend>
                        <h2>Divers</h2>
                    </legend>
                   
                    <p> Prestations de formation visant : </p>
                    <p> <?php foreach($divers as $diver){?> <?= $diver['libelle'],"  ", $diver['commentaire']?> <?php }?></p>
                    <p>Avez vous assisté à une réunion d'information collective animée par un financeur ?</p>
                     <p><?= $resultat['reunion_info']?>	</p>
                    <p>Comment avez-vous connu notre organisme?</p> 
                    <p><?= $resultat['organisme_connu']?></p>
                    
                </fieldset>
                <fieldset> 
                    <legend>Niveau de connaissances en langages et bureautique</legend>
                <table>
                            <tbody>
                                <thead>
                                    <th>Langues vivantes</th>
                                    <th>Niveaux de compétences</th>
                                </thead>
                                
                                <?php foreach($langue as $language){?>
                                <tr>
                                    <td><?= $language['langues']?></td>
                                    <td><?= $language['niveau']?></td>
                                </tr>     
                                    <?php } ?>
                               
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <thead>
                                    <th>Logiciels et outils informatiques</th>
                                    <th>Niveaux de compétences</th>
                                </thead>
                                <?php foreach($logi as $logiciel){?>
                                <tr>
                                    <td><?= $logiciel['libelle']," ", $logiciel['commentaire']; ?></td>
                                    <td><?= $logiciel['niveau_logiciel'] ?></td>
                                    
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                </fieldset>     
                <fieldset>
                    <legend>
                        <h2>Votre projet</h2>
                    </legend>
                    <div>
                        <h2>Element déclencheur</h2>
                        <p>1- Quelles sont les raisons qui vous aménes à vouloir modifier ou changer de situation professionnelle ?</p>
                        <p><?= $resultat['elementdeclencheur']?></p>
                    </div>
                    <div>
                        <h2>Objectifs poursuivis</h2>
                        <p>2- Quelles sont les fonctions ou métier vers lequels vous souhaitez vous diriger ?</p>
                        <p><?= $resultat['objectif2']?></p>
                    </div>
                    <div>
                        <p>3- Qu'attendez-vous de ce changement</p>
                        <p><?= $resultat['objectif3']?></p>
                    </div>
                    <div>
                        <p>4-D'après vous, quelles sont les principales connaissances et compéteces nécéssaires à
                            l'exercice du métier visé ?
                        </p>
                        <p><?= $resultat['objectif4']?></p>
                    </div>
                    <div>
                        <p>5- Quelles informations retenez-vous sur l'état du marché de l'emploi concernant
                            ce métier ou cette activité ? </p>
                            <p><?= $resultat['objectif5']?></p>
                    </div>
                    <div>
                        <p>6- Quelle démarches avez-vous entreprises pour élaborer votre projet?</p>
                                   <?php foreach($demarche as $dema){?>
                                    <p><?=$dema['libelle'],"  ".$dema['commentaire']."</br>"?> </p>
                                    <?php }?>
                    </div>
                    <div>
                        <p>7- Citez les atouts dont vous disposez pour exercer cette activité?</p>
                        <p><?= $resultat['objectif7']?></p>
                    </div>
                    <div>
                        <p>8- Décrivez en quelques lignes le contenue des activités et mission principales
                            que vous aurez à réaliser dans l'exercice de votre futur métier ou de vos futures 
                            fonction, selon vous :
                        </p>
                        <p><?= $resultat['objectif8']?></p>
                    </div>
                    <div>
                        <h2>Choix de la formation</h2>
                        <p>9- En quoi la formation choisie est elle nécessaire à la réalisation de votre projet ?</p>
                        <p><?= $resultat['pk_formation']?></p>                    
                    </div>
                    <div>
                        <h2> Après la formation </h2>
                        <p>10- A lissue de la formation, que comptez-vous faire à court moyen et long terme ?</p>

                        <p>Court terme : <?= $resultat['court']?></p>
                        <p>Moyen terme : <?= $resultat['moyen']?></p>
                        <p>Long terme : <?= $resultat['long_terme']?></p>
                    </div>
                    <div>
                        <h2>Point fort</h2>
                        <p><?= $resultat['points_forts']?></p>
                        <h2>Axes de progrés à envisager</h2>
                        <p><?= $resultat['axe_progres']?></p>
                    </div>
        
        </section>
    
    </div>
</body>       
</html>