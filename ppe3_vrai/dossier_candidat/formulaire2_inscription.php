<?php


require_once('verification.php');
if($_SESSION['cursus'] != 1){
    header('location:redirection_candidat.php');
}
   


require_once('../bdd/connect.php');




$query=$db->prepare("SELECT * FROM langues;");
$query->execute();
$result_langue=$query->fetchall();

$query1=$db->prepare("SELECT * FROM logiciel WHERE libelle NOT IN ('AUTRE(S)');");
$query1->execute();
$result_logiciel=$query1->fetchall();

$query2=$db->prepare("SELECT * FROM demarche_entreprise WHERE libelle NOT IN ('AUTRES');");
$query2->execute();
$result_demarche=$query2->fetchall();



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


    
        
        if(isset($_POST['logiciel']) && !empty($_POST['logiciel'])
        && isset($_POST['niveaulogiciel']) && !empty($_POST['niveaulogiciel'])
        && isset($_POST['langue']) && !empty($_POST['langue'])
        && isset($_POST['niveau']) && !empty($_POST['niveau'])
        && isset($_POST['element_declencheur']) && !empty($_POST['element_declencheur'])    
        && isset($_POST['objectif2']) && !empty($_POST['objectif2'])    
        && isset($_POST['objectif3']) && !empty($_POST['objectif3'])
        && isset($_POST['objectif4']) && !empty($_POST['objectif4'])
        && isset($_POST['objectif5']) && !empty($_POST['objectif5'])
        && isset($_POST['demarche']) && !empty($_POST['demarche'])
        && isset($_POST['objectif7']) && !empty($_POST['objectif7'])
        && isset($_POST['objectif7']) && !empty($_POST['objectif8'])
        && isset($_POST['pk_formation']) && !empty($_POST['pk_formation']) 
        && isset($_POST['points_forts']) && !empty($_POST['points_forts'])    
        && isset($_POST['axe_progres']) && !empty($_POST['axe_progres'])){

            $langues=($_POST['langue']);
            $niveau=($_POST['niveau']);            
            $logiciels=($_POST['logiciel']);
            $logicielAutre=securite($_POST['logicielautre']);
            $niveaulogiciel=($_POST['niveaulogiciel']);        
            $demarches=($_POST['demarche']);
            $demarchesAutre=securite($_POST['demarcheautre']);



        
            $id=$_SESSION['idcandidat'];
            $countl=count($langues);
        
            for($i=0;$i<$countl;$i++){
                $langues1=securite($langues[$i]);                   
                $niveaulangues=securite($niveau[$langues[$i]-1]);
                
                $query=$db->prepare("INSERT INTO parler (idcandidat, idlangues, niveau, date_ajout ) VALUES (?,?,?,current_timestamp) ");
                $query->bindValue(1, $id, PDO::PARAM_INT); 
                $query->bindValue(2, $langues1, PDO::PARAM_INT); 
                $query->bindValue(3, $niveaulangues, PDO::PARAM_STR); 
                $query->execute();                   
            }
        
       

        
        
        $count=count($logiciels);
        $counts=count($demarches);

        
        

                
            for($i=0;$i<$count;$i++){
                $logiciel1=securite($logiciels[$i]);                   
                $niveaulogiciels=securite($niveaulogiciel[$i]);
                if($logiciels[$i] == 3){
                        $query2=$db->prepare("INSERT INTO utiliser (id_candidat, idlogiciel,niveau_logiciel,commentaire) VALUES (?,?,?,?) ");
                        $query2->bindValue(1, $id, PDO::PARAM_INT); 
                        $query2->bindValue(2, $logiciel1, PDO::PARAM_INT); 
                        $query2->bindValue(3, $niveaulogiciels, PDO::PARAM_STR); 
                        $query2->bindValue(4, $logicielsAutre, PDO::PARAM_STR); 
                        $query2->execute();

                }else{
                        $query2=$db->prepare("INSERT INTO utiliser (id_candidat, idlogiciel,niveau_logiciel) VALUES (?,?,?) ");
                        $query2->bindValue(1, $id, PDO::PARAM_INT); 
                        $query2->bindValue(2, $logiciel1, PDO::PARAM_INT); 
                        $query2->bindValue(3, $niveaulogiciels, PDO::PARAM_STR);
                        $query2->execute();
                    }
            }
        
            $candidat=[];
            (isset($_POST['element_declencheur']) && !empty($_POST['element_declencheur'])) ? $candidat['elementdeclencheur'] = securite($_POST['element_declencheur']) : "";
            (isset($_POST['objectif2']) && !empty($_POST['objectif2'])) ? $candidat['objectif2'] = securite($_POST['objectif2']) : "";
            (isset($_POST['objectif3']) && !empty($_POST['objectif3'])) ? $candidat['objectif3'] = securite($_POST['objectif3']) : "";
            (isset($_POST['objectif4']) && !empty($_POST['objectif4'])) ? $candidat['objectif4'] = securite($_POST['objectif4']) : "";
            (isset($_POST['objectif5']) && !empty($_POST['objectif5'])) ? $candidat['objectif5'] = securite($_POST['objectif5']) : "";
           
            (isset($_POST['objectif7']) && !empty($_POST['objectif7'])) ? $candidat['objectif7'] = securite($_POST['objectif7']) : "";
            (isset($_POST['objectif8']) && !empty($_POST['objectif8'])) ? $candidat['objectif8'] = securite($_POST['objectif8']) : "";
            (isset($_POST['pk_formation']) && !empty($_POST['pk_formation'])) ? $candidat['pk_formation'] = securite($_POST['pk_formation']) : "";
            (isset($_POST['court']) && !empty($_POST['court'])) ? $candidat['court'] = securite($_POST['court']) : "";
            (isset($_POST['moyen']) && !empty($_POST['moyen'])) ? $candidat['moyen'] = securite($_POST['moyen']) : "";
            (isset($_POST['long_terme']) && !empty($_POST['long_terme'])) ? $candidat['long_terme'] = securite($_POST['long_terme']) : "";
            (isset($_POST['points_forts']) && !empty($_POST['points_forts'])) ? $candidat['points_forts'] = securite($_POST['points_forts']) : "";
            (isset($_POST['axe_progres']) && !empty($_POST['axe_progres'])) ? $candidat['axe_progres'] = securite($_POST['axe_progres']) : "";
            (isset($_POST['reunion_info']) && !empty($_POST['reunion_info'])) ? $candidat['reunion_info'] = securite($_POST['reunion_info']) : "";
            (isset($_SESSION['idcandidat']) && !empty($_SESSION['idcandidat'])) ? $id= securite($_SESSION['idcandidat']) : "";
            (isset($_SESSION['idcandidat']) && !empty($_SESSION['idcandidat'])) ? $candidat['cursus_formulaire'] = 2 : "";
         
                
            

            foreach($candidat as $colonne => $valeur){
                if(!empty($valeur)){
                    $table_candidat= $db->prepare("UPDATE candidat SET $colonne = :valeur WHERE idcandidat = :id ");
                    $table_candidat->bindValue(":valeur",$valeur,PDO::PARAM_STR);
                    $table_candidat->bindValue(":id",$id,PDO::PARAM_INT);
                    $table_candidat->execute();
                }
    
            }

            
            $_SESSION['cursus']=2;
            $_SESSION['erreur']="Votre demande a bien été pris en compte un conseillé va vous contactez.";




        
            for($i=0;$i<$counts;$i++){
                $demarche1=securite($demarches[$i]);
                if($demarches[$i]== 5){
                    $query3=$db->prepare("INSERT INTO entreprise (id_cand, id_demarche,commentaire) VALUES (?,?,?) ");
                    $query3->bindValue(1, $id, PDO::PARAM_INT); 
                    $query3->bindValue(2, $demarche1, PDO::PARAM_INT); 
                    $query3->bindValue(3, $demarchesAutre, PDO::PARAM_STR);
                    $query3->execute();

                }else{
                    $query3=$db->prepare("INSERT INTO entreprise (id_cand, id_demarche) VALUES (?,?) ");
                    $query3->bindValue(1, $id, PDO::PARAM_INT); 
                    $query3->bindValue(2, $demarche1, PDO::PARAM_INT); 
                    $query3->execute(array($id, $demarche1));
                }

            }


            header('location: accueil_candidat.php'); 

        }elseif(isset($_POST)&& !empty($_POST)){
            $error= "Certaine donnée sont manquantes";
            foreach($_POST as $champs => $valeur){
                if($champs!="langue" && $champs!="niveau" && $champs!="logiciel" && $champs!="niveaulogiciel" && $champs!="demarche"){
                    $_SESSION['erreur'][$champs]=$param1=securite1($valeur);
                }
            }
        }
    
    

