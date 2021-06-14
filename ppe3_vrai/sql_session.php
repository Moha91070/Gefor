<?php 
function secu_xss($donnees){
    $donnees = trim($donnees);      // fonction de sécurisation des données saisie
    $donnees = stripcslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
    }
                                                    //CONNEXION ET CREATE SESSION
       
// on vérifie que le visteur a correctement rempli puis envoyé le formulaire
if( isset($_POST['connexion']) && $_POST['connexion'] == 'connexion'){
    if(isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['pass']) && !empty($_POST['pass'])){
        require_once("./bdd/connect.php"); // connexion à la BDD
       
        $login= secu_xss($_POST['email']); // récupération du membre grace à son login

        $recup= $db->prepare("SELECT email, mot_de_passe, idcandidat, id_groupe, nom_dusage, prenom, cursus_formulaire
         FROM candidat where email = '$login'");
        $recup->execute();
        $resultat= $recup->fetch();

        $recup1= $db->prepare("SELECT email_employe, mot_passe_employe, id_employe, id_groupe, nom_employe, prenom_employe
        FROM employe where email_employe = '$login'");
        $recup1->execute();
        $resultat1= $recup1->fetch();

        $verifpwd= password_verify($_POST['pass'],$resultat['mot_de_passe']);
        $verifpwd1= password_verify($_POST['pass'],$resultat1['mot_passe_employe']);} // vérification de pwd hashé grace a la fonction password_verify renvoi true ou false

        if(!$resultat && !$resultat1){ // si le login n'est pas le bon
            header('location:index.php?error=Mauvais identifiant ou mot de passe !');
            
        }else{
            if($verifpwd){ // CREATION DE LA SESSION 
                session_start();
                $_SESSION['login'] = $login;
                $_SESSION['idcandidat'] = $resultat['idcandidat'];
                $_SESSION['groupe'] = $resultat['id_groupe'];
                $_SESSION['nom'] = $resultat['nom_dusage'];
                $_SESSION['prenom'] = $resultat['prenom'];
                $_SESSION['cursus'] = $resultat['cursus_formulaire'];
                $_SESSION['email'] = $resultat['email'];

              
                header('location:redirection.php');
                  
            }elseif($verifpwd1){   
                session_start();
                $_SESSION['login'] = $login;
                $_SESSION['id_employe'] = $resultat1['id_employe'];
                $_SESSION['groupe'] = $resultat1['id_groupe'];
                $_SESSION['nom'] = $resultat1['nom_employe'];
                $_SESSION['prenom'] = $resultat1['prenom_employe'];
                
                header('location:redirection.php');
            }else { // si le pwd n'est pas bon 

                header('location:index.php?error=Mauvais identifiant ou mot de passe !');
            }

    }
}

     

