<?php
    //condition de session:
    require("redirection_admin.php"); 
    require("header.php");
    require("nav_admin.php");
?>

 <h2>Formulaire d'inscription:</h2>  
   
    
<section >  
   <form action="post/inscription_admin.php" method="POST">
        <h4>Groupe d'utilisateur:</h4>
        <div >
            <input class = "champ" type="radio" id="admin" name="groupe" value="1" require>
            <label for="groupe">Admin</label>

            <input class= "champ" type="radio" id="dev" name="groupe" value="2" require >
            <label for="groupe">Développeur</label>
        </div>

        <p class= "error"> <?= (!empty($_GET['error'])) ? $_GET['error'] : "" ; ?> </p>
        <div class = "champ">
            <label for="nom">Nom :</label>
            <input type="nom" name="nom" id="nom" required/>
        </div>

        <div class = "champ">
            <label for="prenom">Prénom :</label>
            <input type="prenom" name="prenom" id="prenom" required/>
        </div>

        <div class = "champ">
            <label for="mail">Mail :</label>
            <input type="email" name="mail" id="mail" required/>
        </div>

        <div class = "champ">
            <label for="pass">Saisir mot de passe :</label>
            <input type="password" name="pass1" id="pass1" required/>
        </div>
        
        <div class = "champ">
            <label for="pass2">Re-saisir  mot de passe :</label>
            <input type="password" name="pass2" id="pass2" required/>
        </div>
            <div class = "champ">
            <input type="submit" name="Inscription" value="Inscription">
        </div>
    </form>

    <a href="tab_employe.php">Retour</a><br><br>      
</section>




