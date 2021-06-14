<?php


//Création de la session dans la page


// Condition au cas ou mauvais identifiant se connecte
require_once('verification.php');

if($_SESSION['cursus'] != 2 && $_SESSION['cursus'] != 3  ){
    header('location:redirection_candidat.php');
}
    


$title="Accueil candidat";
// inclusion du header dans la page 
require_once("../header.php");
require_once("header_candidat.php");

?>




    <?php
     if (isset($_SESSION['erreur'])){
         echo '<span style="color: green;">'.$_SESSION['erreur'].'</span>';
     }
     ?>
        <h2 style="text-align: center;">Page Candidat</h2>
    <article>
        <p style="text-align: center;"> Animé par des valeurs humaines, une volonté de conseiller et d'accompagner ses candidats dans la réussite de leur projet professionnel,
             le Groupe GEFOR adapte ses formations aux besoins de l'entreprise et de ses salariés.<br> Que vous souhaitiez vous reconvertir, évoluer,
              obtenir un diplôme d'état dans le domaine tertiaire   
        </p>
    </article>    
</body>
</html>
<?php
// inclusion du footer dans la page 
require_once("../footer.php");

?>
