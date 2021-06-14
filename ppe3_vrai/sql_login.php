<?php
function securite($data){
    $data=strip_tags($data);
    $data=trim($data);
    $data=htmlspecialchars($data);
    return $data;
}
// on vérifie que les données du formulaire sont présentes
if(isset($_POST['mail']) && !empty($_POST['mail']) 
    && isset($_POST['pass1']) && !empty($_POST['pass1'])
    && isset($_POST['pass2']) && !empty($_POST['pass2'])
    && isset($_POST['prenom']) && !empty($_POST['prenom'])
    && isset($_POST['nom']) && !empty($_POST['nom'])
    ){
  
         //verification des pwd idendique si oui connection BDD
        if($_POST['pass1'] != $_POST['pass2']){
            
            header("location: inscription_accueil.php?error=Mot de passe différent");     
           
        }else{
            require_once('./bdd/connect.php');
            $mail= securite($_POST['mail']);

            //VERIFICATION DU LOGIN SI IL EXISTE DANS LA BDD
            $verifLogin= $db->prepare("SELECT COUNT(*) FROM candidat WHERE email = '$mail'");
            $verifLogin->execute();
            $resultat= $verifLogin->fetch();
            
           
            if($resultat['COUNT(*)'] == 0){ //create login si la requête renvoie 0
                $nom= securite($_POST['nom']);
                $prenom= securite($_POST['prenom']);
                
                $pass_hache = password_hash($_POST['pass1'], PASSWORD_DEFAULT); // cryptage du code 
                $inscrit= $db->prepare("INSERT INTO candidat ( nom_dusage, prenom, email, mot_de_passe,id_groupe, cursus_formulaire)
                VALUES ('$nom', '$prenom','$mail', '$pass_hache', 4, 0)");
                $inscrit->execute();
                header('location: index.php?valide=Mot de passe créé');
                    
        }elseif($resultat['COUNT(*)'] != 0){ // si la requête renvoie pas 0
             
            header("location: inscription_accueil.php?error=Mail déjà utiliser ");
                  
                    }
                }
        
        }else{ // champs non renseigné
           
            header("location: inscription_accueil.php?error=veuillez remplir tous les champs ");
        
    }
?>