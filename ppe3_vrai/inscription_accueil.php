<?php
$title= "inscription";
require('header.php');
?>


   <article class = "index">
                <h2>Formulaire d'inscription:</h2>
  
    <form  action="sql_login.php" method="post">
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

    <a href="index.php">Retour</a><br><br>
    </article>
    <footer>
        <P>Copyright by Mohamed Akhmouch Sofiane Bellifa Christopher Mamie</P>
    </footer>
    
    </body>
</html>