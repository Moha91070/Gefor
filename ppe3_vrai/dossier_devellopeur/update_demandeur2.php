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



$query=$db->prepare("SELECT * FROM langues;");
$query->execute();
$result_langue=$query->fetchall();

$query1=$db->prepare("SELECT * FROM logiciel WHERE libelle NOT IN ('AUTRE(S)');");
$query1->execute();
$result_logiciel=$query1->fetchall();

}


    
        
        if(isset($_POST['logiciel']) && !empty($_POST['logiciel'])
        && isset($_POST['niveaulogiciel']) && !empty($_POST['niveaulogiciel'])
        && isset($_POST['langue']) && !empty($_POST['langue'])
        && isset($_POST['niveau']) && !empty($_POST['niveau'])){

            $langues=($_POST['langue']);
            $niveau=($_POST['niveau']);            
            $logiciels=($_POST['logiciel']);
            $logicielAutre=securite($_POST['logicielautre']);
            $niveaulogiciel=($_POST['niveaulogiciel']); 

        $count1=count($niveau);
            for($i=0;$i<$count1;$i++){
                $langues1=securite($langues[$i]);                   
                
                $niveaulangues=securite($niveau[$langues[$i]-1]);
                
                $query=$db->prepare("UPDATE parler SET idlangues =?, niveau=?, date_ajout=? WHERE idcandidat=?;");
                $query->bindValue(1, $id, PDO::PARAM_INT); 
                $query->bindValue(2, $langues1, PDO::PARAM_STR); 
                $query->bindValue(3, $niveaulangues, PDO::PARAM_STR); 
                $query->execute();                   
            }
        
       

        
        
        $count=count($logiciels);
            for($i=0;$i<$count;$i++){
                $logiciel1=securite($logiciels[$i]);                   
                $niveaulogiciels=securite($niveaulogiciel[$i]);
                if($logiciels[$i] == 3){
                        $query2=$db->prepare("UPDATE utiliser SET(idlogiciel=?,niveau_logiciel=?,commentaire=? WHERE idcandidat=?;");
                        $query2->bindValue(1, $id, PDO::PARAM_INT); 
                        $query2->bindValue(2, $logiciel1, PDO::PARAM_INT); 
                        $query2->bindValue(3, $niveaulogiciels, PDO::PARAM_STR); 
                        $query2->bindValue(4, $logicielsAutre, PDO::PARAM_STR); 
                        $query2->execute();

                }else{
                        $query2=$db->prepare("UPDATE utiliser SET (idlogiciel=?,niveau_logiciel=? WHERE idcandidat=?;");
                        $query2->bindValue(1, $id, PDO::PARAM_INT); 
                        $query2->bindValue(2, $logiciel1, PDO::PARAM_INT); 
                        $query2->bindValue(3, $niveaulogiciels, PDO::PARAM_STR);
                        $query2->execute();
                    }
            }
        
    
            header('location: accueil_dev.php'); 

        }elseif(isset($_POST)&& !empty($_POST)){
            $error= "Certaine donnée sont manquantes";
            foreach($_POST as $champs => $valeur){
                if($champs!="langue" && $champs!="niveau" && $champs!="logiciel" && $champs!="niveaulogiciel" && $champs!="demarche"){
                    $_SESSION['erreur'][$champs]=$param1=securite($valeur);
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
?>
    <div>
        <button><a href="logout.php">DECONNEXION</a></button>
    </div>

    <form action="update_demandeur2.php" method="post">
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
            <legend>Finaliser l'inscription:</legend>
            <input type="submit" value="Valider">
        </fieldset>
    </form>
    <br>
    <br>

    <?php
        //require_once('../footer.php');
  
    ?>