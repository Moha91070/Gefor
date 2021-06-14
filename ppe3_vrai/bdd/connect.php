<?php
try{
	// Connexion a la base 
	$db = new PDO('mysql:host=localhost;dbname=ppe3', 'root', '',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	$db->exec('SET NAMES "UTF8"');
	
} catch (PDOException $e){
	echo 'Erreur : '. $e->getMessage();
	die();
}
?>


