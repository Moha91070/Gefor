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
    && isset($_POST['groupe']) && !empty($_POST['groupe'])

    ){
  
         //verification des pwd idendique si oui connection BDD
        if($_POST['pass1'] != $_POST['pass2']){
            
            header("location:../ajout_employe.php?error=Mot de passe différent");     
           
        }else{
            require_once('../../bdd/connect.php');
            $mail= securite($_POST['mail']);

            //VERIFICATION DU LOGIN SI IL EXISTE DANS LA BDD
            $verifLogin= $db->prepare("SELECT COUNT(*) FROM candidat WHERE email = '$mail'");
            $verifLogin->execute();
            $resultat= $verifLogin->fetch();

            $verifLogin= $db->prepare("SELECT COUNT(*) FROM employe WHERE email_employe = '$mail'");
            $verifLogin->execute();
            $resultat1= $verifLogin->fetch();

            if($resultat1['COUNT(*)'] == 0 && $_POST['groupe'] != 3 ){ //create login si la requête renvoie 0
                $nom= securite($_POST['nom']);
                $prenom= securite($_POST['prenom']);
                $groupe = $_POST['groupe'];
                
                $pass_hache = password_hash($_POST['pass1'], PASSWORD_DEFAULT); // cryptage du code 
                $inscrit= $db->prepare("INSERT INTO employe ( nom_employe, prenom_employe, email_employe, mot_passe_employe,id_groupe, date_ajout)
                VALUES ('$nom', '$prenom','$mail', '$pass_hache', $groupe, current_timestamp)");
                $inscrit->execute();
                header('location:../tab_employe.php?error=Mot de passe créé');}
           
            if($resultat['COUNT(*)'] == 0 && $_POST['groupe'] == 3 ){ //create login si la requête renvoie 0
                $nom= securite($_POST['nom']);
                $prenom= securite($_POST['prenom']);
                
                $pass_hache = password_hash($_POST['pass1'], PASSWORD_DEFAULT); // cryptage du code 
                $inscrit= $db->prepare("INSERT INTO candidat ( nom_dusage, prenom, email, mot_de_passe,id_groupe )
                VALUES ('$nom', '$prenom','$mail', '$pass_hache', 3)");
                $inscrit->execute();
                header('location:../ajout_employe.php?error=Mot de passe créé');
                    
        }elseif($resultat['COUNT(*)'] != 0){ // si la requête renvoie pas 0
             
            header("location:../ajout_employe.php?error=Mail déjà utiliser");
                  
                    }
                }
        
        }else{  
           
            header("location:../ajout_employe.php?error=veuillez remplir tous les champs");
        
    }
?>