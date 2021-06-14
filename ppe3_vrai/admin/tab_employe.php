<?php
// inclusion du header dans la page 
require("header.php");
// inclusion du footer dans la page 
require("nav_admin.php");
require("redirection_admin.php");
require("sql/sql_tab_employe.php");
?>




<h2>GESTIONNAIRE DES UTILISATEURS </h2>
<a href="ajout_employe.php">AJOUTER</a>

<table class="table">
    <thead>
        <th>Nom </th>
        <th>Prénom </th>
        <th>E-mail </th>
        <th>Groupe utilisateur</th>
    </thead>    
    <tbody>
        <?php foreach($employe as $gefor) { ?>
            <tr>
                <td> <?=$gefor['nom_employe'] ?></td>
                <td> <?=$gefor['prenom_employe'] ?></td>
                <td> <?=$gefor['email_employe'] ?></td>
                <td> <?=($gefor['id_groupe'] == 1) ? "Administrateur": " Utilisateur"; ?></td>
                <td>
                <a href="sql/del_employe.php?id_employe=<?= $gefor['id_employe']?>" onclick="return confirm('Êtes vous sur de vouloir supprimer <?=$gefor['nom_employe'] ?> <?=$gefor['prenom_employe'] ?>')">supprimer</a> 

                </td> 
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<nav>
    <ul class="pagination">
        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
            <a href="tab_employe.php?page=<?= $currentPage - 1?>" >Précédente</a>  
        </li>
            <?php
                for($page = 1; $page <= $pages; $page++){
            ?>
        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
            <a href="tab_employe.php?page=<?= $page?>"><?= $page ?></a>  
        </li>
            <?php } ?>
        <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
            <a href="tab_employe.php?page=<?= $currentPage + 1?>" >Suivante</a>  
        </li>
    </ul>
</nav>



	