<?php
#
$h2_titre = 'Accueil';

$formulaire_recherche=form_recherche();

	# Sélection de tous les jeux en mosaique par defaut
	$tablejeux=tableau_jeux(select_jeu()); 


# Recherche si un mot clé est entré dans le formulaire de recherche
if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
	$tablejeux=tableau_jeux(select_jeu($_POST['keyword']));
} else {
	# Sélection de tous les jeux
	$tablejeux=tableau_jeux(select_jeu());
}

# --------------------
# Vue : Page d'accueil
# --------------------

require('vues/accueil.php');
?>
