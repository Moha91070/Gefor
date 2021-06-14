<?php
session_start();

// Forcer de se reconnecter a chaque fois qu'on entre sur la page
if(empty($_SESSION)) {
    header ('location:connexion.php');
}

require_once('connect.php');

// on vérifie que les données du formulaire sont présentes

if(isset($_POST)){
    if(isset($_POST['pseudo']) && !empty($_POST['pseudo'])
    && isset($_POST['pass']) && !empty($_POST['pass'])
    && isset($_POST['pass2']) && !empty($_POST['pass2'])
    && isset($_POST['email']) && !empty($_POST['email'])
    && isset($_POST['date']) && !empty($_POST['date'])){
	
	

    //On récupère les données du formulaire en les incorporant dans la requete
     $pseudo = $_POST['pseudo'];  
     $pass = hash("sha256",$_POST['pass']);
    //On hache le mot de passe retaper par le nouvel utilisateur
     $pass2 = hash("sha256",$_POST['pass2']);
     $email= $_POST['email']; 
     $date= $_POST['date'];

        // cette requête permet de preparer et de selectionnez  les utilisateurs depuis la B
        $requete ="SELECT count(*) `pseudo`, `pass`, `email`, `date_inscription`, `id_groupe` 
        FROM `membres` 
        WHERE `pseudo` = '$pseudo'";

        // On prépare la requête
        $resultat = $db->prepare($requete);

        // On execute la requête
        $resultat->execute(array($pseudo, $pass));

        // On recupere les résultats de la requete
        $test=$resultat->fetch();

       
                    
        //Condition pour limiter l'inscription pour securiser mot de passe identique et identifiant différent d'un autre
        if (($test[0] == 0) && ($pass == $pass2)) {     
            // cette requête permet de preparer et d'inserer l'utilisateur depuis la BD
            $query = $db->prepare("INSERT INTO `membres`(`pseudo`, `pass`, `email`, `date_inscription`,`id_groupe`)
                        VALUES ('$pseudo', '$pass', '$email', '$date',4)");
            // On execute la requête
            $query->execute();

            //Creation d'une nouvelle session
            $_SESSION['message'] = "Nouveau membre";
            $_SESSION['email'] = $email;
            
            //fermeture de la connexion
            require_once('close.php');
            // Me creer l'utilisateur et me redirige sur cette page
            header('Location: envoie_mail.php');
            exit();

    }
    else{
            // M'affiche une erreur car le pseudo est identique a un autre membre
            echo "Un membre possede le meme pseudo ou a pas le meme mot de passe";
        }

        // Si les données ne sont pas présentes
    }else{
         $_SESSION['erreur'] = "Le formulaire est imcomplet";
    }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Page principale d'inscription'</title>
</head>
<header>
    <h1><center><img src="Modèle-de-fiche-dintervention.png"
     class="custom-logo" alt="Accueil Intervention" 
     srcset="Modèle-de-fiche-dintervention.png 600w, Modèle-de-fiche-dintervention.png 300w, Modèle-de-fiche-dintervention.png 768w" 
     sizes="(max-width: 1000px) 100vw, 900px" width="1000" height="88"></center></h1>
</header>

<nav><center>
        <div class= "table">
            <ul>
                <li class="menu-ind">
                    <a href="accueil.php">ACCUEIL</a>
                </li>
               <li class="menu-ind">
                    <a href="connexion.php">SE CONNECTER</a>
                </li>
                <li class="menu-ind">
                <a href="inscription_accueil.php">s'inscrire</a>
                </li>
                <li class="menu-ind">
                <a href="contact.php">Contact</a>
                </li>
                </ul></center></nav>
                <center><h2>Formulaire d'inscription:</h2></center><br><br>

<body>
    
    <article class = "carac"> 
   
   <center><h2>Inscrivez-vous chez nous</h2></center> 
    <ul>
      <img src="connexion.jpg" alt="" />
    </ul>    
    </article>
    <body>
    <a href="accueil.php">Retour</a><br><br>
    <form action="inscription_accueil.php" method="post">
    <div> 
        </form>
        <label for="pseudo">Pseudo :</label>
        <input type="text" name="pseudo" id="pseudo" required/> <br><br>

        <label for="pass">Mot de passe :</label>
        <input type="password" name="pass" id="pass" required/><br><br>

        <label for="pass2">Retaper le mot de passe :</label>
        <input type="password" name="pass2" id="pass2" required/><br><br>

        <label for="email">E-mail :</label>
        <input type="email" name="email" id="email" required/><br><br>

        <label for="date">Date d'inscription :</label>
        <input type="date" name="date" id="date" required/><br><br>

        <input type="submit" name="Inscription" value="Inscription"><br><br>
        </form>

    <article>
    <ul>
    <img src="image.jpg" alt="" />
    </ul>    
    </article>


    <footer>
    <P> Copyright Infodev</P>
    </footer>
    <body>
    
</body>
</html>