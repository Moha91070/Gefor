<?php 
// On appelle la page de redirection 
require_once("redirection_dev.php");

// On appelle la page sql 
//require_once("sql.php");

// On inclut la connexion a la base
require_once("../bdd/connect.php");
function securite($data){
    $data=strip_tags($data);
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;
}

$query=$db->prepare("SELECT * FROM situation_pro WHERE libelle NOT IN ('autre');");
$query->execute();
$result_sp=$query->fetchall();

$query1=$db->prepare("SELECT * FROM formation;");
$query1->execute();
$result_for=$query1->fetchall();

$query2=$db->prepare("SELECT * FROM divers WHERE libelle NOT IN ('Autre');");
$query2->execute();
$result_divers=$query2->fetchall();


if(isset($_POST)){
    
    if(isset($_POST['situation']) && !empty($_POST['situation'])
    && isset($_POST['formation']) && !empty($_POST['formation'])
    && isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['prénom']) && !empty($_POST['prénom'])
    && isset($_POST['date_naissance']) && !empty($_POST['date_naissance'])
    && isset($_POST['nationalité']) && !empty($_POST['nationalité'])
    && isset($_POST['adresse']) && !empty($_POST['adresse'])
    && isset($_POST['cp']) && !empty($_POST['cp'])
    && isset($_POST['ville']) && !empty($_POST['ville'])    
    && isset($_POST['tel']) && !empty($_POST['tel'])
    && isset($_POST['email']) && !empty($_POST['email'])
    && isset($_POST['divers']) && !empty($_POST['divers'])    
    && isset($_POST['op']) && !empty($_POST['op'])){

        $situation=securite($_POST['situation']);
        $situation_autre=securite($_POST['situation.autre']);
        $formation=securite($_POST['formation']);
         $nom=securite($_POST['nom']);
        $nomjf=securite($_POST['nomjf']);
        $prenom=securite($_POST['prénom']);
        $date_naissance=securite($_POST['date_naissance']);
        $nationalite=securite($_POST['nationalité']);
        $adresse=securite($_POST['adresse']);
        $cp=securite($_POST['cp']);
        $ville=securite($_POST['ville']);
        $tel=securite($_POST['tel']);
        $email=securite($_POST['email']);
        $divers=securite($_POST['divers']);
        $op=securite($_POST['op']);

        $query3 = "UPDATE candidat SET id_situation =$situation , id_formation = $formation , nom_dusage = '$nom', nom_jeunefille ='$nomjf' , prenom = '$prenom', date_naissance ='$date_naissance' ,nationalite = '$nationalite', adresse ='$adresse', cp ='$cp' , ville = '$ville' , tel = '$tel', email ='$email', organisme_connu = $op ";
        $tester3 = $db->prepare($query3);
        $tester3->execute();


        $query4="UPDATE effectuer SET id_c = $id_candidat ,id_d =$divers";
        $tester4 = $db->prepare($query4);
        $tester4->execute();

        header('location: wait_candidat2.php');

        
    }else{
        $error= "erreur 1";
    }

}else{
    $error= "erreur 2";
}


?>
<script>
function myFunction() {
  document.getElementById("myBtn").disabled = true;
}
function myFunction1() {
  document.getElementById("myBtn").disabled = false;
}
</script>


<?php
$title="Formulaire d'inscription";
require_once('../header.php');
require_once("nav.php");
?>

<?= var_dump($tester3);
    var_dump($tester4);?>
    <form action="wait_candidat.php" method="post">
        <fieldset>
            <div class="champ">
            <?php if(isset($error)){echo "<span style='color: red'>".$error."</span>";}
            else{echo "<br>";}?>
                <h2>Situation professionnel</h2>
                <?php
                    foreach($result_sp as $situation){?>                        
                                                
                        <input type="radio" id= "<?= $situation['idsituation_pro']?>" name="situation" value="<?= $situation['idsituation_pro']?>"  id="myBtn" onclick="myFunction()" required>
                        <label for="situation"><?= $situation['libelle']?></label>
                            
                        <?php
                            }?>
                        <input type="radio" id= "5" name="situation" value="5" onclick="myFunction1()"  required>
                        <label for="situation">autre</label>
                        <input type="text" name="situation" value="" id="myBtn" >
               

            </div>
            <div class="champ">
                <h2>Formation visée</h2>
                <?php
                    foreach($result_for as $formation){?>
                    <input type="radio" id="<?= $formation['idformation'].'formation'?>"name="formation" value="<?= $formation['idformation']?>" required>
                    <label for="formation"><?= $formation['libelle']?></label>
                        
                    <?php
                        }
                    ?>
                
                
            </div>
        
        
            <div class="champ">
                <h2>Identité</h2>
                <label for="nomjf">Nom de jeune fille: </label>
                <input type="text" id="nomjf" name="nomjf" >
                <label for="nom">Nom d'usage: </label>
                <input type="text" id="nom" name="nom" required>
                <label for="prénom">Prénom: </label>
                <input type="text" id="prénom" name="prénom" required>
            </div>
            <br>
            <div class="champ">

                <label for="date_naissance">Né (e): </label>
                <input type="date" id="date" name="date_naissance" required>
                <label for="nationalité">Nationalité: </label>
                <input type="text" id="nationalité" name="nationalité" required>
            </div>
            <br>
            <div class="champ">
                <label for="id">Adresse: </label>
                <input type="text" id="adresse" name="adresse" required>
                <label for="id">Code postal: </label>
                <input type="text" id="cp" name="cp" required>
                <label for="id">Ville: </label>
                <input type="text" id="ville" name="ville" required>
            </div>
            <br>
            <div class="champ">
                <label for="id">Téléphone: </label>
                <input type="text" id="tel" name="tel" required>
                <label for="id">email: </label>
                <input type="text" id="email" name="email" required>

            </div>
            <div>
                <h2>Divers</h2>  
                <p>Avez-vous suivi préalablement des prestations de formations visant à:</p>
                <?php
                    foreach($result_divers as $divers){
                        if ($divers['libelle'] == "Autre"){?>
                        <input type="radio" id="<?= $divers['iddivers'].'sp'?>"name="" value="divers<?= $divers['iddivers']?>" required>
                        <label for="divers"><?= $divers['libelle']?></label>
                        <input type="text" id="<?= $divers['iddivers'].'sp'?>"name="divers" value="<?php $divers['iddivers']?>" >
                        <?php
                        }else{
                        ?>
                    <input type="radio" id="<?= $divers['iddivers']?>"name="divers" value="<?= $divers['iddivers']?>" required>
                    <label for="divers"><?= $divers['libelle']?></label>
                        </div>
                    <?php
                        }?>
                <?php
                    
                    }
                ?>
                <br>
                <p>Comment avez-vous connu notre organisme ?</p>
                <input type="text" id="<?= $divers['iddivers']?>"name="op" value="<?php $divers['iddivers']?>" required>


            </div>        
        </fieldset>

 

        <fieldset>
            <legend>Etape suivante :</legend>
            <input type="submit" value="Suivant">
        </fieldset>
    </form>
<?php
// require_once("../footer.php");
 ?>
