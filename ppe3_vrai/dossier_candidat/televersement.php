<?php




// Condition au cas ou mauvais identifiant se connecte
require_once('verification.php');
if($_SESSION['cursus'] != 2 && $_SESSION['cursus'] != 3  ){
    header('location:redirection_candidat.php');
}

    // On inclut la connexion a la base
require_once("../bdd/connect.php");
if($_SESSION['groupe']== 3){
    $query_type_doc="SELECT * FROM document;";
    $type_doc=$db->prepare($query_type_doc);
    $type_doc->execute();
    $liste_doc=$type_doc->fetchall();
}elseif($_SESSION['groupe']== 4){
    $query_type_doc="SELECT * FROM document WHERE libellé IN ('CV','lettre de motivation');";
    $type_doc=$db->prepare($query_type_doc);
    $type_doc->execute();
    $liste_doc=$type_doc->fetchall();
}
$id=$_SESSION['idcandidat'];
$query="SELECT nom_dusage,prenom FROM candidat WHERE idcandidat=$id;";
$candidat=$db->prepare($query);
$candidat->execute();
$liste=$candidat->fetch();



    if(!empty($_FILES)){

        foreach($_FILES as $colonne=>$valeur){
            if($_FILES[$colonne]!=1 && $_FILES[$colonne]['tmp_name']!= ''){
                $id=$_SESSION['idcandidat'];
                $doc=$colonne;
                $file_name=$_FILES[$colonne]['name'];
                $file_extension= strrchr($file_name,".");
                $file_tmp_name=$_FILES[$colonne]['tmp_name'];
                $file_dest='motivation/'.$file_name;   
    

        $extension_autorisees=array('.pdf','.PDF','.docx','.doc','.xlsx','.pptx','.png','.PNG','.JPEG','.jpeg','.jpg','.TIFF','.tiff');

                if(in_array($file_extension,$extension_autorisees)){

                    if(move_uploaded_file($file_tmp_name, $file_dest)){
                                    


                                $query_certificat=$db->prepare('INSERT INTO document_candidat(id_candidat,id_document, url_document, date_ajout) VALUES(?,?,?,current_timestamp)');
                                $query_certificat->execute(array($id, $doc, $file_dest));
                                $_SESSION['message']=' Document téleversé avec succès.';
                            
                            
                        
                    }else{
                        echo ' Une erreur est survenue lors du televersement du certificat.';
                    }

                }else{
                    echo 'Certaines extensions ne sont pas autorisées.';
                }
            }
        }
    } 



$title="Téleversement";
// inclusion du header dans la page 
require_once("../header.php");
require_once("header_candidat.php");
?>

        <h2>Liste des candidats</h2>
            <p><a href="accueil_candidat.php">Retour page candidat</a></p>
        <main class="container">
            <div class="row">
                <section class="col-12">
                    <?php
                        if (!empty($_SESSION['erreur'])){
                            echo '<div class="alert alert-danger" role="alert">
                             '. $_SESSION['erreur'].'
                                  </div>';
                             $_SESSION['erreur']='';
                         }
                    ?>
                     <?php
                         if (!empty($_SESSION['message'])){
                             echo '<div class="alert alert-success" role="alert">
                             '. $_SESSION['message'].'
                                    </div>';
                                $_SESSION['message']='';
                        }
                    ?>
<div class="champ">
    <h3><?= $liste['nom_dusage'].' '.$liste['prenom'];?></h3>
    <label>Numéro de dossier: <?= $_SESSION['idcandidat']; ?> </label><br><br><br> 
    <p> Depuis votre espace, vous pouvez nous envoyer les pièces nécessaires au traitement de votre dossier.</p>
</div>
<div class="champ">
    <h3>Liste des documents à téléverser </h3>
    <form method="POST"  enctype="multipart/form-data">
                <table class="table" >
                    <thead>
                        <th>Documents</th>
                        <th>Action</th>                       
                    </thead>
                    <tbody>
                        <?php
                        // on boucle sur la variable result
                            foreach($liste_doc as $doc){
                                
                        ?>
                            <tr>
                                <td><?= $doc['libellé']?></td>
                                <td><input required type="file" name="<?= $doc['id_document']?>"></td>                                                               
                                                          
                            </tr>

                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                <br>
                <input type="submit" name="chargement" value="Valider">
    </form>
</div>
<?php  
// inclusion du footer dans la page 
//require_once("../footer.php");

?>