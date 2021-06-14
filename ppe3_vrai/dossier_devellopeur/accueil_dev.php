<?php
// inclusion du header dans la page 
require_once("../header.php");
require_once("nav.php");
require_once("redirection_dev.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style.css">
        <title>Page d'accueil Developpeur</title>
</head>
<body>
<body>
    <h2>Page d'accueil Developpeur de <?= $prenom?></h2>
        <article>
                <p> 
                    Animé par des valeurs humaines, une volonté de conseiller et d'accompagner ses candidats dans la réussite
                     de leur projet professionnel, le Groupe GEFOR adapte ses formations aux besoins de l'entreprise et de ses salariés.
                    Que vous souhaitiez vous reconvertir, évoluer, obtenir un diplôme d'état dans le domaine tertiaire   
                </p>
        </article>

        <article>
                <ul>
                    <img src="image.jpg" alt="" />
                </ul>    
        </article>    
</body>
<?php require_once("../footer.php");?> 
</html>
















