<?php
$title = "index.php";
require_once("header.php");
require("nav_admin.php");
require("redirection_admin.php");
require('sql/sql_reserve.php');
?>


                <h2>LISTES CANDIDATS RESERVE </h2>
            <SELECT onChange="document.location=this.options[this.selectedIndex].value">
                <OPTION VALUE="#" SELECTED>     CHOISIR     </OPTION>
                <OPTION VALUE="reserve.php">Tous</OPTION>
                <OPTION VALUE="reserve.php?idforma=1">BTS Assurance</OPTION>
                <OPTION VALUE="reserve.php?idforma=2">BTS Banque</OPTION>
                <OPTION VALUE="reserve.php?idforma=3">BTS Compta/Gestion</OPTION>
                <OPTION VALUE="reserve.php?idforma=4">BTS Gestion PME</OPTION>
                <OPTION VALUE="reserve.php?idforma=5">BTS MUC</OPTION>
                <OPTION VALUE="reserve.php?idforma=6">BTS SIO/SLAM</OPTION>
                <OPTION VALUE="reserve.php?idforma=7">BTS SIO/SISR</OPTION>
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
                            <a href="dossier.php?idcandidat=<?= $gefor['idcandidat'] ?>"><button> Dossier</button></a>
                            <a href ="document.php?idcandidat=<?=$gefor['idcandidat']?>"><button>Document</button> </a> 

                            </td> 
			        </tr>
				<?php
				}
				?>
				         </tbody>
			            </table>
        <nav>
            <ul class="pagination"><br>
                <li class="page-item <?= ($currentPage) ? "disabled" : "" ?>">
                    <a href="reserve.php?page=<?= $currentPage - 1?>" class="page-link">Précédente</a>  
                </li>
                <?php
                    for($page = 1; $page <= $pages; $page++){
                ?>
                <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                    <a href="reserve.php?page=<?= $page?>" class="page-link "><?= $page ?></a>  
                        </li>
                <?php 
                     } 
                ?>
                <li class="page-item <?= ($currentPage) ? "disabled" : "" ?>">
                    <a href="reserve.php?page=<?= $currentPage + 1?>" class="page-link">Suivante</a>  
                </li>
            </ul>
        </nav>		
    </main>
</body>
</html>
		