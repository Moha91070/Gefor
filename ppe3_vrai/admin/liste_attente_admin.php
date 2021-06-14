<?php
$title = "liste d'attente";
require_once("header.php");
require("nav_admin.php");
require("redirection_admin.php");
require('sql/sql_liste_attent.php');
(!empty($_GET['idforma']) && isset($_GET['idforma']))? $forma= "&idforma=".$_GET['idforma']:$forma="";

?>

        <main>
            <h2>LISTE D'ATTENTE POUR UN ENTRETIEN </h2>
            <SELECT onChange="document.location=this.options[this.selectedIndex].value">
                <OPTION VALUE="#" SELECTED>     TRIER PAR     </OPTION>
                <OPTION VALUE="liste_attente_admin.php">Tous</OPTION>
                <OPTION VALUE="liste_attente_admin.php?idforma=1">BTS Assurance</OPTION>
                <OPTION VALUE="liste_attente_admin.php?idforma=2">BTS Banque</OPTION>
                <OPTION VALUE="liste_attente_admin.php?idforma=3">BTS Compta/Gestion</OPTION>
                <OPTION VALUE="liste_attente_admin.php?idforma=4">BTS Gestion PME</OPTION>
                <OPTION VALUE="liste_attente_admin.php?idforma=5">BTS MUC</OPTION>
                <OPTION VALUE="liste_attente_admin.php?idforma=6">BTS SIO/SLAM</OPTION>
                <OPTION VALUE="liste_attente_admin.php?idforma=7">BTS SIO/SISR</OPTION>
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
                            <a href="selection.php?idcandidat=<?= $gefor['idcandidat'] ?>"><button type="button" class="btn btn-info"> Bilan</button></a>
                        </td> 
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
            <nav>
                <ul class="pagination"><br>
                    <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                        <a href="liste_attente_admin.php?page=<?= $currentPage - 1?><?=$forma?>" class="page-link">Précédente</a>  
                    </li>
                    <?php
                        for($page = 1; $page <= $pages; $page++){
                    ?>
                        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                        <a href="liste_attente_admin.php?page=<?= $page?><?=$forma?>" class="page-link "><?= $page ?></a>  
                        </li>
                    <?php 
                        } 
                    ?>
                    <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                        <a href="liste_attente_admin.php?page=<?= $currentPage + 1?><?=$forma?>" class="page-link">Suivante</a>  
                    </li>
                </ul>
            </nav>		
        </main>
    </body>
</html>
