<?php


//Création de la session dans la page

// Condition au cas ou mauvais identifiant se connecte
require_once('verification.php');
if($_SESSION['cursus'] == 2 && $_SESSION['cursus'] == 3  ){
  header('location:redirection.php');
}
 
 

$title="Contact";
// inclusion du header dans la page 
require_once("../header.php");
require_once("header_candidat.php");
?>
<link rel="stylesheet" href="style_form.css">
<div class="container">
  <form method="post">

    <label for="fname">Nom</label>
    <input type="text" id="fname" name="firstname" placeholder="Votre nom .." value="<?=$_SESSION['nom']?>">

    <label for="lname">Prénom</label>
    <input type="text" id="lname" name="lastname" placeholder="Votre prénom.." value="<?=$_SESSION['nom']?>">


    <label for="subject">Objet</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

    <input type="submit" value="Submit">

  </form>
  <?php
    if(isset($_POST['subject'])){
        $recup_mail=$_SESSION['email'];
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
                    <h1>Message envoyé depuis la page Contact de gefor.fr</h1>
                     <font color="#303030";>
                     <div align="center">
                        <table width="600px">
                         <tr>
                             <td>
                                
                              <p><b>Nom : </b>' . $_POST['firstname'] . '<br>
                              <p><b>Préom : </b>' . $_POST['lastname'] . '<br>
                              <b>Email : </b>' . $_SESSION['email'] . '<br>
                              <b>Message : </b>' . $_POST['subject'] . '</p>                                
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
                    mail($recup_mail, " gefor.fr", $message, $header);
              echo "<strong style='color:green;'>Votre message a bien été envoyé.</strong>";
    }
    ?>
</div>

