<?php
#
$h2_titre = 'Notre top 10 jeux';

 if(isset($_POST['jeu'])){
	$tableau = tableau_top10(table_top10());
	$top10jeu = formulaire_top10jeu();
} else {
	$tableau = "";
	$top10jeu = formulaire_top10jeu();

}


# --------------------
# Vue : Page d'accueil
# --------------------

require('vues/top10.php');
?>
