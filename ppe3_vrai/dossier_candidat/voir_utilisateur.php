<?php
require_once('../bdd/connect.php');
require_once('verification.php');
if($_SESSION['cursus'] == 2 && $_SESSION['cursus'] == 3  ){
    header('location:redirection.php');
  }

$title = "Mon dossier";
require_once("../header.php");
require_once("header_candidat.php");

 // Fonction faille de sécurité
 function securite($data){
    $data=strip_tags($data);
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;
    }

    // Est-ce que l'id existe et n'est pas vide dans l'URL
if(isset($_SESSION['idcandidat']) && !empty($_SESSION['idcandidat'])){
    

    // On nettoie l'id envoyé
    $id = securite($_SESSION['idcandidat']);
  
    // On prépare la requête
    $query = $db->prepare("SELECT nom_dusage,nom_jeunefille,prenom,email,date_naissance,adresse,cp,ville,nationalite,
    situation_pro.libelle as situ_pro,formation.libelle as form_pro,organisme_connu,
    candidat.elementdeclencheur, candidat.objectif2,
    candidat.objectif3,candidat.objectif4,id_formation,candidat.objectif5,candidat.objectif7,
    candidat.objectif8,candidat.pk_formation,candidat.points_forts,
    candidat.axe_progres, court, moyen, long_terme,info_complementaire, reunion_info FROM candidat 
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
   
    $query1=$db->prepare("SELECT * FROM formation;");
    $query1->execute();
    $result_for=$query1->fetchall();
    if (isset($_POST['formation']) && !empty($_POST['formation'])
    && isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['nomjf']) && !empty($_POST['nomjf'])
    && isset($_POST['prenom']) && !empty($_POST['prenom'])
    && isset($_POST['date_naissance']) && !empty($_POST['date_naissance'])
    && isset($_POST['nationalite']) && !empty($_POST['nationalite'])
    && isset($_POST['adresse']) && !empty($_POST['adresse'])
    && isset($_POST['cp']) && !empty($_POST['cp'])
    && isset($_POST['ville']) && !empty($_POST['ville'])    
    && isset($_POST['tel']) && !empty($_POST['tel'])
    && isset($_POST['email']) && !empty($_POST['email']) ){

        
        $formation=securite($_POST['formation']);
        $nom=securite($_POST['nom']);
        $nomjf=securite($_POST['nomjf']);
        $prenom=securite($_POST['prenom']);
        $date_naissance=securite($_POST['date_naissance']);
        $nationalite=securite($_POST['nationalite']);
        $adresse=securite($_POST['adresse']);
        $cp=securite($_POST['cp']);
        $ville=securite($_POST['ville']);
        $tel=securite($_POST['tel']);
        $email=securite($_POST['email']);             
        $info=securite($_POST['info_complementaire']);             

        

        $query=$db->prepare("UPDATE candidat SET nom_dusage=?,nom_jeunefille=?,prenom=?,date_naissance=?,adresse=?,
                            cp=?,ville=?,tel=?, nationalite=?,id_formation=?,email=?,info_complementaire=?
                             WHERE idcandidat=?;");

        $query->bindValue(1, $nom, PDO::PARAM_STR);
        $query->bindValue(2, $nomjf, PDO::PARAM_STR);
        $query->bindValue(3, $prenom, PDO::PARAM_STR);
        $query->bindValue(4, $date_naissance, PDO::PARAM_STR);
        $query->bindValue(5, $adresse, PDO::PARAM_STR);
        $query->bindValue(6, $cp, PDO::PARAM_STR);
        $query->bindValue(7, $ville, PDO::PARAM_STR);
        $query->bindValue(8, $tel, PDO::PARAM_STR);
        $query->bindValue(9, $nationalite, PDO::PARAM_STR);
        $query->bindValue(10, $formation, PDO::PARAM_STR);
        $query->bindValue(11, $email, PDO::PARAM_STR);
        $query->bindValue(12, $info, PDO::PARAM_STR);
        $query->bindValue(13, $id, PDO::PARAM_INT);
        $query->execute();
        $_SESSION['erreur']="Vos modification ont bien été faite.";
          
             $_POST=null; 
            header('location: voir_utilisateur.php'); 

        }elseif(isset($_POST) && !empty($_POST)){
            $error= "Certaines données sont manquantes";            
            foreach($_POST as $champs => $valeur){
                if($champs!="divers"){
                    $_SESSION['erreur'][$champs]=securite($valeur);
                }
            }
    }
  
?>

     
       
<h2>Dossier candidature - Formation continue</h2>
<form method="post">
        <fieldset>
            <div class="champ">
            <?php
     if (isset($_SESSION['erreur'])){
         echo '<span style="color: green;">'.$_SESSION['erreur'].'</span>';
     }
     ?>
            
                <h2>Formation visée</h2>
                <?php
                    foreach($result_for as $formation){
                        if($formation['idformation']==$resultat['id_formation']){?>
                        <input type="radio" id="<?= $formation['idformation'].'formation'?>"name="formation" value="<?= $formation['idformation']?>" required checked>
                    <label for="formation"><?= $formation['libelle']?></label>
                    <?php
                        }
                        else
                        {
                    ?>
                    <input type="radio" id="<?= $formation['idformation'].'formation'?>"name="formation" value="<?= $formation['idformation']?>" required c>
                    <label for="formation"><?= $formation['libelle']?></label>
                        
                    <?php
                        }
                    }
                    ?>

            </div>
            <div class="champ">
                <h2>Identité</h2>
                <label for="nomjf">Nom de jeune fille: </label>
                <input type="text" id="nomjf" name="nomjf" value="<?= $resultat['nom_jeunefille']?>">
                <label for="nom">Nom d'usage: </label>
                <input type="text" id="nom" name="nom" value="<?= $resultat['nom_dusage']?>" required>
                <label for="prénom">Prénom: </label>
                <input type="text" id="prenom" name="prenom" value="<?= $resultat['prenom']?>"required>
            </div>
            <br>
            <div class="champ">

                <label for="date_naissance">Né (e): </label>
                <input type="date" id="date" name="date_naissance" value="<?= $resultat['date_naissance']?>"required>
                <label for="nationalité">Nationalité: </label>
                <input type="text" id="nationalite" name="nationalite" value="<?= $resultat['nationalite']?>"required>
            </div>
            <br>
            <div class="champ">
                <label for="id">Adresse: </label>
                <input type="text" id="adresse" name="adresse" value="<?= $resultat['adresse']?>"required>
                <label for="id">Code postal: </label>
                <input type="text" id="cp" name="cp" value="<?= $resultat['cp']?>"required>
                <label for="id">Ville: </label>
                <input type="text" id="ville" name="ville" value="<?= $resultat['ville']?>"required>
            </div>
            <br>
            <div class="champ">
                <label for="id">Téléphone: </label>
                <input type="text" id="tel" name="tel" value="<?= $resultat['ville']?>"required>
                <label for="id">email: </label>
                <input type="text" id="email" name="email" value="<?= $resultat['email']?>"required>
            </div>
            <div class="champ">
            <h2>Information complémentaire:</h2>
            <input type="text" id="info" name="info_complementaire" value="<?= $resultat['info_complementaire']?>"required>
            </div>
        <fieldset>
            <legend>Veuillez validé:</legend>
            
            <input type="submit" value="Validation">
        </fieldset>
        <fieldset>
            <legend>Annulez la demande:</legend>
            <p>Attention toute annulation engendrera la suppression de votre compte et donc la désactivation de vos accès</p>
            
            <td><a href="supprimer_demande.php?id=<?php echo $id ?>">Suppprimer sa demande</a></td>
        </fieldset>
    </form>
    
    </div>
