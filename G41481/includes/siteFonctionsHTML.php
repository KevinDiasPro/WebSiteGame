<?php

# Fonction qui renvoie le code HTML de l'en-tête de toutes les pages
function header_page($titre,$base_css,$modele_css) {
	$header ="";
  	$header.="<!DOCTYPE html>";
	$header.="<html lang=\"fr\">\n";
	$header.="<head>\n<meta charset=\"UTF-8\" >\n";
	$header.="<link rel=\"stylesheet\" type=\"text/css\" href=\"$base_css\" media=\"all\" >\n";
	$header.="<link rel=\"stylesheet\" type=\"text/css\" href=\"$modele_css\" media=\"screen\" >\n";
	$header.="<title>$titre</title>\n</head>\n";
	return $header;
}

# Fonction qui renvoie le code HTML du menu de toutes les pages
function menu() {
	$menu ="";
	$menu.="<ul>
			<li><a href=\"?action=acceuil\">Accueil</a></li>
			<li><a href=\"?action=top10\">Top 10 : Jeux</a></li>
			<li><a href=\"?action=top10commentaire\">Top 10 : Commentaires</a></li>
			<li><a href=\"?action=derniersajouts\">Derniers ajouts</a></li>
			<li><a href=\"?action=abracadabra\">Abracadabra</a></li>
			<li><a href=\"?action=contact\">Contactez-nous</a></li>
			";
	if (isset($_SESSION['authenticated'])) {
		$menu.="<li><a href=\"?action=admin\">Zone Admin</a></li>";
                $menu.="<li><a href=\"?action=deconnexion\">Deconnexion</a></li>";
	} else {
	//Si pas connecté on relance la page
		$menu.="<li><a href=\"?action=login\">Connexion</a></li>";
	}
	$menu.="</ul>";
	return $menu;
}

// Fonction qui renvoie le code HTML du pied de toutes les pages
function footer_page($email) {
	$footer ='';
	$footer.="<strong>Excellente journée qu'aujourd'hui le " . date("j/m/Y") ." :: </strong>"; 
	# ! adresse email non cryptée : spam possible
	$footer.="<a href=\"mailto:";
	$footer.=$email;
	$footer.="\">";
	$footer.=$email;
	$footer.="</a>\n";
	$footer.="<p id=\"copyright\">
			Mise en page d'après
			<a href=\"http://www.alsacreations.com/tutoriels/\">Alsacréations</a>
		</p>";
	return $footer;
}

// Fonction qui renvoie le code HTML du formulaire de contact
function form_contact() {
    $form ="";
    $form .='
	<form action="?action=contact" method="post">
	<p>Votre titre : <input type="text" name="titre" /></p>
	<p>Votre email : <input type="text" name="email" /></p>
	<p>Votre message : <input type="text" name="message" /></p>
	<p><input type="submit" value="Envoyer"></p>
	</form>
	';
	return $form;
}

# Fonction qui renvoie le code HTML du formulaire d'ajout d'un jeu .
function form_jeu(){

 $form ="
	<form enctype=\"multipart/form-data\" action=\"?action=admin\" method=\"post\">
		<p><label for=\"titre\">Titre du jeuvideo:</label> <input type=\"text\" id=\"titre\" name=\"titre\"  value=\"Votre titre\"/></p>
		<p><label for=\"description\">Description du jeuvideo:</label><textarea name=\"description\" id = \"description\">Votre description</textarea></p>
		<p><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1000000\" />		</p>
		<p><label for=\"image\">Image du jeuvideo (H:250, l:200):</label><input name=\"image\" id= \"image\" type=\"file\" /></p>
		<p><input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1000000\" /></p>
		<p><input type=\"submit\" value=\"Ajouter\"></p>
	</form>
	";
	return $form;

}

# Fonction qui renvoie le code HTML du formulaire pour la recherche dans les livres
function form_recherche() {
	$form ="
	<form action=\"?action=jeux\" method=\"post\">
		<input type=\"text\" name=\"keyword\" /><input type=\"submit\" value=\"Rechercher\">
    </form>
	";
	return $form;
}

# Fonction qui renvoie le code HTML du formulaire de login
function form_login() {
	$form ='
	<form action="?action=login" method="post">
	<p>Login : <input type="text" name="login" /></p>
	<p>Mot de passe : <input type="password" name="mdp" /></p>
	<p><input type="submit" value="Se connecter"></p>
    </form>
	';
	return $form;
}

