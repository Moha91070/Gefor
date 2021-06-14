<?php
// inclusion du header dans la page 
require_once("../header.php");
require_once("nav.php");
require_once("redirection_dev.php");
// On inclut la connexion a la base
require_once("../bdd/connect.php");
$query=$db->prepare("SELECT * FROM langues;");
$query->execute();
$result_langue=$query->fetchall();

$query1=$db->prepare("SELECT idlangues,langues,date_ajout,date_modification  FROM logiciel WHERE libelle NOT IN ('AUTRES(S)  LOGICIELS(S) A PRECISER');");
$query1->execute();
$result_logiciel=$query1->fetchall();

$query2=$db->prepare("SELECT iddemarche_entreprise, libelle,date_ajout,date_modification FROM demarche_entreprise WHERE libelle NOT IN ('AUTRES');");
$query2->execute();
$result_demarche=$query2->fetchall();



function securite($param){
    $param=strip_tags($param);
    $param=trim($param);
    $param=htmlspecialchars($param);
    return $param;
}


if(isset($_POST)){
    
    if(isset($_POST['langueslv1']) && !empty($_POST['langueslv1'])
    && isset($_POST['niveaulv1']) && !empty($_POST['niveaulv1'])
    && isset($_POST['langueslv2']) && !empty($_POST['langueslv2'])
    && isset($_POST['niveaulv2']) && !empty($_POST['niveaulv2'])
    && isset($_POST['logiciel']) && !empty($_POST['logiciel'])
    && isset($_POST['niveaulogiciel']) && !empty($_POST['niveaulogiciel'])
    && isset($_POST['element_declencheur']) && !empty($_POST['element_declencheur'])    
    && isset($_POST['objectif2']) && !empty($_POST['objectif2'])    
    && isset($_POST['objectif3']) && !empty($_POST['objectif3'])
    && isset($_POST['objectif4']) && !empty($_POST['objectif4'])
    && isset($_POST['objectif5']) && !empty($_POST['objectif5'])
    && isset($_POST['demarche']) && !empty($_POST['demarche'])
    && isset($_POST['objectif7']) && !empty($_POST['objectif7'])
    && isset($_POST['objectif7']) && !empty($_POST['objectif8'])
    && isset($_POST['pk_formation']) && !empty($_POST['pk_formation'])    
    && isset($_POST['apres_formation']) && !empty($_POST['apres_formation'])    
    && isset($_POST['points_forts']) && !empty($_POST['points_forts'])    
    && isset($_POST['axe_progres']) && !empty($_POST['axe_progres'])    
    ){

        $langueslv1=securite($_POST['langueslv1']);
        $niveaulv1=securite($_POST['niveaulv1']);
        $langueslv2=securite($_POST['langueslv2']);
        $niveaulv2=securite($_POST['niveaulv2']);
        $logiciels=($_POST['logiciel']);
        $logicielAutre=securite($_POST['logicielautre']);
        $niveaulogiciel=($_POST['niveaulogiciel']);
        $element_declencheur=securite($_POST['element_declencheur']);
        $objectif2=securite($_POST['objectif2']);
        $objectif3=securite($_POST['objectif3']);
        $objectif4=securite($_POST['objectif4']);
        $objectif5=securite($_POST['objectif5']);
        $demarches=($_POST['demarche']);
        $demarchesAutre=securite($_POST['demarcheautre']);
        $objectif7=securite($_POST['objectif7']);
        $objectif8=securite($_POST['objectif8']);
        $pk_formation=securite($_POST['pk_formation']);
        $apres_formation=securite($_POST['apres_formation']);
        $points_forts=securite($_POST['points_forts']);
        $axe_progres=securite($_POST['axe_progres']);


       $idc=$db->prepare("SELECT idcandidat FROM candidat WHERE idcandidat=34;") ;
       $idc->execute();
       $id_candidat = $idc->fetch() ;
       $id_candidat = $id_candidat['idcandidat'] ;
       

       $query=$db->prepare("INSERT INTO parler (idcandidat, idlangues,niveauLV1) VALUES (?,?,?) ");
       $query1=$db->prepare("INSERT INTO parler (idcandidat, idlangues, niveauLV2) VALUES (?,?,?) ");
       $query->execute(array($id_candidat, $langueslv1, $niveaulv1));
       $query1->execute(array($id_candidat, $langueslv2, $niveaulv2));
       
       $count=count($logiciels);
       $counts=count($demarches);
    

            
           for($i=0;$i<$count;$i++){
               $logiciel1=securite($logiciels[$i]);                   
               $niveaulogiciels=securite($niveaulogiciel[$i]);
               if($logiciels[$i] == 3){
                    $query2=$db->prepare("INSERT INTO utiliser (id_candidat, idlogiciel,niveau_logiciel,commentaire) VALUES (?,?,?,?) ");
                    $query2->execute(array($id_candidat, $logiciel1, $niveaulogiciels,$logicielAutre));

               }else{
                    $query2=$db->prepare("INSERT INTO utiliser (id_candidat, idlogiciel,niveau_logiciel) VALUES (?,?,?) ");
                    $query2->execute(array($id_candidat, $logiciel1, $niveaulogiciels,));
                }
           }
       

       $query4=$db->prepare("UPDATE client
                             SET elementdeclencheur = `$element_declencheur`,objectif2=`$objectif2`,objectif3=`$objectif3`,objectif4=`$objectif4`,objectif5=`$objectif5`,objectif7=`$objectif7`,objectif8=`$objectif8`,pk_formation=`$pk_formation`,apres_formation=`$apres_formation`,points_forts=`$points_forts`,axe_progres=`$axe_progres`; ");




       
        for($i=0;$i<$counts;$i++){
            $demarche1=securite($demarches[$i]);
            if($demarches[$i]== 5){
                 $query3=$db->prepare("INSERT INTO entreprise (id_cand, id_demarche,commentaire) VALUES (?,?,?) ");
                 $query3->execute(array($id_candidat, $demarche1,$demarchesAutre));

            }else{
                $query3=$db->prepare("INSERT INTO entreprise (id_cand, id_demarche) VALUES (?,?) ");
                $query3->execute(array($id_candidat, $demarche1));
             }
        }

        header('location: upload.php');
       
        
    }else{
        $error= "erreur 1";
    }
}else{
    $error= "erreur 2";
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Formulaire d'inscription partie 2</title>
    
    
</head>
<body>

    <form action="formulaire2_inscription.php" method="post">
        <fieldset>
            <div class="champ">
            <?php if(isset($error)){echo "<span style='color: red'>".$error."</span>";}else{echo "<br>";}?>
                <h2>Langues vivantes</h2>
                <label>Choisissez votre LV1:</label>
                <select name="langueslv1" id="langues">
                    <optgoup>

                <?php
                    foreach($result_langue as $langue){?>
                        
                     <option value="<?= $langue['idlangues']?>"><?= $langue['langues']?></option>                          
                    
                        
                    <?php
                        }?>
                      </optgroup>
                </select>
                    <br>
                    <br>
                    <label>Niveau de compétence :</label>
                  <select name="niveaulv1" id="niv_langues">
                  <optgroup>
					<option value="débutant">débutant</option>
                    <option value="intermediaire">intermediaire</option>                   
                    <option value="courant ">courant </option>                   
                    <option value="bilingue ">bilingue </option>                   
                    <option value="langue maternelle ">langue maternelle </option>                   
                   </optgroup>
                </select>

                <br>
                <br>
                <br>
                <label>Choisissez votre LV2:</label>
                <select name="langueslv2" id="langues">
                    <optgoup>

                <?php
                    foreach($result_langue as $langue){?>
                        
                     <option value="<?= $langue['idlangues']?>"><?= $langue['langues']?></option>                          
                    
                        
                    <?php
                        }?>
                      </optgroup>
                </select>
                        <br>
                        <br>
                        <label>Niveau de compétence :</label>
                  <select name="niveaulv2" id="niv_langues">
                  <optgroup>
					<option value="débutant">débutant</option>
                    <option value="intermediaire">intermediaire</option>                   
                    <option value="courant ">courant </option>                   
                    <option value="bilingue ">bilingue </option>                   
                    <option value="langue maternelle ">langue maternelle </option>                   
                   </optgroup>
                </select>
               

            </div>
            <div class="champ">
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
                    <input type="text" name="logicielautre" value="" id="myBtn" >
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
            <input type="text" name="element_declencheur" value="">
            <br>
            <br>
            <h2>Objectif poursuivis</h2>
            
            <label>2- Quelles sont les fonctions ou métier vers lesquels vous souhaitez vous diriger ?</label><br>
            <input type="text" name="objectif2" value="">
            <br>
            <br>
            
                    
            <label>3- Qu’attendez-vous de ce changement ? <br>(ex. : évolution interne ou externe, augmentation des revenus,meilleur équilibre entre vie professionnelle et personnelle, etc.)</label><br>
            <input type="text" name="objectif3" value="">
            <br>
            <br>

            
            
            <label>4- D’après vous, quelles sont les principales connaissances et compétences nécessaires à l’exercice du métier visé ?</label><br>
            <input type="text" name="objectif4" value="">
            <br>
            <br>

            
            
            <label>5- Quelles informations retenez-vous sur l’état du marché de l’emploi concernant ce métier ou cette activité ?</label><br>
            <input type="text" name="objectif5" value="">
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
                <input type="text" name="demarcheautre" value="" id="myBt" >
            <br>
            <br>

            
            
            <label>7- Citez les atouts dont vous disposez pour exercer cette activité :<br>
            (Expérience professionnelle ou expérience extra-professionnelle, atouts personnels, etc.).</label><br>   
            <input type="text" name="objectif7" value="">
            <br>
            <br>
            
            
            <label>8- Décrivez en quelques lignes le contenu des activités et missions principales que vous aurez à réaliser dans l’exercice de votre futur métier ou de vos futures fonctions, selon vous :</label><br>
            <input type="text" name="objectif8" value="">
            <br>
            <br>
            
            <h2>Choix de la formation</h2>
            <label>9- En quoi la formation choisie est-elle nécessaire à la réalisation de votre projet ?</label><br>
            <input type="text" name="pk_formation" value="">
            <br>
            <br> 
            
            <h2>Après la formation</h2>
            <label>10- A l’issue de la formation, que comptez-vous faire à court, moyen et long terme ?<br>
            (Recherche d’emploi externe, création d’activité ou d’entreprise, postuler en interne, poursuite d’études, etc.)</label><br>
            <label>Court, moyen, long terme: </label><br>
            <input type="text" name="apres_formation" value="">
            <br>
            <br> 
            <table>
                    <thead>
                        <th><h2>Points forts    </h2></th>
                        <th><h2> Axes de progrès à envisager</h2></th>>
                    </thead>
                    <tbody>
                        <tr>
                            <th><input type="text" name="points_forts" value=""></th>
                            <th><input type="text" name="axe_progres" value=""></th>
                        </tr>
                    </tbody>
            </table>

         

            
        
        
            
        </fieldset>

 

        <fieldset>
            <legend>Finaliser l'inscription:</legend>
            <input type="submit" value="Valider">
        </fieldset>
    </form>
<?php
 require_once("../footer.php");
 ?>
    </body>
</html>