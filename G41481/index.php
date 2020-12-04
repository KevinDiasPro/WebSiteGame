<?php
# Pour pouvoir utiliser les variables de SESSION
session_start();

# Fonctions VIDEO
require('includes/siteFonctionsJEU.php');
# Fonctions qui génèrent de l'HTML
# Elles seront appelées dans le contrôleur principal et/ou ses actions
require('includes/siteFonctionsHTML.php');
require('includes/siteVariablesGlobales.php');
require('includes/siteFonctionsMetier.php');

# --------------------
# Contrôleur principal
# --------------------

# Constructions des éléments HTML communs à toutes les vues
$header = header_page($titre,$base_css,$modele_css);
$menu   = menu();
$footer = footer_page($email);

# Tableau contenant les valeurs possibles pour la variable GET 'action' dans l'URL
$actions = array('accueil','contact','login','admin','detail','top10','top10commentaire','abracadabra','derniersajouts','erreur','deconnexion'); 
# Quelle action est demandée par l'utilisateur dans l'URL ?
if (isset($_GET['action']) && in_array($_GET['action'],$actions)) {
	# Inclusion du code contrôleur correspondant à l'action demandée
	require('actions/' . $_GET['action'] . '.php');
} 
else {
    # Inclusion du code contrôleur de la page d'accueil
    require('actions/accueil.php');
}
?>