<?php

session_start();
require_once("./bdd/connect.php");
    

if(isset($_GET['section'])){
    $section=htmlspecialchars($_GET['section']);
}else{
    $section="";
}


    if(isset($_POST['recup_submit'], $_POST['recup_mail'])){
        if(!empty($_POST['recup_mail'])){

            $recup_mail = htmlspecialchars($_POST['recup_mail']);
            if(filter_var($_POST['recup_mail'],FILTER_VALIDATE_EMAIL)) {
                // si le $_POST email existe alors on va aller verifier si il correspond à un client de notre data base.
                $mail_exist=$db->prepare('SELECT idcandidat, nom_dusage
                                          FROM candidat 
                                          WHERE email =?;');
                $mail_exist->execute(array($recup_mail));
                $mail_exist_count=$mail_exist->rowCount();

                // si le $_POST email existe alors on va aller verifier si il correspond à un employe de notre data base.
                $mail_exist1=$db->prepare('SELECT id_employe, nom_employe
                                           FROM employe
                                           WHERE  email_employe=?;');
                $mail_exist1->execute(array($recup_mail));
                $mail_exist1_count=$mail_exist1->rowCount();


                if($mail_exist_count == 1){
                    $pseudo=$mail_exist->fetch();
                    $pseudo=$pseudo['nom_dusage'];
                    

                    // si le mail existe on va generer un code qui va ns permettre de securiser notre recuperation de mp
                    $_SESSION['recup_mail']=$recup_mail;
                    // on initialise la variable de code securité
                    $recup_code="";
                    for($i=0; $i<8; $i++){
                        $recup_code .= mt_rand(0,9);                        
                    }
                    

                    $mail_recup_exist = $db->prepare('SELECT id FROM recup_mp WHERE email= ?');
                    $mail_recup_exist->execute(array($recup_mail));
                    $mail_recup_exist=$mail_recup_exist->rowCount();

                    if($mail_recup_exist == 1){

                        $recup_insert= $db->prepare('UPDATE recup_mp SET code = ? WHERE email = ? ');
                        $recup_insert->execute(array($recup_code, $recup_mail));
    

                    }else{

                        $recup_insert= $db->prepare('INSERT INTO recup_mp(email, code) VALUES (?,?)');
                        $recup_insert->execute(array($recup_mail,$recup_code));
    
                    }
                    $header="MIME-Version: 1.0\r\n";
                    $header.='From:"[VOUS]"<mohamed.akhmouch@gmail.com>'."\n";
                    $header.='Content-Type:text/html; charset="utf-8"'."\n";
                    $header.='Content-Transfer-Encoding: 8bit';
                    $message = '<html>
                                <head>
                                 <title>Récupération de mot de passe - gefor.com</title>
                                 <meta charset="utf-8" />
                                </head>
                                <body>
                                 <font color="#303030";>
                                 <div align="center">
                                    <table width="600px">
                                     <tr>
                                         <td>
                                            
                                            <div align="center">Bonjour <b>'.$pseudo.'</b>,</div>
                                            Voici votre code de récupération: <b>'.$recup_code.'</b><br><br>
                                            A bientôt sur <a href="gefor.com">gefor.com</a> !
                                            
                                         </td>
                                     </tr>
                                     <tr>
                                         <td align="center">
                                            <font size="2">
                                             Ceci est un email automatique, merci de ne pas y répondre
                                            </font>
                                         </td>
                                     </tr>
                                    </table>
                                 </div>
                                 </font>
                                </body>
                                </html>
                                ';
                                mail($recup_mail, "Récupération de mot de passe - gefor.com", $message, $header);
                                header("Location:recuperation_mp.php?section=code");

                   

                }elseif($mail_exist1_count == 1){

                    $pseudo=$mail_exist1->fetch();
                    $pseudo=$pseudo['nom_employe'];
                    // si le mail existe on va generer un code qui va ns permettre de securiser notre recuperation de mp
                    $_SESSION['recup_mail']=$recup_mail;
                    // on initialise la variable de code securité
                    $recup_code="";
                    for($i=0; $i<8;
                     $i++){
                        $recup_code .= mt_rand(0,9);                        
                    }
                    $_SESSION['recup_code']=$recup_code;

                    $mail_recup_exist = $db->prepare('SELECT id FROM recup_mp WHERE email= ?');
                    $mail_recup_exist->execute(array($recup_mail));
                    $mail_recup_exist=$mail_recup_exist->rowCount();

                    if($mail_recup_exist == 1){

                        $recup_insert= $db->prepare('UPDATE recup_mp SET code = ? WHERE email = ? ');
                        $recup_insert->execute(array($recup_code, $recup_mail));
    

                    }else{

                        $recup_insert= $db->prepare('INSERT INTO recup_mp(email, code) VALUES (?,?)');
                        $recup_insert->execute(array($recup_mail,$recup_code));
    
                    }
                    $header="MIME-Version: 1.0\r\n";
                    $header.='From:"[VOUS]"<mohamed.akhmouch@gmail.com>'."\n";
                    $header.='Content-Type:text/html; charset="utf-8"'."\n";
                    $header.='Content-Transfer-Encoding: 8bit';
                    $message = '<html>
                                <head>
                                 <title>Récupération de mot de passe - Votresite</title>
                                 <meta charset="utf-8" />
                                </head>
                                <body>
                                 <font color="#303030";>
                                 <div align="center">
                                    <table width="600px">
                                     <tr>
                                         <td>
                                            
                                            <div align="center">Bonjour <b>'.$pseudo.'</b>,</div>
                                            Voici votre code de récupération: <b>'.$recup_code.'</b>
                                            A bientôt sur <a href="#">Votre site</a> !
                                            
                                         </td>
                                     </tr>
                                     <tr>
                                         <td align="center">
                                            <font size="2">
                                             Ceci est un email automatique, merci de ne pas y répondre
                                            </font>
                                         </td>
                                     </tr>
                                    </table>
                                 </div>
                                 </font>
                                </body>
                                </html>
                                ';
                                mail($recup_mail, "Récupération de mot de passe - erni_ramonage.fr", $message, $header);
                                header("Location:recuperation_mp.php?section=code");

                }else{
                    $error="Cette adresse mail n'est pas enregitrée";
                }
            }else{
                $error = "Adresse mail invalide";
            }

       

        }else{
            $error="Veuillez entrez votre adresse mail";
           
           
        }
    }

    if(isset($_POST['verif_submit']) && isset($_POST['verif_code'])){
        if(!empty($_POST['verif_code'])){
            $verif_code=htmlspecialchars($_POST['verif_code']);
            $verif_req=$db->prepare('SELECT id FROM recup_mp WHERE email= ? AND code= ?');
            $verif_req -> execute (array($_SESSION['recup_mail'], $verif_code));
            $verif_req_count=$verif_req->rowcount();

            if($verif_req_count == 1){
                $up_req=$db->prepare('UPDATE recup_mp set confirme = 1 WHERE email = ?');
                $up_req->execute(array($_SESSION['recup_mail']));
                header("Location:recuperation_mp.php?section=changemdp");

            }else{
                $error="Code invalide";
            }

        }else{
            $error="Veuillez entrer votre code de confirmation.";
        }
    }
    if(isset($_POST['change_submit'])){
        // si les 2 champs mp et nouveau mot de passe sont remplies on va les sécuriser
        if(isset($_POST['change_mdp'],$_POST['change_mdpc'])){
            $verif_confirme=$db->prepare('SELECT confirme FROM recup_mp WHERE email= ?');
            $verif_confirme->execute(array($_SESSION['recup_mail']));
            $verif_confirme=$verif_confirme->fetch();
            $verif_confirme=$verif_confirme['confirme'];

            if($verif_confirme == 1){
                $mdp=htmlspecialchars($_POST['change_mdp']);
                $mdpc=htmlspecialchars($_POST['change_mdpc']);
                
                if(!empty($mdp) && !empty($mdpc)){                    
                    // si les mots de passe correspondent on va les chiffrer
                    if($mdp==$mdpc){
                        $mdp=password_hash($mdp, PASSWORD_DEFAULT);
                        $req_groupe=$db->prepare('SELECT id_groupe FROM candidat WHERE email=?');
                        $req_groupe->execute(array($_SESSION['recup_mail']));                        
                        $req_groupe=$req_groupe->rowCount();
                        $req_groupe1=$db->prepare('SELECT id_groupe FROM employe WHERE email_employe=?');
                        $req_groupe1->execute(array($_SESSION['recup_mail']));                        
                        $req_groupe1=$req_groupe1->rowCount();
                        if($req_groupe == 1){                     
                            // chiffré le $mdp avant de l'inserer dans la base de donnée
                            
                            $inser_mp=$db->prepare('UPDATE candidat SET mot_de_passe = ? WHERE email = ?');
                            $inser_mp->execute(array($mdp,$_SESSION['recup_mail']));
                            $del_req=$db->prepare('DELETE FROM recup_mp WHERE email=?');
                            $del_req->execute(array($_SESSION['recup_mail']));
                            header('location: index.php');
                        }elseif($req_groupe1 == 1){
                            
                            $inser_mp=$db->prepare('UPDATE employe SET mot_passe_employe = ? WHERE email_employe = ?');
                            $inser_mp->execute(array($mdp,$_SESSION['recup_mail']));
                            $del_req=$db->prepare('DELETE FROM recup_mp WHERE email=?');
                            $del_req->execute(array($_SESSION['recup_mail']));
                            header('location: index.php');

                        }

                    }else{
                        $error="Vos mots de passes ne correspondent pas";
                    }
                }
            }else{
                $error="Veuillez valider votre email grâce au code de vérification envoyé par mail";
            }

        }else{
            $error="Veuillez renseigner tous les champs";
        }
    }

    require_once('recuperation_view.php');
    //require_once('logout.php');