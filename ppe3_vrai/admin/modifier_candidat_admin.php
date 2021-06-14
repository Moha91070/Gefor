<?php
// inclusion du header dans la page 
require_once("header.php");
// inclusion du footer dans la page 
//require_once("../footer.php");
require("nav_admin.php");
//condition de session:
require("redirection_admin.php");
 // Fonction faille de sécurité
 require_once('../bdd/connect.php');
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
$query1=$db->prepare("SELECT * FROM formation;");
$query1->execute();
$result_for=$query1->fetchall();

$query3=$db->prepare("SELECT * FROM candidat WHERE idcandidat=$id");
$query3->execute();
$result_candidat=$query3->fetch();

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

        

        $query=$db->prepare("UPDATE candidat SET nom_dusage=?,nom_jeunefille=?,prenom=?,date_naissance=?,adresse=?,
                            cp=?,ville=?,tel=?, nationalite=?,id_formation=?,email=?
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
        $query->bindValue(12, $id, PDO::PARAM_INT);
        $query->execute();
        $_SESSION['erreur']="Vos modifications ont bien été faite";
          
            $_POST=null;
            header('location: candi_valid.php'); 

        }elseif(isset($_POST) && !empty($_POST)){
            $error= "Certaines données sont manquantes";            
            foreach($_POST as $champs => $valeur){
                if($champs!="divers"){
                    $_SESSION['erreur'][$champs]=securite($valeur);
                }
            }
    }
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
?>
<p><a href="candi_valid.php">Retour a la page candidat</a></p>



    <form method="post">
        <fieldset>
        <?php
     if (isset($_SESSION['erreur'])){
         echo '<span style="color: green;">'.$_SESSION['erreur'].'</span>';
     }
     ?>
            <div class="champ">
            <?php if(isset($error)){echo "<span style='color: red'>".$error."</span>";}
            else{echo "<br>";}?>
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
                <input type="text" id="nomjf" name="nomjf" value="<?= $result_candidat['nom_jeunefille']?>">
                <label for="nom">Nom d'usage: </label>
                <input type="text" id="nom" name="nom" value="<?= $result_candidat['nom_dusage']?>" required>
                <label for="prénom">Prénom: </label>
                <input type="text" id="prenom" name="prenom" value="<?= $result_candidat['prenom']?>"required>
            </div>
            <br>
            <div class="champ">

                <label for="date_naissance">Né (e): </label>
                <input type="date" id="date" name="date_naissance" value="<?= $result_candidat['date_naissance']?>"required>
                <label for="nationalité">Nationalité: </label>
                <input type="text" id="nationalite" name="nationalite" value="<?= $result_candidat['nationalite']?>"required>
            </div>
            <br>
            <div class="champ">
                <label for="id">Adresse: </label>
                <input type="text" id="adresse" name="adresse" value="<?= $result_candidat['adresse']?>"required>
                <label for="id">Code postal: </label>
                <input type="text" id="cp" name="cp" value="<?= $result_candidat['cp']?>"required>
                <label for="id">Ville: </label>
                <input type="text" id="ville" name="ville" value="<?= $result_candidat['ville']?>"required>
            </div>
            <br>
            <div class="champ">
                <label for="id">Téléphone: </label>
                <input type="text" id="tel" name="tel" value="<?= $result_candidat['ville']?>"required>
                <label for="id">email: </label>
                <input type="text" id="email" name="email" value="<?= $result_candidat['email']?>"required>
            </div>
        <fieldset>
            <legend>Veuillez validé:</legend>
            
            <input type="submit" value="Validation">
        </fieldset>
    </form>
<?php
// require_once("../footer.php");
 ?>
