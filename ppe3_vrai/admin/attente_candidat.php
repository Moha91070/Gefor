<?php
$title = "liste des demandes";
require_once("header.php");
require("nav_admin.php");
require("redirection_admin.php");
require('sql/sql_attente.php');
(!empty($_GET['idforma']) && isset($_GET['idforma']))? $forma= "&idforma=".$_GET['idforma']:$forma="";
?>

<main>
    <span style= 'color:green'><?=(isset($_GET['choix']) && !empty($_GET['choix'])) ? $_GET['choix'] : ""?></span>
            <h2>LISTE DES DEMANDES</h2>
        <SELECT onChange="document.location=this.options[this.selectedIndex].value">
            <OPTION VALUE="#" SELECTED> Trier par </OPTION>
            <OPTION VALUE="attente_candidat.php">Tous</OPTION>
            <OPTION VALUE="attente_candidat.php?idforma=1">BTS Assurance</OPTION>
            <OPTION VALUE="attente_candidat.php?idforma=2">BTS Banque</OPTION>
            <OPTION VALUE="attente_candidat.php?idforma=3">BTS Compta/Gestion</OPTION>
            <OPTION VALUE="attente_candidat.php?idforma=4">BTS Gestion PME</OPTION>
            <OPTION VALUE="attente_candidat.php?idforma=5">BTS MUC</OPTION>
            <OPTION VALUE="attente_candidat.php?idforma=6">BTS SIO/SLAM</OPTION>
            <OPTION VALUE="attente_candidat.php?idforma=7">BTS SIO/SISR</OPTION>
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
                        <a style="color:green" href="sql/sql_pre_selc.php?choix=7&id=<?=$gefor['idcandidat']?>" onclick="return confirm('Confirmation acceptation <?=$gefor['nom_dusage'] ?> <?=$gefor['prenom'] ?>')">Accepter</a> 
                        <a style="color:red" href="sql/sql_pre_selc.php?choix=6&id=<?=$gefor['idcandidat']?>" onclick="return confirm('Confirmation acceptation <?=$gefor['nom_dusage'] ?> <?=$gefor['prenom'] ?>')">Refuser</a> 
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
                <a href="attente_candidat.php?page=<?= $currentPage - 1?><?=$forma?>" >Précédente</a>  
            </li>
            <?php
                for($page = 1; $page <= $pages; $page++){
            ?>
            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                <a href="attente_candidat.php?page=<?= $page?><?=$forma?>" ><?= $page ?></a>  
                    </li>
            <?php 
                    } 
            ?>
            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                <a href="attente_candidat.php?page=<?=$currentPage+ 1?><?=$forma?>" >Suivante</a>  
            </li>
        </ul>
    </nav>		
</main>

    