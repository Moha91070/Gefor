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
    // Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_GET['idcandidat']) && !empty($_GET['idcandidat'])){
        // On nettoie l'id envoyé
        $id = securite($_GET['idcandidat']);
   

    
    
    
    // On prépare la requête
    $query = $db->prepare("SELECT nom_dusage,nom_jeunefille,prenom,email,adresse,cp,ville,nationalite,
                                   situation_pro.libelle as situ_pro,formation.libelle as form_pro,divers.libelle as div_pro,organisme_connu,
                                    parler.niveau as langues,niveau_logiciel, candidat.elementdeclencheur, candidat.objectif2,
                                    candidat.objectif3,candidat.objectif4,candidat.objectif5,candidat.objectif7,
                                    candidat.objectif8,candidat.pk_formation,candidat.points_forts,
                                    candidat.axe_progres,demarche_entreprise.libelle as demarche,apres_formation,libellé_transport, remarque_decision
                                    charges_familiales,avis_formatrice,amenagement_parcours
                            FROM candidat 
                            INNER join session
                            on candidat.id_session = session.idsession
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
                            on transport.idtransport = vehiculer.id_trans
                            WHERE candidat.idcandidat = $id");

    // On execute la requete
    $query->execute();

    // On recupere le produit
    $resultat = $query->fetch();
    
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Page de suppression</title>
</head>
<body>
     
       
		  
    <div class="row">
        <section class="col-12">
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
                    <p> Prestations de formation visant :  </p>
                    <p><?= $resultat['div_pro']?></p>
                    <p>Avez vous assisté à une réunion d'information collective animée par un financeur ?</p>
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
                                <tr>
                                    <td><?= $resultat['langues']?></td>
                                    <td><?= $resultat['langues']?></td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <thead>
                                    <th>Logiciels et outils informatiques</th>
                                    <th>Niveaux de compétences</th>
                                </thead>
                                <tr>
                                    <td><?= $resultat['niveau_logiciel']?></td>
                                    <td><?= $resultat['niveau_logiciel']?></td>
                                </tr>
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
                        <p>Enquêtes auprès de professionnels : <?= $resultat['demarche']?></p>
                        <p>Visistes de salons : <?= $resultat['demarche']?></p>
                        <p>Consultations d'annonces : <?= $resultat['demarche']?></p>
                        <p>Cours du soir : <?= $resultat['demarche']?></p>
                        <p>Autres : <?= $resultat['demarche']?></p>
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
                        <p>Court terme : <?= $resultat['apres_formation']?></p>
                        <p>Moyen terme : <?= $resultat['apres_formation']?></p>
                        <p>Long terme : <?= $resultat['apres_formation']?></p>
                    </div>
                    <div>
                        <h2>Point fort</h2>
                        <p><?= $resultat['points_forts']?></p>
                        <h2>Axes de progrés à envisager</h2>
                        <p><?= $resultat['axe_progres']?></p>
                    </div>
        
        </section>
    
    <fieldset>
        <h2>Bilan de l'entretien</h2>
        <p>Avis sur la faisabilité du projet et condition de réalisation (prise en compte des 
            contraintes financières, transport, charges familiales, travail personnel, investissement personnel, etc..)
         </p>   
            <p>Transport : <?= $resultat['libellé_transport']?></p>
            <p>charges familiales : <?= $resultat['charges_familiales']?></p>
        <p>Avis sur la formation visée (adéquation avec le projet professionnel, pré-requis, réduction de
            parcours.
        </p>
        <p><?= $resultat['avis_formatrice']?></p>
        <p>Aménagement de parcours possible ? <?= $resultat['amenagement_parcours']?></p>

    </fieldset>
    </div>
         
     
            <p><a href="liste_attente_dev.php">Retour a la page demandeur</a></p>
    <header>

    </header>

</body>       
</html>