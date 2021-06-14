<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Page principale du site</title>
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
                    <a href="index.php">ACCUEIL</a>
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
                <center><h2>Contact:</h2></center><br><br>
                <center><a href="accueil.php">Retour</a><center><br><br>

<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
<form action="envoi_contact.php" method="post" name="formulaire">
<tr>
<td colspan="3"><strong>Veuillez insérer vos données ci-dessous:</strong></td>
</tr>
<tr>
<td><div align="left">Votre nom :</div></td>
<td colspan="2"><input type="text" name="nom" size="45" maxlength="100"></td>
</tr><br>
<tr>
<td width="17%"><div align="left">Votre mail :</div></td>
<td colspan="2"><input type="text" name="mail" size="45" maxlength="100"></td>
</tr>
<tr>
<td><div align="left">Sujet : </div></td>
<td colspan="2"><input type="text" name="objet" size="45" maxlength="120"></td>
</tr>
<tr>
<td><div align="left">Message : </div></td>
<td colspan="2"><textarea name="message" cols="50" rows="10"></textarea></td>
</tr>
<tr>
<td></td>
<td width="42%"><center>
<input type="reset" name="Submit" value="Réinitialiser le formulaire">
</center></td>
<td width="41%"><center>
<input type="submit" name="Submit" value="Envoyer">
</center></td>
</tr>
</form>
</table>

</body>
</html>