# Fonction qui renvoie le code HTML du formulaire de login
function form_change_mdp() {
	$form ='
	<form action="?action=admin" method="post">
	<p>Ancien mot de passe : <input type="password" name="oldmdp" /></p>
	<p>Nouveau mot de passe : <input type="password" name="newmdp1" /></p>
	<p>Répéter le nouveau mot de passe : <input type="password" name="newmdp2" /></p>
	<p><input type="submit" value="Changer"></p>
    </form>
	';
	return $form;
}

// Fonction qui renvoie le code HTML du tableau des jeux en mosaique
function tableau_jeux($tableau) {
	$tableJeux = '<table id="tableBalises">
				  <thead>
				  </thead>
			      <tbody>';
	   $tableJeux .= '<tr>';
	   $j = 0;
	for ($i=0;$i<count($tableau);$i++) {
		$id = $tableau[$i]['id'];
		$titre = $tableau[$i]['titre'];
		$image  = $tableau[$i]['image'];
		
		if($j ===4){
		 $tableJeux .= '<tr>';
		}
		
		$mosaique = "<td > <a href=\"?action=detail&id=".$id."\"> <img class=\"image\" alt=\"$titre\" src=\"$image\"> </a></td>";
		
		if($j === 4){
		 $tableJeux .= '<tr>';
		 $j=0;
		}
	 
		$tableJeux .= $mosaique;
		$j++;			
	}
	$tableJeux .= '</tr>';
	$tableJeux .= '</tbody>
				   </table>';
	return $tableJeux;
}

# Fonction qui génère un tableau HTML + formulaire pour l'administration des jeux
function tableau_admin_jeu($tableau) {
		$tablejeux = '<form action="?action=admin" method="post">
       <table id="tableBalises">
       <thead>
      <tr>
       <th>Titre</th>
       <th>Image</th>
       <th>Description</th>
       <th><input type="submit" name="Delete" value="Effacer"></th>
       <th><input type="submit" name="Update" value="Mettre à jour"></th>
      </tr>
       </thead>
       <tbody>';
  for ($i=0;$i<count($tableau);$i++) {
   $tablejeux .= '<tr>';
   $tablejeux .= "<td>" . $tableau[$i]['titre'] . "</td>
       <td> " ."<img src=".$tableau[$i]['image']. " class=\"imageTop10\"" . " alt=\"".$tableau[$i]['titre']."\"" ."/></td>
       <td>" . $tableau[$i]['description'] . "</td>";
   $tablejeux .= " 
        <td><input type=\"checkbox\"  name=\"delete[]\" value=" . $tableau[$i]['id'] . "></td>
       ";   
   $tablejeux .= " 
        <td><input type=\"checkbox\" name=\"modifier[]\" value=" . $tableau[$i]['id'] . "></td>
          ";
   $tablejeux .= '</tr>';
 
  }
   $tablejeux .= '
     <tr>
       <th>Titre</th>
       <th>Image</th>
       <th>Description</th>
       <th><input type="submit" name="Delete" value="Effacer"></th>
       <th><input type="submit" name="Update" value="Mettre à jour"></th>
     </tr>
       ';
 $tablejeux .= '</tbody>
       </table>
       </form>';
 return $tablejeux;
}