?>
<script>
function myFunction() {
  document.geobjectif3ementById("myBtn").disabled = true;
  
}
function myFunction1() {
  document.geobjectif3ementById("myBtn").disabled = false;
  
}
function myFunction2() {
  document.geobjectif3ementById("myBt").disabled = true;
  
}
function myFunction3() {
  document.geobjectif3ementById("myBt").disabled = false;
  
}
</script>

<?php

$title="Formulaire d'inscription";
require_once('../header.php');
?>
    <div>
        <button><a href="logout.php">DECONNEXION</a></button>
    </div>

    <form action="formulaire2_inscription.php" method="post">
        <fieldset>
            <div >
            <?php if(isset($error)){echo "<span style='color: red'>".$error."</span>";}else{echo "<br>";}?>
                <h2>Langues vivantes</h2>
                <label>Veuillez sélectionner les langues que vous parlez:</label><br><br>

                <?php
                    foreach($result_langue as $langue){?>
                        
                    <input type="checkbox" id="<?= $langue['idlangues']?>"name="langue[]" value="<?= $langue['idlangues']?>" >
                    <label for="langues"><?= $langue['langues']?></label>                          
                    <select name="niveau[]" id="niv_langues">
                  <optgroup>
					<option value="débutant">débutant</option>
                    <option value="intermediaire">intermediaire</option>                   
                    <option value="courant ">courant </option>                   
                    <option value="bilingue ">bilingue </option>                   
                    <option value="langue maternelle ">langue maternelle </option>                   
                   </optgroup>
                </select>
                        
                    <?php
                        }?>


                
                <br>
                <br>
                
               

            </div>
            <div >
                <h2>Logiciel</h2>
                <?php
                    foreach($result_logiciel as $logiciel){?>
                    <input type="checkbox" id="logiciel"name="logiciel[]" value="<?= $logiciel['idlogiciel']?>" onclick="myFunction()" >
                    <label for="logiciel[]"><?= $logiciel['libelle']?></label>                    
                    <br>
                    <label>Niveau de compétence :</label>
                    <select name="niveaulogiciel[]" id="niv_logiciel">
                  <optgroup>
					<option value="débutant">débutant</option>
                    <option value="intermediaire">intermediaire</option>                   
                    <option value="confirmé">confirmé </option>                                    
                    <option value="expert">expert </option>                   
                   </optgroup>
                </select>
                        <br>
                        <br>
                    <?php
                        }
                    ?>
                    <input type="checkbox" id="3"name="logiciel[]" value="3" onclick="myFunction1()" >
                    <label for="logiciel">AUTRES(S)  LOGICIELS(S) A PRECISER: </label>
                    <input type="text" name="logicielautre" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['logicielautre'])){echo $_SESSION['erreur']['logicielautre'];}?>" id="myBtn" >
                    <br>
                    <label>Niveau de compétence :</label>
                    <select name="niveaulogiciel[]" id="niv_logiciel">
                  <optgroup>
					<option value="débutant">débutant</option>
                    <option value="intermediaire">intermediaire</option>                   
                    <option value="confirmé">confirmé </option>                                    
                    <option value="expert">expert </option>                   
                   </optgroup>
                </select>
                <br>
                <br>
            </div>
        </fieldset>
        <fieldset>
            
            <h2>Elements déclencheurs</h2>
            <label>1- Quelles sont les raisons qui vous amènent à vouloir modifier ou changer de situation professionnelle ?</label> <br>   
            <input type="text" name="element_declencheur" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['element_declencheur'])){echo $_SESSION['erreur']['element_declencheur'];}?>">
            <br>
            <br>
            <h2>Objectif poursuivis</h2>
            
            <label>2- Quelles sont les fonctions ou métier vers lesquels vous souhaitez vous diriger ?</label><br>
            <input type="text" name="objectif2" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['objectif2'])){echo $_SESSION['erreur']['objectif2'];}?>">
            <br>
            <br>
            
                    
            <label>3- Qu’attendez-vous de ce changement ? <br>(ex. : évolution interne ou externe, augmentation des revenus,meilleur équilibre entre vie professionnelle et personnelle, etc.)</label><br>
            <input type="text" name="objectif3" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['objectif3'])){echo $_SESSION['erreur']['objectif3'];}?>">
            <br>
            <br>

            
            
            <label>4- D’après vous, quelles sont les principales connaissances et compétences nécessaires à l’exercice du métier visé ?</label><br>
            <input type="text" name="objectif4" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['objectif4'])){echo $_SESSION['erreur']['objectif4'];}?>">
            <br>
            <br>

            
            
            <label>5- Quelles informations retenez-vous sur l’état du marché de l’emploi concernant ce métier ou cette activité ?</label><br>
            <input type="text" name="objectif5" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['objectif5'])){echo $_SESSION['erreur']['objectif5'];}?>">
            <br>
            <br>

            
            
            <label>6- Quelles démarches avez-vous entreprises pour élaborer votre projet ?</label><br>
            <br>
            <?php
                    foreach($result_demarche as $demarche){?>
                    <input type="checkbox" id="demarche"name="demarche[]" value="<?= $demarche['iddemarche_entreprise']?>" onclick="myFunction2()" >
                    <label for="demarche"><?= $demarche['libelle']?></label>
                    <br>
            <?php
                    }
            ?>
                <input type="checkbox" id="5"name="demarche[]" value="5" onclick="myFunction3()" >
                <label for="demarche">AUTRES(S): </label>
                <input type="text" name="demarcheautre" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['demarcheautre'])){echo $_SESSION['erreur']['demarcheautre'];}?>" id="myBt" >
            <br>
            <br>

            
            
            <label>7- Citez les atouts dont vous disposez pour exercer cette activité :<br>
            (Expérience professionnelle ou expérience extra-professionnelle, atouts personnels, etc.).</label><br>   
            <input type="text" name="objectif7" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['objectif7'])){echo $_SESSION['erreur']['objectif7'];}?>">
            <br>
            <br>
            
            
            <label>8- Décrivez en quelques lignes le contenu des activités et missions principales que vous aurez à réaliser dans l’exercice de votre futur métier ou de vos futures fonctions, selon vous :</label><br>
            <input type="text" name="objectif8" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['objectif8'])){echo $_SESSION['erreur']['objectif8'];}?>">
            <br>
            <br>
            
            <h2>Choix de la formation</h2>
            <label>9- En quoi la formation choisie est-elle nécessaire à la réalisation de votre projet ?</label><br>
            <input type="text" name="pk_formation" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['pk_formation'])){echo $_SESSION['erreur']['pk_formation'];}?>">
            <br>
            <br> 
            
            <h2>Après la formation</h2>
            <label>10- A l’issue de la formation, que comptez-vous faire à court, moyen et long terme ?<br>
            (Recherche d’emploi externe, création d’activité ou d’entreprise, postuler en interne, poursuite d’études, etc.)</label><br>
            <label>Court terme: </label><br>
            <input type="text" name="court" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['court'])){echo $_SESSION['erreur']['court'];}?>">
            <br>
            <label>Moyen terme: </label><br>
            <input type="text" name="moyen" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['moyen'])){echo $_SESSION['erreur']['moyen'];}?>">
            <br>
            <label>Long terme: </label><br>
            <input type="text" name="long_terme" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['long_terme'])){echo $_SESSION['erreur']['long_terme'];}?>">
            <br>
            <br> 
            <table>
                    <thead>
                        <th><h2>Points forts    </h2></th>
                        <th><h2> Axes de progrès à envisager</h2></th>
                    </thead>
                    <tbody>
                        <tr>
                            <th><input type="text" name="points_forts" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['points_forts'])){echo $_SESSION['erreur']['points_forts'];}?>"></th>
                            <th><input type="text" name="axe_progres" value="<?php if(isset($_SESSION['erreur']) && !empty($_SESSION['erreur']['axe_progres'])){echo $_SESSION['erreur']['axe_progres'];}?>"></th>
                        </tr>
                    </tbody>
            </table>

         

            
        
        
            
        </fieldset>

 

        <fieldset>
            <legend>Finaliser l'inscription:</legend>
            <input type="submit" value="Valider">
        </fieldset>
    </form>
    <br>
    <br>

    <?php
        //require_once('../footer.php');
  
    ?>