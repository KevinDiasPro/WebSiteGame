<?php
#
$h2_titre = 'Contact';

# Construction du formulaire HTML
$form_contact = form_contact();

# Envoi d'un email sur base des informations du formulaire transmises par la méthode POST
$notification='';
if (isset($_POST['email']) && isset($_POST['message'])) {
	if (empty($_POST['email']) & empty($_POST['message'])) {
		$notification='Veuillez entrer une adresse email et un message.';
	} elseif (empty($_POST['email'])) {
		$notification='Veuillez entrer une adresse email.';
	} elseif (empty($_POST['message'])) {
		$notification='Veuillez entrer un message.';
	} elseif (!valider($_POST['email'])) {
		$notification='Veuillez entrer une adresse email correcte.';
	} else {
		$to      = 'nivek-1@hotmail.com.com';
		$subject = 'Gametheque';
		$message = $_POST['message'];
		$headers = 'From: ' . $_POST['email'];

		if (mail($to, $subject, $message, $headers)) {
			$notification='Vos informations ont été transmises avec succès.';
		} else {
			$notification='Vos informations n\'ont pas été transmises à cause d\'un souci technique.';
		}
	}
}


# --------------------
# Vue : Page de contact
# --------------------
require('vues/contact.php');
?>