// affiche le tableau du jeu en detail
function tableau_jeu_detaille($tableau){
	$tablejeux = '<table id="tableBalises">
				  <thead>
					<tr>
							<th>Titre</th>
							<th>Image</th>
							<th>Description</th>
							<th>Note moyenne</th>
							<th>Nombre de votants</th>

					</tr>
				  </thead>
			      <tbody>';
	for ($i=0;$i<count($tableau);$i++) {
		$note = ROUND($tableau[$i]['note'],2);
	    $tablejeux .= '<tr>';
		$tablejeux .= "<td>" . $tableau[$i]['titre'] . "</td>
					  <td>" ."<img src=".$tableau[$i]['image']. " width=200" . " height=200" ." name=image" ."/></td>
					  <td>" . $tableau[$i]['description'] . "</td>
					  <td>" . $note . "</td>
					  <td>" . $tableau[$i]['vote']. "</td>";

                                                  
	    $tablejeux .= '</tr>';
	}
	$tablejeux .= '</tbody>
				  </table>';
	return $tablejeux;
}
//Fonction qui appelle un tableau pour la modification du jeu vidéo
function tableau_modification_jeu($tableau){
	for ($i=0;$i<count($tableau);$i++) {
		$form ='
	
	<form method="post" action="?action=admin" enctype="multipart/form-data">
	<p><img src="'.$tableau[$i]['image']. '" width=200" . " height=200" ." name=image" ."/></p>
	<p> Modification de ' . $tableau[$i]['titre'] .':</p>
	<p><input type="hidden" name="id" value="'.$tableau[$i]['id'].'" /></p>
	<p>Titre:	<input type="text" value="' . $tableau[$i]['titre'] .'" name="titre" /></p>
	<p>image : <input type="file" name="image" size="30"  /></p>
	<p>Description :</p>
	<p><textarea rows=8 cols=50 name="description" > ' . $tableau[$i]['description'] .'</textarea></p><br/> 
	<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
	<p><input type="submit" name="update" value="Modifier"></p>
        </form>
	';
	return $form;
	}
}
// Affiche le tableau top 10 des jeux
function tableau_top10($tableau){
	$tablejeux = '<table id="tableBalises">
      <thead>
     <th>Id</th>
     <th>Titre</th>
     <th>Image</th>
     <th>Note</th>
      </thead>
         <tbody>';
 for ($i=0;$i<count($tableau);$i++) {
  $note = ROUND($tableau[$i]['note'],3);
  $a=$i+1;
     $tablejeux .= '<tr>';
  $tablejeux .= "
     <td>" .$a.  "</td>
     <td>" . $tableau[$i]['titre'] . "</td>
     <td> " ."<img class=\"imageTop10\" src=".$tableau[$i]['image']. " alt=\"".$tableau[$i]['titre']."\" " ."/></td>
     <td>" . $note . "</td>";
     $tablejeux .= '</tr>';
 }
 $tablejeux .= '</tbody>
       </table>';
 return $tablejeux;
}
//Fonction pour inscrire une note
function formulaire_note($tableau,$id){
	for ($i=0;$i<count($tableau);$i++) {
		$form ='
	
	<form method="post" action="?action=detail&id='.$id.'">
	<h3> Ajouter une note :</h3>
	<p><input type="hidden" name="id" value="'.$tableau[$i]['id'].'" /></p>
	<label for="note" name="note">Note: </label>
			<select name="note">
				<option value="0">0</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
			</select>
	<p><input type="submit" value="Ajouter"></p>
    </form>
	';
	return $form;
	}
}

//Fonction pour inscrire un prix
function formulaire_prix($tableau,$id){
	for ($i=0;$i<count($tableau);$i++) {
		$form ='
	
	<form method="post" action="?action=detail&id='.$id.'">
	<h3> Le prix d achat pour ce jeu :</h3>
	<p><input type="hidden" name="id" value="'.$tableau[$i]['id'].'" /></p>
	<p>Votre pseudo : <input type="text" name="pseudo">
	<p>Votre prix :</p>
	<p><textarea rows=4 cols=20 name="prix" >Tapez ici votre prix</textarea></p>
	<p><input type="submit" value="Ajouter"></p>
    </form>
	';
	return $form;
	}
}

//Affiche la table des prix 
function table_prix($tableau){
	$tablejeux="";
if(count($tableau)!=0){
	$tablejeux = '<table id="tableprix">
				  <thead>
				  <tr>
					<th>Pseudo</th>
					<th>Prix</th>
				  </thead>
			      <tbody>';
	for ($i=0;$i<count($tableau);$i++) {
	    $tablejeux .= '<tr>';
		$tablejeux .= "
					<td>". $tableau[$i]['pseudo'] ."</td>
					<td> ".$tableau[$i]['prix']."</td>";
	    $tablejeux .= '</tr>';
	}
	$tablejeux .= '</tbody>
				   </table>';
	}
	return $tablejeux;
}



