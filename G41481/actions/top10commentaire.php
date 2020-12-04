<?php
#
$h2_titre = 'Notre top 10 Commentaire';

if(isset($_SESSION['authenticated']) && !isset($_POST['jeu']) && !isset($_POST['commentaire']) && !isset($_POST['delete'])){
	$tableau="";
	$top10commentaire = formulaire_top10commentaire_admin();
} else if(isset($_POST['delete'])){
	foreach ($_POST['delete'] as $id) {
		delete_commentaire($id);
	}
	$tableau=tableau_top10commentaire_admin(table_top10commentaire_admin($_POST['choix']));
	$top10commentaire = formulaire_top10commentaire_admin();
        
} else if (isset($_SESSION['authenticated']) && isset($_POST['jeu']) && !isset($_POST['delete'])){
	if($_POST['choix']<1)  $tableau=tableau_top10(table_top10_admin(10));
	else $tableau=tableau_top10(table_top10_admin($_POST['choix']));
	$top10commentaire = formulaire_top10commentaire_admin();
        
} else if (isset($_SESSION['authenticated']) && isset($_POST['commentaire']) && !isset($_POST['delete'])){
	if($_POST['choix']<1)  $tableau=tableau_top10commentaire_admin(table_top10commentaire_admin(10));
	else $tableau=tableau_top10commentaire_admin(table_top10commentaire_admin($_POST['choix']));
	$top10commentaire = formulaire_top10commentaire_admin();
        
}else if(isset($_POST['jeu'])){
	$tableau = tableau_top10(table_top10());
	$top10commentaire = formulaire_top10commentaire();
        
} else if(isset($_POST['commentaire'])){
	$tableau = tableau_top10commentaire(table_top10commentaire());
	$top10commentaire = formulaire_top10commentaire();
} else {
	$tableau = "";
	$top10commentaire = formulaire_top10commentaire();
}


# --------------------
# Vue : Page d'accueil
# --------------------

require('vues/top10commentaire.php');
?>
