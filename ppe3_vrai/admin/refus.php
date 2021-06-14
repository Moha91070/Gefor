<?php
$title = "index.php";
require_once("header.php");
require("nav_admin.php");
require("redirection_admin.php");
require('sql/sql_refus.php');
(!empty($_GET['idforma']) && isset($_GET['idforma']))? $forma= "&idforma=".securite($_GET['idforma']):$forma="";

?>
<main>
    <h2>LISTES DES CANDIDATS REFUSE</h2>
    <SELECT onChange="document.location=this.options[this.selectedIndex].value">
        <OPTION VALUE="#" SELECTED>     CHOISIR     </OPTION>
        <OPTION VALUE="refus.php">Tous</OPTION>
        <OPTION VALUE="refus.php?idforma=1">BTS Assurance</OPTION>
        <OPTION VALUE="refus.php?idforma=2">BTS Banque</OPTION>
        <OPTION VALUE="refus.php?idforma=3">BTS Compta/Gestion</OPTION>
        <OPTION VALUE="refus.php?idforma=4">BTS Gestion PME</OPTION>
        <OPTION VALUE="refus.php?idforma=5">BTS MUC</OPTION>
        <OPTION VALUE="refus.php?idforma=6">BTS SIO/SLAM</OPTION>
        <OPTION VALUE="refus.php?idforma=7">BTS SIO/SISR</OPTION>
    </SELECT>
    <table class="table">
        <thead>
            <th>Nom du candidat</th>
            <th>Prénom du candidat</th>
            <th>E-mail du candidat</th>
            <th>Date de naissance</th>
            <th>Ville</th>
            <th>Formation</th>
            <th>Date de la demande</th>
        </thead> 
        <tbody>   
            <?php
                foreach($candidat as $gefor){
            ?>
                <tr>
                    <td> <?=$gefor['nom_dusage'] ?></td>
                    <td> <?=$gefor['prenom'] ?></td>
                    <td> <?=$gefor['email'] ?></td>
                    <td> <?=$gefor['date_naissance'] ?></td>
                    <td> <?=$gefor['ville'] ?></td>
                    <td> <?=$gefor['libelle'] ?></td>
                    <td><?=$gefor['date_ajout'] ?></td>
                    <td>
                    <a href="detail_admin.php?idcandidat=<?= $gefor['idcandidat'] ?>"><button type="button" class="btn btn-info" value="enable"> Info</button></a>
                    <a href="sql/del_candidat.php?idcandidat=<?= $gefor['idcandidat']?>" onclick="return confirm('Êtes vous sur de supprimer <?=$gefor['nom_dusage'] ?> <?=$gefor['prenom'] ?>')">supprimer</a> 
                    </td> 
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <nav>
        <ul class="pagination"><br>
            <li class="page-item <?= ($currentPage ==1) ? "disabled" : "" ?>">
                <a href="refus.php?page=<?= $currentPage - 1?><?=$forma?>">Précédente</a>  
            </li>
            <?php
                for($page = 1; $page <= $pages; $page++){
            ?>
                    <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                        <a href="refus.php?page=<?= $page?><?=$forma?>"><?= $page ?></a>  
                    </li>
            <?php 
            } 
            ?>
            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                <a href="refus.php?page=<?= $currentPage + 1?><?=$forma?>">Suivante</a>  
            </li>
        </ul>
    </nav>		
</main>

                