//Fonction pour inscrire un commentaire
function formulaire_commentaire($tableau,$id){
	for ($i=0;$i<count($tableau);$i++) {
		$form ='
	
	<form method="post" action="?action=detail&id='.$id.'">
	<h3> Par ici pour add un commentaire :</h3>
	<p><input type="hidden" name="id" value="'.$tableau[$i]['id'].'" /></p>
	<p>Votre pseudo : <input type="text" name="pseudo">
	<p>Votre commentaire :</p>
	<p><textarea rows=8 cols=50 name="commentaire" >Tapez ici votre commentaire</textarea></p>
	<p><input type="submit" value="Ajouter"></p>
    </form>
	';
	return $form;
	}
}
//Affiche la table des commentaires 
function table_commentaires($tableau){
	$tablejeux="";
if(count($tableau)!=0){
	$tablejeux = '<table id="tablecommentaire">
				  <thead>
				  <tr>
					<th>Pseudo</th>
					<th>Commentaire</th>
				  </thead>
			      <tbody>';
	for ($i=0;$i<count($tableau);$i++) {
	    $tablejeux .= '<tr>';
		$tablejeux .= "
					<td>". $tableau[$i]['pseudo'] ."</td>
					<td> ".$tableau[$i]['commentaire']."</td>";
	    $tablejeux .= '</tr>';
	}
	$tablejeux .= '</tbody>
				   </table>';
	}
	return $tablejeux;
}
//Fonction qui affiche le tableau lors de l'appel de la page commentaire
function tableau_top10commentaire($tableau){
	$tablejeux="";
if(count($tableau)!=0){
	$tablejeux = '<table id="tablecommentaire">
				  <thead>
				  <tr>
					<th>Num</th>
					<th>Pseudo</th>
					<th>Commentaire</th>
					<th>Detail du jeu </th>
				  </thead>
			      <tbody>';
	for ($i=0;$i<count($tableau);$i++) {
		$a=$i+1;
	    $tablejeux .= '<tr>';
		$tablejeux .= "
					<td>". $a ."</td>
					<td>". $tableau[$i]['pseudo'] ."</td>
					<td> ".$tableau[$i]['commentaire']."</td>
					<td><a href=\"?action=detail&id={$tableau[$i]['id_jeu']}\">Détail du jeu</a></td>
					";
					
	    $tablejeux .= '</tr>';
	}
	$tablejeux .= '</tbody>
				   </table>';
	}
	return $tablejeux;
}

//affiche la case suspens
function formulaire_top10jeu(){
	 $form='
	<form method="post" action="?action=top10"
	<p><input type="submit" name="jeu" value="Suspens"></p>
	</form>
 ';
 return $form; 
}
//Affiche la case allez vous etre decu
function formulaire_top10commentaire(){
	 $form='
	<form method="post" action="?action=top10commentaire">
	<p><input type="submit" name="commentaire" value="Allez vous etre déçu?"></p>
	</form>
 ';
 return $form; 
}
//Fonction qui affiche le tableau des commentaires pour l'admin
function table_commentaires_admin($tableau){
	$tablejeux="";
if(count($tableau)!=0){
	$tablejeux = '<form action="?action=detail" method="post">
				<table id="tablecommentaire">
				  <thead>
				  <tr>
					<th>Pseudo</th>
					<th>Commentaire</th>
					<th><input type="submit" name="Delete" value="Effacer"></th>
				  </thead>
			      <tbody>';
	for ($i=0;$i<count($tableau);$i++) {
	    $tablejeux .= '<tr>';
		$tablejeux .= "
					<td>". $tableau[$i]['pseudo'] ."</td>
					<td> ".$tableau[$i]['commentaire']."</td>";
		$tablejeux .= '	
					<input type="hidden" name="id" value=" '.$tableau[$i]['id_jeu'].'">
					<td><input type="checkbox" name="delete[]" value=" '. $tableau[$i]['id_jeu'] . '"></td>';
	    $tablejeux .= '</tr>';
	}
	$tablejeux .= '</tbody>
				   </table>
				   </form>';
	}
	return $tablejeux;
}

//Fonction qui affiche le tableau des prix pour l'admin
function table_prix_admin($tableau){
	$tablejeux="";
if(count($tableau)!=0){
	$tablejeux = '<form action="?action=detail" method="post">
				<table id="tableprix">
				  <thead>
				  <tr>
					<th>Pseudo</th>
					<th>Prix</th>
					<th><input type="submit" name="Delete" value="Effacer"></th>
				  </thead>
			      <tbody>';
	for ($i=0;$i<count($tableau);$i++) {
	    $tablejeux .= '<tr>';
		$tablejeux .= "
					<td>". $tableau[$i]['pseudo'] ."</td>
					<td> ".$tableau[$i]['prix']."</td>";
		$tablejeux .= '	
					<input type="hidden" name="id" value=" '.$tableau[$i]['id_jeu'].'">
					<td><input type="checkbox" name="delete[]" value=" '. $tableau[$i]['id_jeu'] . '"></td>';
	    $tablejeux .= '</tr>';
	}
	$tablejeux .= '</tbody>
				   </table>
				   </form>';
	}
	return $tablejeux;
}


