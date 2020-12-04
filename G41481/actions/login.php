<?php
#
$h2_titre = 'Se connecter !';

# L'utilisateur s'est-il bien authentifié ?
if (!isset($_POST['login'])) {
    # L'utilisateur doit remplir le formulaire
	$notification='Authentifiez-vous';
	# Construction du formulaire HTML
	$form_login = form_login();
} elseif (!valider_utilisateur($_POST['login'],$_POST['mdp'])) {
	# L'authentification n'est pas correcte
	$notification='Vos données d\'authentification ne sont pas correctes.';
	# Construction du formulaire HTML
	$form_login = form_login();
} else {
	# L'utilisateur est bien authentifié, la variable de session $_SESSION['authenticated'] est créée
    $_SESSION['authenticated'] = true; 
	# Redirection HTTP pour demander la page admin
    header("Location: index.php?action=admin"); 
	die();
}

# -----------------------
# Vue : Page de login
# -----------------------
# Variables nécessaires : $header, $homepage, $titre, $menu, $h2_titre, $footer, $form_login, $notification
require('vues/login.php');
?>