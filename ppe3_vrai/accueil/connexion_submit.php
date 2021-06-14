<?php
session_start();


// on vérifie que les données du formulaire sont présentes
if(isset($_POST['email']) && !empty($_POST['email'])
&& isset($_POST['pass']) && !empty($_POST['pass'])){
    

    //On branche a la base de données
    require_once('C:\wamp64\www\ppe3_vrai\bdd\connect.php');
    
    //On récupère les données du formulaire en les incorporant dans une variable
    $email=$_POST['email'];
    $pass=$_POST['pass'];

    // cette requête permet de récupérer l'utilisateur depuis la BD la table employe
    $requete ="SELECT `id_employe`, `prenom_employe`, `email_employe`, `mot_passe_employe`,`id_groupe` FROM `employe` WHERE `email_employe` = '$email'";

    // On prépare la requête
    $resultat = $db->prepare($requete);

    // On execute la requête
    $resultat->execute(array($email, $pass));

    // On recupere les résultats de la requete
    $query=$resultat->fetch();
    $groupe = $query['id_groupe'];
    $id_employe = $query['id_employe'];
    $pass_hash = $query['mot_passe_employe'];
    $prenom = $query['prenom_employe'];

     // cette requête permet de récupérer l'utilisateur depuis la BD la table candidat
    $requete1 ="SELECT `idcandidat`, `prenom`, `email`, `mot_de_passe`,`id_groupe` FROM `candidat` WHERE `email` = '$email'";
    // On prépare la requête
    $resultat1 = $db->prepare($requete1);
    // On execute la requête
    $resultat1->execute(array($email, $pass));
    // On recupere les résultats de la requete
    $query1=$resultat1->fetch();
    $groupe1 = $query1['id_groupe'];
    $idcandidat = $query1['idcandidat'];
    $pass_hash1 = $query1['mot_de_passe'];
    $prenom1 = $query1['prenom'];
            
    // cette variable indique que l'authentification a échoué
    $authOK=false;
    $authOK1=false;
    $authOK2=false;

    // condition pour vérifier si les données existe dans la table
    if ($query['email_employe'] == $email && (password_verify($pass, $pass_hash))  && $query['id_groupe'] == 1 ) {
        
        // on ajoute ses infos en tant que variables de session
        $_SESSION['email_employe'] = $email;
        $_SESSION['mot_passe_employe'] = $pass_hash;
        $_SESSION['id_employe'] = $id_employe;
        $_SESSION['id_groupe'] = $groupe;
        $_SESSION['prenom_employe'] = $prenom;
        // cette variable indique que l'authentification a réussi
        $authOK = true;
        
    }
    elseif ($query['email_employe'] == $email && (password_verify($pass, $pass_hash)) && $query['id_groupe'] == 2 ) {
      
        // on ajoute ses infos en tant que variables de session
        $_SESSION['email_employe'] = $email;
        $_SESSION['mot_passe_employe'] = $pass_hash;
        $_SESSION['id_employe'] = $id_employe;
        $_SESSION['id_groupe'] = $groupe;
        $_SESSION['prenom_employe'] = $prenom;
        // cette variable indique que l'authentification a réussi
        $authOK1 = true;
        
    }
    elseif ($query1['email'] == $email && (password_verify($pass, $pass_hash1)) && $query1['id_groupe'] == 3 ) {
   
        // on ajoute ses infos en tant que variables de session
        $_SESSION['email'] = $email;
        $_SESSION['mot_de_passe'] = $pass_hash1;
        $_SESSION['idcandidat'] = $idcandidat;
        $_SESSION['id_groupe'] = $groupe1;
        $_SESSION['prenom'] = $prenom1;

        // cette variable indique que l'authentification a réussi
        $authOK2 = true;
        
    }
    }
        //On cloture la requete
        require_once('C:\wamp64\www\ppe3_vrai\bdd\close.php');
        
?>
<?php
    //Condition en cas de reconnaissance des données 
    if ($authOK) 
    {
        // Transmission sur la page admin
        header("location:\ppe3_vrai\dossier_admin\accueil_admin.php");
        // Lors de la connexion se deconnecter si on le souhaite    
    }
    elseif ($authOK1) 
    {
        // Transmission sur la page admin
        header("location:\ppe3_vrai\dossier_devellopeur\accueil_dev.php");
        // Lors de la connexion se deconnecter si on le souhaite    
    }
    elseif ($authOK2) 
{
        // Transmission sur la page admin
        header("location:\ppe3_vrai\dossier_candidat\accueil_candidat.php");
        // Lors de la connexion se deconnecter si on le souhaite    
}
       //Condition en cas de non-reconnaissance des données
    else { 
        // variable incluse via la page variable.php
        echo ("Vous n'avez pas été reconnu(e)");
        ?>

        <p><a href="connexion.php">Nouvel essai</p>

    <?php 
    } 
    ?> 
</body>
</html>

