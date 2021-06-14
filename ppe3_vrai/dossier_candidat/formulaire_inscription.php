<?php
require_once('verification.php');
if($_SESSION['cursus'] != 0){
    header('location:redirection_candidat.php');
}
    

require_once('../bdd/connect.php');

/* test 1
 */
$query=$db->prepare("SELECT * FROM situation_pro");
$query->execute();
$result_sp=$query->fetchall();

$query1=$db->prepare("SELECT * FROM formation;");
$query1->execute();
$result_for=$query1->fetchall();

$query2=$db->prepare("SELECT * FROM divers ;");
$query2->execute();
$result_divers=$query2->fetchall();


function securite($param){
    $param=strip_tags($param);
    $param=trim($param);
    $param=htmlspecialchars($param);
    $param1=str_replace("'","\'",$param);
    return $param1;
}
function securite1($param){
    $param=strip_tags($param);
    $param=trim($param);
    $param=htmlspecialchars($param);
    
    return $param;
}     

    
       

if (isset($_POST['situation']) && !empty($_POST['situation'])
    && isset($_POST['formation']) && !empty($_POST['formation'])
    && isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['prenom']) && !empty($_POST['prenom'])
    && isset($_POST['date_naissance']) && !empty($_POST['date_naissance'])
    && isset($_POST['nationalite']) && !empty($_POST['nationalite'])
    && isset($_POST['adresse']) && !empty($_POST['adresse'])
    && isset($_POST['cp']) && !empty($_POST['cp'])
    && isset($_POST['ville']) && !empty($_POST['ville'])    
    && isset($_POST['tel']) && !empty($_POST['tel'])        
    && isset($_POST['op']) && !empty($_POST['op'])){

        $candidat=[];
        (isset($_POST['nom_dusage']) && !empty($_POST['nom'])) ? $candidat['nom_dusage'] = securite($_POST['nom']) : "";
        (isset($_POST['nom_jf']) && !empty($_POST['nom_jf'])) ? $candidat['nom_jeunefille'] = securite($_POST['nom_jf']) : "";
        (isset($_POST['prenom']) && !empty($_POST['prenom'])) ? $candidat['prenom'] = securite($_POST['prenom']) : "";
        (isset($_POST['date_naissance']) && !empty($_POST['date_naissance'])) ? $candidat['date_naissance'] = securite($_POST['date_naissance']) : "";
        (isset($_POST['adresse']) && !empty($_POST['adresse'])) ? $candidat['adresse'] = securite($_POST['adresse']) : "";
       
        (isset($_POST['cp']) && !empty($_POST['cp'])) ? $candidat['cp'] = securite($_POST['cp']) : "";
        (isset($_POST['ville']) && !empty($_POST['ville'])) ? $candidat['ville'] = securite($_POST['ville']) : "";
        (isset($_POST['tel']) && !empty($_POST['tel'])) ? $candidat['tel'] = securite($_POST['tel']) : "";
        (isset($_POST['nationalite']) && !empty($_POST['nationalite'])) ? $candidat['nationalite'] = securite($_POST['nationalite']) : "";
        (isset($_POST['op']) && !empty($_POST['op'])) ? $candidat['organisme_connu'] = securite($_POST['op']) : "";
        (isset($_POST['situation']) && !empty($_POST['situation'])) ? $candidat['id_situation'] = securite($_POST['situation']) : "";
        (isset($_POST['situation_autre']) && !empty($_POST['situation_autre'])) ? $candidat['commentaire_situation'] = securite($_POST['situation_autre']) : "";
        (isset($_POST['formation']) && !empty($_POST['formation'])) ? $candidat['id_formation'] = securite($_POST['formation']) : "";
        (isset($_POST['reunion_info']) && !empty($_POST['reunion_info'])) ? $candidat['reunion_info'] = securite($_POST['reunion_info']) : "";
        (isset($_SESSION['idcandidat']) && !empty($_SESSION['idcandidat'])) ? $id= securite($_SESSION['idcandidat']) : "";
        (isset($_SESSION['idcandidat']) && !empty($_SESSION['idcandidat'])) ? $candidat['cursus_formulaire'] = 1 : "";
        
        foreach($candidat as $colonne => $valeur){
            if(!empty($valeur)){
                $table_candidat= $db->prepare("UPDATE candidat SET $colonne = :valeur WHERE idcandidat = :id ");
                $table_candidat->bindValue(":valeur",$valeur,PDO::PARAM_STR);
                $table_candidat->bindValue(":id",$id,PDO::PARAM_INT);
                $table_candidat->execute();
            }

        }
  
        $divers=$_POST['divers'];
        $divers_autre=securite($_POST['divers_autre']);
      

        

        $_SESSION['cursus']=1;

        $count=count($divers);
        for($i=0;$i<$count;$i++){
            $divers1=securite($divers[$i]);                   
            
            if($divers[$i] == 5){
                    $query2=$db->prepare("INSERT INTO effectuer (id_c, id_d,commentaire, date_ajout) VALUES (:id,:divers1,':divers_autre',current_timestamp) ");
                    $query2->bindValue(':id', $id, PDO::PARAM_INT); 
                    $query2->bindValue(':divers1', $divers1, PDO::PARAM_INT); 
                    $query2->bindValue(':divers_autre', $divers_autre, PDO::PARAM_STR); 
                    $query2->execute();

            }else{
                    $query2=$db->prepare("INSERT INTO effectuer (id_c, id_d, date_ajout) VALUES (:id,:divers1,current_timestamp) ");
                    $query2->bindValue(':id', $id, PDO::PARAM_INT); 
                    $query2->bindValue(':divers1', $divers1, PDO::PARAM_INT); 
                    $query2->execute();
                }
        }
           
            $_POST=null;
            header('location: formulaire2_inscription.php');

        }elseif(isset($_POST) && !empty($_POST)){
            $error= "Certaines données sont manquantes";            
            foreach($_POST as $champs => $valeur){
                if($champs!="divers"){
                    $_SESSION['erreur'][$champs]=securite1($valeur);
                }
            }
        }


   

   

