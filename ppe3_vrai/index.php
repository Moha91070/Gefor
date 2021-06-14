<?php 
$title='Accueil';
require('header.php');
    
?>


    <article class = "index">
        <h2>GEFOR</h2>
        <h3>Avec l'application Gefor, visualisez vos dossiers d'admissions en temps réel. </h3>


            <form action="sql_session.php" method="post">
            <p class= "error"> <?= (!empty($_GET['error'])) ? $_GET['error'] : "" ; ?> </p>
            <p class= "valide" style="color:green"> <?= (!empty($_GET['valide'])) ? $_GET['valide'] : "" ; ?> </p>
            <?php
     if (isset($_SESSION['erreur'])){
         echo '<span style="color: green;">'.$_SESSION['erreur'].'</span>';
     }
     ?>
            <div class = "champ">
                <label for="email">Votre adresse mail :</label>
                <input type="email" name="email" id= "email" required/>
            </div>   
            <div class = "champ">
                <label for="pass">Mot de passe :</label>
                <input type="password" name="pass" id= "pass" required/>
            </div>
            <div class= "champ">
                <label for="connexion"><a href="recuperation_view.php">Mot de passe oublié</a></label>
                <input type="submit" name="connexion" value="connexion">   
            </div>
            </form>

        <h2><a href="inscription_accueil.php">créer un compte</a></h2> 
    </article>
<footer></footer>

