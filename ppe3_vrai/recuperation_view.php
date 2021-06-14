
<?php 
if(isset($_GET['section'])){
    $section=htmlspecialchars($_GET['section']);
}else{
    $section="";
}

?>

<?php
$title="mot de passe oublié";

require('header.php');
?>
<article class = "index">
    <h2>Mot de passe oublié</h2>

    <?php if(isset($error)){echo "<span style='color: red'>".$error."</span>";}else{echo "<br>";}?>
            <h3 class="hero-title">récuperez votre mot de passe:<br></h3>
            <?php if($section == 'code'){?>
                Un code de vérification vous a été envoyé sur l'adresse: <?= $_SESSION['recup_mail'];
                ?><br><br> 
                <form action="recuperation_mp.php" method="post">      
                <input type="text" placeholder="Code de vérification" name="verif_code" id= "email" /><br><br>
                <input type="submit" name="verif_submit" value="Valider"/>
                </form><br><br>

            <?php }elseif($section=='changemdp'){ ?>
                Nouveau mot de passe pour <?= $_SESSION['recup_mail'];?><br><br> 
                <form action="recuperation_mp.php" method="post">      
                <input type="password" placeholder="nouveau mot de passe" name="change_mdp" /><br><br>
                <input type="password" placeholder="Confirmer mot de passe" name="change_mdpc"  /><br><br>
                <input type="submit" name="change_submit" value="Valider"/>
                </form><br><br>

            <?php }else{ ?>
            <form action="recuperation_mp.php" method="post">      
                <input type="email" placeholder="Votre adresse email" name="recup_mail" id= "email" /><br><br>
                <input type="submit" name="recup_submit" value="Valider"/><br><br>
            </form>
        <?php }?>
</article>
<?php
require_once('footer.php')
?>