?>

</script>


<?php
$title="Formulaire d'inscription";
require_once('../header.php');

?>
    <div>
        <button><a href="logout.php">DECONNEXION</a></button>
    </div>

    <form action="formulaire_inscription.php" method="post">
        <fieldset>
            <div >
            <?php if(isset($error)){echo "<strong style='color: red'>".$error."</strong>";}else{echo "<br>";}?>
                <h2>Situation professionnel</h2>
                <?php
                    foreach($result_sp as $situation){
                        if ($situation['libelle'] == 'autre'){?>                        
                        <input type="radio" id= "5" name="situation" value="<?=$situation['idsituation_pro']?>" onclick="myFunction1()" <?php if(isset($_SESSION['erreur']) && $_SESSION['erreur']['situation'] ==  $situation['idsituation_pro']){echo "checked";}?>  required>
                        <label for="situation_autre">autre</label>
                        <input type="text" id="myBtn" name="situation_autre" value=" "  > 
                        <?php
                        }else{?>                       
                        <input type="radio" id= "<?= $situation['idsituation_pro']?>" name="situation"<?php if(isset($_SESSION['erreur']) && $_SESSION['erreur']['situation'] ==  $situation['idsituation_pro']){echo "checked";}?>  value="<?= $situation['idsituation_pro']?>"   onclick="myFunction()" required>
                        <label for="situation"><?= $situation['libelle']?></label>
                        <?php
                            }?>   
                    <?php
                        }?>    

               

            </div>
            <div >
                <h2>Formation visée</h2>
                <?php
                    foreach($result_for as $formation){?>
                    <input type="radio" id="<?= $formation['idformation'].'formation'?>"name="formation"<?php if(isset($_SESSION['erreur']) && $_SESSION['erreur']['situation'] ==  $formation['idformation']){echo "checked";}?>  value="<?= $formation['idformation']?>" required>
                    <label for="formation"><?= $formation['libelle']?></label>
                        
                    <?php
                        }
                    ?>
                

            </div>
        
        
            <div >
                <h2>Identité</h2>
                <label for="nomjf">Nom de jeune fille: </label>
                <input type="text" id="nomjf" name="nomjf"pattern="[a-zA-ZÀ-ÿ]{2,50}" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['nomjf'])){echo $_SESSION['erreur']['nomjf'];}?>">
                <label for="nom">Nom d'usage: </label>
                <input type="text" id="nom" pattern="[a-zA-ZÀ-ÿ]{0,50}" name="nom" value="<?=$_SESSION['nom']?>" >
                <label for="prenom">Prénom: </label>
                <input type="text" id="prenom" pattern="[a-zA-ZÀ-ÿ]{1,50}" name="prenom" value="<?=$_SESSION['prenom']?>"required>
            </div>
            <br>
            <div >

                <label for="date_naissance">Né (e): </label>
                <input type="date" id="date" min="1900-01-01" max="2002-12-31" name="date_naissance" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['date_naissance'])){echo $_SESSION['erreur']['date_naissance'];}?>" required>
                <label for="nationalite">Nationalité: </label>
                <input type="text" id="nationalite" name="nationalite" pattern="[a-zA-ZÀ-ÿ]{1,50}"value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['nationalite'])){echo $_SESSION['erreur']['nationalite'];}?>">
            </div>
            <br>
            <div >
                <label for="id">Adresse: </label>
                <input type="text" id="adresse" name="adresse" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['adresse'])){echo $_SESSION['erreur']['adresse'];}?>"required>
                <label for="id">Code postal: </label>
                <input type="text" id="cp" pattern="[0-9]{5}" name="cp" minlength="5" maxlength="5" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['cp'])){echo $_SESSION['erreur']['cp'];}?>"required>
                <label for="id">Ville: </label>
                <input type="text" id="ville" name="ville" pattern="[a-zA-ZÀ-ÿ]{1,50}" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['ville'])){echo $_SESSION['erreur']['ville'];}?>" required>
            </div>
            <br>
            <div >
                <label for="id">Téléphone: </label>
                <input type="text" pattern="[0-9]{10}" id="tel" name="tel" minlength="10" maxlength="10" size="10" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['tel'])){echo $_SESSION['erreur']['tel'];}?>"required>
                

            </div>
            <div >
                <h2>Divers</h2>  
                <p>Avez-vous suivi préalablement des prestations de formations visant à:</p>
                <?php
                    foreach($result_divers as $divers){
                        if ($divers['libelle'] == "Autre"){?>
                        <input type="checkbox" id="<?= $divers['iddivers']?>"name="divers[]" value="<?= $divers['iddivers']?>" >
                        <label for="divers"><?= $divers['libelle']?></label>
                        <input type="text" id="<?= $divers['iddivers']?>"name="divers_autre" value="<?php $divers['iddivers']?>" >
                        <?php
                        }else{
                        ?>
                    <input type="checkbox" id="<?= $divers['iddivers']?>"name="divers[]" value="<?= $divers['iddivers']?>" >
                    <label for="divers"><?= $divers['libelle']?></label>
                        
                    <?php
                        }?>
                <?php
                    
                    }
                ?>

                <br>
                <br>
                <p>Avez-vous assisté à une réunion d’information collective animée par votre financeur? </p>
                <input type="radio" id="" name="reunion_info" value="1" <?php if(isset($_SESSION['erreur']) && $_SESSION['erreur']['reunion_info'] ==  1 ){echo "checked";}?> >
                <label for="reunion_info">oui</label>
                <input type="radio" id="" name="reunion_info" value="0" <?php if(isset($_SESSION['erreur']) && $_SESSION['erreur']['reunion_info'] ==  0 ){echo "checked";}?>>
                <label for="reunion_info">non</label>

                <br>
                <p>Comment avez-vous connu notre organisme ?</p>
                <input type="text" id="op"name="op" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['op'])){echo $_SESSION['erreur']['op'];}?>" required>


            </div>        
        </fieldset>

 

        <fieldset>
            <legend>Etape suivante :</legend>
            <input type="submit" value="Suivant">
        </fieldset>
    </form>

<?php
       // require_once('../footer.php')

?>
    