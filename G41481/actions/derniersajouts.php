<?php
#
$h2_titre = 'Les derniers jeux vidéos ajoutés :';
if (isset($_SESSION['authenticated'])&& !isset($_POST['delete'])) {
	$tableau=derniers_ajouts_admin(table_derniers_ajouts());
} else if (isset($_SESSION['authenticated'])&& isset($_POST['delete'])){
	foreach($_POST['delete'] as $i => $id){
		delete_jeudb($id);
	}
	$tableau=derniers_ajouts_admin(table_derniers_ajouts());
} else {
	$tableau=derniers_ajouts(table_derniers_ajouts());
}


require('vues/derniersajouts.php');
?>