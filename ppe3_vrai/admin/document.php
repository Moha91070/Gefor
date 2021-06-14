<?php
$title = "index.php";
require_once("header.php");
require("nav_admin.php");
require_once('../bdd/connect.php');
//require("redirection_admin.php");
//require('sql_doc.php');


function securite($data){
    $data=strip_tags($data);
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;
}

if(isset($_GET['idcandidat']) && !empty($_GET['idcandidat'])){
    $id= securite($_GET['idcandidat']);

    $base_joint = $db->prepare("SELECT url_document,idcandidat,date_naissance,prenom,nom_dusage,email, document.libellé as nom,url_document
                            FROM document
                            INNER JOIN `document_candidat`
                            ON document.id_document = document_candidat.id_document
                            INNER JOIN candidat
                            ON candidat.idcandidat = document_candidat.id_candidat
                            WHERE idcandidat = $id");
$base_joint->execute();
$document= $base_joint->fetchAll();
}
?>
<h2>DOCUMENTS </h2>
<a href=".php" class="btn btn-primary"> Retour</a>
    <table class="table">
        <thead>
            
            <th>nom_dusage</th>
            <th>prenom</th>
            <th>Nom du document</th>
            <th>Télécharger</th>
            
            
        </thead> 
    <tbody> 
    <?php  
    foreach($document as $doc){
        ?>
   <tr>
   <td> <?=$doc['nom_dusage'] ?></td>
   <td> <?=$doc['prenom'] ?></td>
   <td> <?=$doc['nom'] ?></td>
   <td><a href="../dossier_candidat/<?= $doc['url_document']?>">Visualiser </a>
   <a href="../dossier_candidat/<?= $doc['url_document']; ?>" download="<?= $doc['url_document']; ?>">télécharger</a></td>
       
</tr>
<?php
}
?>
</tbody>
</table>