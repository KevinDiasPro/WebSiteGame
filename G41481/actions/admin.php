<?php
# Si un petit fûté écrit ?action=admin sans passer par l'action login
if (!isset($_SESSION['authenticated'])) {
	header("Location: index.php?action=login"); # redirection HTTP vers l'action login
	die(); 
}

# L'authentification est valide

#
$h2_titre = 'Zone d\'administration';
$nom = $_SESSION['authenticated'];

$form = form_jeu();

//Ajouter
# Insertion des données d'un jeuvideo en provenance du formulaire
if(isset($_POST['titre']) && isset($_POST['description'])&& isset($_FILES['image'])
 && !empty($_POST['titre']) && !empty($_POST['description'])&& !empty($_FILES['image'])){
		$image = $_FILES['image'];
		$description = $_POST['description'];
		$uploaddir = 'images/';
		$uploadfile = $uploaddir.basename($_FILES['image']['name']);		
		move_uploaded_file( $_FILES['image']['tmp_name'], $uploadfile );
		ajouter_jeu($titre, $description, $uploadfile);
		$notification = "Jeu ajouté";
}

//Mettre a jour
if(isset($_POST['update'])){
	$image='images/';
	$image=$image.basename($_FILES['image']['name']);
	move_uploaded_file($_FILES['image']['tmp_name'],$image);

	modifier_jeu($_POST['id'],$_POST['titre'],$_POST['description'],$image);
	$tablejeux=tableau_admin_jeu(select_jeu());
}
//Supprimer

if (isset($_POST['delete'])) {
    # Effacer le(s) video(s) dont la case est cochée dans le tableau-formulaire
 	foreach ($_POST['delete'] as $i => $id) {
		# $id est bien la clé primaire d'un jeu dans la table des jeux
	    delete_jeudb($id);
	}
	$tablejeux=tableau_admin_jeu(select_jeu());
}

elseif (isset($_POST['modifier'])) {
	# Une video est à mettre à jour : tableau formulaire pour la mise à jour à afficher
	$tablejeux="";
	foreach ($_POST['modifier'] as $i => $id) {
		# $id est bien la clé primaire d'un livre dans la table des jeux
	    $tablejeux.=tableau_modification_jeu(detail_jeu($id));
	}
}
else {
	#Sélection de tous les video et construction du tableau-formulaire à afficher
	$tablejeux=tableau_admin_jeu(select_jeu());
}

$formchangemdp=form_change_mdp();

# Changer le mot de passe ?
$notification = '';
if (isset($_POST['oldmdp'])&&!empty($_POST['oldmdp'])) {
	if (!valider_utilisateur($_SESSION['login'],$_POST['oldmdp'])) {
		$notification = 'Votre ancien mot de passe n\'est pas correct.';
	} elseif ($_POST['newmdp1'] != $_POST['newmdp2']) {
		$notification = 'Le nouveau mot de passe n\'est pas encodé deux fois correctement.';
        } elseif($_POST['newmdp1'] == $_POST['newmdp2'] && get_mdp($_SESSION['login'],$_POST['newmdp1']) == true){ 
          $notification = 'Votre mot de passe encodé est déja utilisé par un autre utilisateur';
	} else {
		# Modification du mot de passe dans la base de donnée
		$no = get_id_utilisateur($_SESSION['login'],$_POST['oldmdp']);
		update_mdp($no,$_POST['newmdp1']);
                create_mdp($no,$_POST['newmdp1']);
		$notification = 'Votre mot de passe a bien été changé.';
	}
}



# -----------------------
# Vue : Page de contact
# -----------------------
# Variables nécessaires : $header, $homepage, $image, $menu, $h2_image, $footer, $id_session
require('vues/admin.php');
?>