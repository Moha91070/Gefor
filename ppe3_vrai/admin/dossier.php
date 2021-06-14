<?php 
    require('header.php');
    require('nav_admin.php');
    require_once('../bdd/connect.php');
    require('sql/sql_bilan.php');

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



<H1>DOSSIER FINANCIER</H1>

<?= $dossier_initie?>
<?= $dossier_transmis?>
<?= $dossier_stat?>



     
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
 
 
    <form action="sql_selection" method="POST">
    <fieldset>
        <legend> <h2> Décision</h2></legend>
        <div>
            <p><?=$resultat['decision']?> </p>
        </div> 
    </fieldset>
        
        <fieldset>
            <legend> <h2> Bilan de l’entretien</h2> </legend>
            <div>
                <p> Date d'entretien : <?=$resultat['entretien']?> </p>
            </div>
            <div>
                <p>Avis sur la faisabilité du projet et conditions de réalisation (prise en compte des contraintes 
                financières, transport, charges familiales, travail personnel, investissement personnel, etc.)
                </p>

                <p>Réponse :</p>

                <?php foreach ($vehiculer as $key ){ ?>
                    
                <p><?=$key['libelle_transport'] ?> </p>
                <?php } ?>
            </div>

            <div>
                <p>Charges familiales : <?= $resultat['charges_familiales']?></p>
            </div>

            <div>
                <p>Soutien de l’entourage : <?= $resultat['soutien_entourage']?></p>
            
            </div>
            <div>
                <p>Autre : <?= $resultat['autre_soutien']?></p>
            </div>
            <div>
                <p> Avis sur la formation visée (adéquation avec le projet professionnel, pré-requis, réduction de 
                    parcours, etc.) :
                </p>
                    <p>Réponse : <?= $resultat['adequation']?></p>
            </div>
            <div>
                <p>Aménagement de parcours possible ?</p>
                <p>Stages : <?= $resultat['stages']?> </p>
                <p>Diplôme(s) validé(s) : <?= $resultat['diplome']?></p>
                <p>Épreuve(s) dispensée(s) : <?= $resultat['epreuve_dispense']?></p>
            </div>

        <div>
            <p> Remarques éventuelles : <?= $resultat['remarque_entretien']?> </p>
        </div>
    </fieldset>

    <fieldset>
        <legend> <h2> Synthèse candidature</h2></legend>
       
          
        <table>     
            <thead>
                    <th> Motivation</th>
                    <th>Avis sur la faisabilité du projet</th>
                    <th>Résultats aux tests de pré requis</th>
            
            </thead>
            <tr>
                <td>
                     <?= $resultat['avis_projet']?>
                </td>   
                <td>
                     <?= $resultat['motivations']?>
                </td> 
                <td>
                     <?= $resultat['resultat_test']?>
                </td>             
            </tr>
        </table>
    </fieldset>
    
    <div>
            <p> Remarques éventuelles : <?=$resultat['remarque_decision'] ?></p>
    </div>
    </fieldset>
    </form>
    


