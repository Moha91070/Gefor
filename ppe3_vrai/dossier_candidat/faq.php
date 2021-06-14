



}

	<?php 
	require_once('verification.php');
	if($_SESSION['cursus'] != 2 ){
		header('redirection_candidat.php');
	}

	$title="Foire aux questions";
	require_once('../header.php');
	require_once('header_candidat.php');
	 ?>

	
		<h2>FAQ</h2>

		<div >
			<ul>
				<li class='faq' >Je souhaite rectifier des informations sur mon dossier mais je n'y ai pas accès :
					<p>Une fois les informations validées par le gestionnaire il est impossible de modifier les données qui apparaissent désormais en consultation sur votre profil.<br>Il est nécessaire de nous contacter via le formulaire de l'onglet <a href="contact.php">CONTACT</a> pour nous soumettre toute demande de modification</p>
				</li>
				<li class='faq' >J'ai rempli mon dossier de préinscription, dois-je envoyer ma demande de congé à mon employeur ?
					<p>Vous devez passer l'entretien au sein de notre organisme et attendre notre accord avant de demander votre congé</p>
				</li>
				<li class='faq'>Je suis en attente de l'accord de mon employeur, comment puis-je préparer mon dossier CPF ?
					<p>L'accès au formulaire sur nos services ne sera disponible qu'à réception de l'accord de votre employeur. Vous pouvez cependant consulter sur le site de<a href="https://www.transitionspro-idf.fr/accueil-particulier/les-documents-a-telecharger/"> Transition Pro,</a> les informations concernant le dossier à réaliser</p>
				</li>
				<li class='faq'>J'ai reçu l'accord de mon employeur, comment puis-je préparer mon dossier CPF ?
					<p>Vous devez téléverser le scan de votre accord depuis l'onglet <a href="televersement.php">DOSSIER</a></p>
				</li>
				<li class='faq'>J'ai déjà des compétences/diplômes, puis-je bénéficier d'une équivalence ?
					<p>Vos compétences vous seront utiles pour la constitution du dossier.<br>
						Si vous avez des diplômes pouvant donner lieu à des équivalences, vous devez téléverser le scan de votre/vos diplômes depuis l'onglet <a href="televersement.php">DOSSIER</a></p>
				</li>
			</ul>
		</div>






	

	<?php //require_once('../footer.php'); ?>
	