//Formulaire qui affiche les jeux par le nombre choisi par l'admin
function formulaire_top10jeu_admin(){
$form='
	<form method="post" action="?action=top10">
	<p> Combien de jeux voulez-vous avoir ?  </p>
	<p><input type="number" min="0" value="10" name="choix" >
	<p><input type="submit" name="jeu" value="Top de votre choix"></p>
	</form>
 ';
 return $form; 
}
//Fonction qui affiche les commentaires par le nombre choisi par l'admin
function formulaire_top10commentaire_admin(){
$form='
	<form method="post" action="?action=top10commentaire">
	<p> Combien de derniers commentaires voulez-vous avoir </p>
	<p><input type="number" min="0" value="20" name="choix" >
	<p><input type="submit" name="commentaire" value="Derniers commentaires"></p>
	</form>
 ';
 return $form; 
}
//Fonction qui affiche les 10 derniers commentaires
function tableau_top10commentaire_admin($tableau){
 $tablejeux="";
if(count($tableau)!=0){
 $tablejeux = '<form action="?action=top10commentaire" method="post">
    <table id="tablecommentaire">
      <thead>
      <tr>
     <th>Num</th>
     <th>Pseudo</th>
     <th>Commentaire</th>
     <th>Lien</th>
     <th><input type="submit" name="Delete" value="Effacer"></th>
      </thead>
         <tbody>';
 for ($i=0;$i<count($tableau);$i++) {
  $a=$i+1;
     $tablejeux .= '<tr>';
  $tablejeux .= "
     <td>". $a ."</td>
     <td>". $tableau[$i]['pseudo'] ."</td>
     <td> ".$tableau[$i]['commentaire']."</td>
     <td><a href=\"?action=detail&id={$tableau[$i]['id_jeu']}\">Détail jeu</a></td>";
     
  $tablejeux .='<td><input type="checkbox" name="delete[]" value=" '. $tableau[$i]['id_commentaire'] . '"></td>';
     $tablejeux .= '</tr>';
 }
 $tablejeux .= '</tbody>
       </table>
       </form>';
 }
 return $tablejeux;
}
//Fonction qui affiche les derniers ajouts ainsi que delete ou nn le jeu
function derniers_ajouts_admin($tableau){
	$tablejeux = '<form action="?action=derniersajouts" method="post">
      <table id="tableBalises">
      <thead>
     <th>image</th>
     <th><input type="submit" name="Delete" value="Effacer"></th>
      </thead>
         <tbody>';
 for ($i=0;$i<count($tableau);$i++) {
  $a=$i+1;
     $tablejeux .= '<tr>';
  $tablejeux .= '<td>'."<a href=\"?action=detail&id={$tableau[$i]['id']}\" ><img src=".$tableau[$i]['image']. " alt=\"".$tableau[$i]['titre']."\"" . " class=\"imageTop10\""  ."/></a></td>";
  $tablejeux .='<td><input type="checkbox" name="delete[]" value=" '. $tableau[$i]['id'] . '"></td>';
     $tablejeux .= '</tr>';
 }
 $tablejeux .= '</tbody>
       </table>
       </form>';
 return $tablejeux;
}
//Fonction qui affiche les derniers ajouts
function derniers_ajouts($tableau){
$tablejeux = ' <table id="tableBalises">
      <thead>
      </thead>
         <tbody>';
 for ($i=0;$i<count($tableau);$i++) {
     $tablejeux .= '<tr>';
  $tablejeux .= '<td>'."<a href=\"?action=detail&id={$tableau[$i]['id']}\" ><img src=".$tableau[$i]['image']. " alt=\"".$tableau[$i]['titre']."\"" . " class=\"imageTop10\""  ."/></a></td>";
     $tablejeux .= '</tr>';
 }
 $tablejeux .= '</tbody>
       </table>';
 return $tablejeux;
 }
?>
