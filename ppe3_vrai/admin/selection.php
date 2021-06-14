<?php
require_once('../bdd/connect.php');
$title = "Détail";
require_once("header.php");
require_once("nav_admin.php");

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
    candidat.axe_progres, court, moyen, long_terme, reunion_info FROM candidat 
    INNER JOIN formation
    on candidat.id_formation = formation.idformation
    INNER JOIN situation_pro
    on situation_pro.idsituation_pro = candidat.id_situation
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

    $session = $db->prepare("SELECT  idsession,`session`, `duree`, `datedebut`, `datefin` FROM 
    `periode` order  by datedebut ASC ");
    $session->execute();
    $session1=$session->fetchall();
    
?>

     
       
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
    <legend><h2>Situation actuelle</h2> </legend>
        <p> <?= $resultat['situ_pro']?></p>
</fieldset> 
<fieldset>
    <legend><h2>Formation visée</h2></legend>
        <p> <?= $resultat['form_pro']?></p>
</fieldset> 
<fieldset>
    <legend><h2>Divers</h2> </legend>
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
    <legend><h2>Votre projet</h2></legend>
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
</fieldset>

</div>
    <form action="post/traitement_selection" method="POST">
        <fieldset>
            <legend> <h2> Décision</h2></legend>
                <div>
                    <input type="radio" name="decision" value="Favorable" reqired>
                    <label for="favorable">Favorable</label>
                </div>  
                <div>
                    <input type="radio" name="decision" value="Reserve" required>
                    <label for="reserve">Réservée</label>
                </div> 
                <div>
                    <input type="radio" name="decision"  value="Défavorable" reqired>
                    <label for="defavorable">Défavorable</label>
                </div> 
                <select name="session" id="">
                    <option value="">SESSION</option>
                    <?php foreach($session1 as $sess ){ ?>
                    <option value= <?= $sess['idsession']?>> <?= $sess['session']." durée ".$sess['duree'] ?></option>
                    <?php } ?>
                    </select>
        </fieldset>
        <fieldset>
            <legend> <h2> Bilan de l’entretien</h2> </legend>
                <div>
                    <label for="date">en date du :  </label>
                    <input type="date" name="date" required >
                </div>
                <div>
                    <p>Avis sur la faisabilité du projet et conditions de réalisation (prise en compte des contraintes 
                    financières, transport, charges familiales, travail personnel, investissement personnel, etc.)
                    </p>
                    <input type="checkbox" name="trans_commun" value= 1>
                    <label for="trans_commun">Transport en commun</label><br>
                    <input type="checkbox" name="vehicule" value= 2 >
                    <label for="vehicule">Véhiculé</label>
                </div>
                <div>
                    <label for="Charges">Charges familiales :</label>
                    <input type="text" name= charges>
                </div>
                <div>
                    <p>Soutien de l’entourage : </p>
                    <input type="radio" name="soutien" value="oui" required>
                    <label for="soutien">OUI</label>
                    <input type="radio" name="soutien" value="non" required>
                    <label for="soutien">NON</label>
                </div>
                <div>
                    <label for="autre">Autre : </label>
                    <input type="text" name="autre" >
                </div>
                <div>
                    <p> Avis sur la formation visée (adéquation avec le projet professionnel, pré-requis, réduction de 
                        parcours, etc.) :
                    </p>
                    <textarea name="avis_form"  cols="100" rows="5" ></textarea>
                </div>
                <div>
                    <p> Aménagement de parcours possible ?</p>
                    <label for="stage">Stages : </label>
                    <input type="text" name="stages">
                    <label for="diplome">Diplôme(s) validé(s) :</label>
                    <input type="text" name="diplome" >
                    <label for="epreuve">Épreuve(s) dispensée(s) : </label>
                    <input type="text" name="epreuve" >
                </div>
                <div>
                    <p> Remarques éventuelles : </p>
                    <textarea name="remarque"  cols="100" rows=6 ></textarea>
                </div>
        </fieldset>
        <fieldset>
            <legend> <h2> Synthèse candidature</h2></legend>
                <table>
                    <tr>
                        <td> Motivation</td>
                        <td>
                            <input type="radio" name="motivation" value ="--" required>
                            <label for="motivatio">--</label>
                        </td>
                        <td>
                            <input type="radio" name="motivation" value ="-" required>
                            <label for="motivatio">-</label>
                        </td>
                        <td>
                            <input type="radio" name="motivation" value ="+/-" required>
                            <label for="motivatio">+/-</label>
                        </td>
                        <td>
                            <input type="radio" name="motivation" value ="+" required>
                            <label for="motivatio">+</label>
                        </td>   
                        <td>         
                            <input type="radio" name="motivation" value ="++" required>
                            <label for="motivatio">++</label>
                        </td>   
                    </tr>
                    <tr>
                        <td>Résultats aux tests de pré requis</td>    
                        <td>
                            <input type="radio" name="resultat" value ="--" required> 
                            <label for="resultat">--</label>
                        </td>
                        <td>
                            <input type="radio" name="resultat" value ="-" required>
                            <label for="resultat">-</label>
                        </td>
                        <td>
                            <input type="radio" name="resultat" value ="+/-" required>
                            <label for="resultat">+/-</label>
                        </td>
                        <td>
                            <input type="radio" name="resultat" value ="+" required>
                            <label for="resultat">+</label>
                        </td>   
                        <td>         
                            <input type="radio" name="resultat" value ="++" required>
                            <label for="resultat">++</label>
                        </td>   
                    </tr>
                    <tr>
                        <td> Avis sur la faisabilité du projet</td>
                        <td>
                            <input type="radio" name="faisabilite" value ="--" required>
                            <label for="faisabilite">--</label>
                        </td>
                        <td>
                            <input type="radio" name="faisabilite" value ="-" required>
                            <label for="faisabiite">-</label>
                        </td>  
                        <td>
                            <input type="radio" name="faisabilite" value ="+/-" required>
                            <label for="faisabilite">+/-</label>
                        </td>
                        <td>
                            <input type="radio" name="faisabilite" value ="+" required>
                            <label for="faisabilite">+</label>
                        </td>   
                        <td>         
                            <input type="radio" name="faisabilite" value ="++" required>
                            <label for="faisabilite">++</label>
                        </td>   
                    </tr>
                </table>
        </fieldset>
        <fieldset>
            <legend>Remarque décision</legend>
                <p> Remarques éventuelles : </p>
                <textarea name="remarque_decision"  cols="100" rows=6 ></textarea>
        </fieldset>

        <input type="hidden" name="id" value=<?=$id?> required>
        <input type="submit" value="valider">
    </form>
    

