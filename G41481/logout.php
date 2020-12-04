<?php
# Identifier la SESSION en cours car nous sommes dans un nouveau script � c�t� de index.php!
session_start();
# Initialiser le tableau des variables de session
$_SESSION = array();
# Détruire la session
session_destroy();
# Redirection HTTP à la page d'accueil
header("Location: index.php"); 
die();
?>