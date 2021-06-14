<?php
$title = "candidat";
require_once("header.php");
require("nav_admin.php");
require("redirection_admin.php");
require('sql/sql_candi_valid.php');
(!empty($_GET['idforma']) && isset($_GET['idforma']))? $forma= "&idforma=".$_GET['idforma']:$forma="";
?>

<main>
    <h2>LISTES DES CANDIDATS </h2>
    <SELECT onChange="document.location=this.options[this.selectedIndex].value">
        <OPTION VALUE="#" SELECTED>     CHOISIR     </OPTION>
        <OPTION VALUE="candi_valid.php">Tous</OPTION>
        <OPTION VALUE="candi_valid.php?idforma=1">BTS Assurance</OPTION>
        <OPTION VALUE="candi_valid.php?idforma=2">BTS Banque</OPTION>
        <OPTION VALUE="candi_valid.php?idforma=3">BTS Compta/Gestion</OPTION>
        <OPTION VALUE="candi_valid.php?idforma=4">BTS Gestion PME</OPTION>
        <OPTION VALUE="candi_valid.php?idforma=5">BTS MUC</OPTION>
        <OPTION VALUE="candi_valid.php?idforma=6">BTS SIO/SLAM</OPTION>
        <OPTION VALUE="candi_valid.php?idforma=7">BTS SIO/SISR</OPTION>
    </SELECT>
    <table class="table">
        <thead>
            <th>Nom</th>
            <th>Prénom</th>
            <th>E-mail</th>
            <th>Formation</th>
            <th>Date de la demande</th>
            <th>Date d'entretien</th>
            <th>Session</th>
            <th>Durée</th>
            <th> dossier initié </th>
            <th>dossier transmis</th>
            <th>Financeur</th>
            <th>Etat dossier</th>
            <th>conclusion</th>
        </thead> 
        <tbody>   
            <?php
                foreach($candidat as $gefor){
            ?>
            <tr>
                    <td> <?=$gefor['nom_dusage'] ?></td>
                    <td> <?=$gefor['prenom'] ?></td>
                    <td> <?=$gefor['email'] ?></td>
                    <td> <?=$gefor['libelle'] ?></td>
                    <td><?=$gefor['date_ajout'] ?></td>
                    <td><?=$gefor['entretien'] ?></td>
                    <td><?=$gefor['session'] ?></td>
                    <td><?=$gefor['duree'] ?></td>
                    <td><?=$gefor['initie'] ?></td>
                    <td><?=$gefor['transmis'] ?></td>
                    <td><?=$gefor['financeur'] ?></td>
                    <td><?=$gefor['statut'] ?></td>
                    <td><?=$gefor['conclu'] ?></td>
                    <td>
                        <a href="dossier.php?idcandidat=<?= $gefor['idcandidat'] ?>"><button> Dossier</button></a>
                        <a href ="modifier_candidat_admin.php?idcandidat=<?=$gefor['idcandidat']?>"><button>Modifier</button></a> 
                        <a href ="document.php?idcandidat=<?=$gefor['idcandidat']?>"><button>Document</button> </a> 
                    </td> 
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <nav>
        <ul class="pagination"><br>
            <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                <a href="candi_valid.php?page=<?= $currentPage - 1?><?=$forma?>">Précédente</a>  
            </li>
            <?php
                for($page = 1; $page <= $pages; $page++){
            ?>
            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                <a href="candi_valid.php?page=<?= $page?><?=$forma?>"><?= $page ?></a>  
                    </li>
            <?php 
                    } 
            ?>
            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                <a href="candi_valid.php?page=<?= $currentPage + 1?><?=$forma?>">Suivante</a>  
            </li>
        </ul>
    </nav>		
</main>

		

















  
