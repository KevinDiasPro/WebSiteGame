<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////	UTILISATEURS 	///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Fonction pour verifier si le login et le mdp sont dans la base de donnée et si ils sont correctes
function valider_utilisateur($login, $mdp){
	 $authenticated=false;
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	$query = 'SELECT login, mdp FROM user WHERE login='.$dbh->quote($login).' AND mdp='.$dbh->quote(sha1($mdp));
	$result = $dbh -> query($query);
	if( $result->rowcount() == 0 ){	
		return false;
	}
	$dbh = null;
	$authenticated=true;
	return $authenticated;
}

// Fonction qui update le mot de passe 
function update_mdp($login,$mdp) {
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	$query = 'UPDATE user SET mdp=' . $dbh->quote(sha1($mdp)) .
	         'WHERE login=' . $login .'';
	$dbh->prepare($query)->execute();
	$dbh = null;	
}

// Fonction qui donne l'id de l'utilisateur
function get_id_utilisateur($login,$mdp) {
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');

	$query = 'SELECT login from user WHERE login='.$dbh->quote($login).' AND mdp='.$dbh->quote(sha1($mdp));
	$result = $dbh->query($query); 
	$id = -1;
	if ($result->rowcount()!=0) {
		$row = $result->fetch(PDO::FETCH_ASSOC);
		$id = $row['login'];
	}
	$dbh = null;
	return $id;
}

// Fonction qui donne le mot de passe
function get_mdp($login,$mdp) {
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');

	$query = 'SELECT uMdp from userPwd WHERE uId='.$dbh->quote($login).' AND uMdp='.$dbh->quote(sha1($mdp));
	$result = $dbh->query($query); 
	$id = -1;
	if ($result->rowcount()!=0) {
		$row = $result->fetch(PDO::FETCH_ASSOC);
	}
	$dbh = null;
	return true;
}

// Fonction qui update le mot de passe 
function create_mdp($login,$mdp) {
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	$query = 'INSERT INTO userPwd(uId,uMdp) values ('.$dbh->quote($login).', '.$dbh->quote(sha1($mdp)).')'; 
	$dbh->prepare($query)->execute();
	$dbh = null;	
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////	JEUVIDEO 	///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Fonction recherche pour les titres des jeux
function select_jeu($keyword="") {
	
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	if ($keyword != "") {
	    // Remplacer une single quote par une single quote doublée pour que la requête SQL fonctionne avec une single quote dans le $keyword
	    $keyword = str_replace("'", "\'", $keyword);
		$query = "SELECT * from jeu where titre like '%" . $keyword . "%' order by id";
	} else {
		$query = 'SELECT * from jeu';
	}
	$result = $dbh->query($query); 
	$tableau = array();
	$i = 0;
	// Traitement et affichage des résultats de la requête SELECT qui précède
	if ($result->rowcount()!=0) {
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {	
			$tableau[$i] = array();
			$tableau[$i]['id']=$row['id'];
			$tableau[$i]['titre']=$row['titre'];
			$tableau[$i]['description']=$row['description'];
			$tableau[$i]['image']=$row['image'];
			$i++;
			}
	}	
	$dbh = null;
	return $tableau;
}

//Fonction qui ajoute un jeu
function ajouter_jeu($titre, $description,$image){

$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$query = 'INSERT INTO jeu (titre, description, image) values ('.$dbh->quote($titre).', '.$dbh->quote($description). ', '.$dbh->quote($image).')'; 
$dbh->prepare($query) ->execute();
$dbh = null;
}

// Fonction qui modifie le jeu 
function modifier_jeu($id,$titre,$description,$image) {
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	$query = 'UPDATE jeu SET titre=' . $dbh->quote($titre) . ',description=' . $dbh->quote($description) . ',image=' . $dbh->quote($image) . 
	         'WHERE id=' . $id .'';
	$dbh->prepare($query)->execute();
	
	$dbh = null;	
}

//Supprime le jeu de la db
function delete_jeudb($id) {
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
		
	$query = 'DELETE FROM jeu WHERE jeu.id = '. $id .' LIMIT 1';
	$dbh->prepare($query)->execute();
	
	$dbh = null;	
}

//Fonction qui detail un jeu
function detail_jeu($id){
        $dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
        if(check($id)){
                $query ='SELECT id,titre,description,image, avg(notes.note), count(notes.note) FROM jeu, notes WHERE id = '.$id.' AND jeu.id = notes.id_jeu GROUP BY notes.id_jeu';
                $result = $dbh->query($query);
                $tableau= array();
                if ($result->rowcount()!=0) {
                        $i=0;
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                $tableau[$i] = array();
                                $tableau[$i]['id']=$row['id'];
                                $tableau[$i]['titre']=$row['titre'];
                                $tableau[$i]['description']=$row['description'];
                                $tableau[$i]['image']=$row['image'];
                                $tableau[$i]['note']=$row['avg(notes.note)'];
                                $tableau[$i]['vote']=$row['count(notes.note)'];
                                $i++;
                        }
                }
        }else{
                $query ='SELECT * FROM jeu WHERE id = '.$id;
                $result = $dbh->query($query);
                $tableau= array();
                if ($result->rowcount()!=0) {
                        $i=0;
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                $tableau[$i] = array();
                                $tableau[$i]['id']=$row['id'];
                                $tableau[$i]['titre']=$row['titre'];
                                $tableau[$i]['description']=$row['description'];
                                $tableau[$i]['image']=$row['image'];
                                $tableau[$i]['note']=0;
                                $tableau[$i]['vote']=0;
                                $i++;
                        }
                }
        }
        $dbh=null;
        return $tableau;
}

function check($id){
        $dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
         $query ='SELECT * FROM notes WHERE id_jeu ='.$id;
         $result = $dbh->query($query);
        return $result->rowcount()!=0;
}
//Selectionne le top 10 des jeux
function table_top10(){
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	$query ='SELECT jeu.titre, jeu.image ,avg(notes.note) FROM jeu, notes WHERE jeu.id = notes.id_jeu GROUP BY notes.id_jeu ORDER BY avg(notes.note) DESC LIMIT 10';
	$result = $dbh->query($query);
	$tableau = array();
	if($result->rowcount()!=0){
		$i=0;
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$tableau[$i] = array();
			$tableau[$i]['titre']=$row['titre'];
			$tableau[$i]['image']=$row['image'];
			$tableau[$i]['note']=$row['avg(notes.note)'];
			$i++;
			}
	}	
	$dbh=null;
	return $tableau;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////	COMMENTAIRE/NOTE 	///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Insere une note dans la db
function insert_note($note,$id_jeu) {
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	$query = 'insert into notes (id_jeu, note) 
	          values ('. $dbh->quote($id_jeu) . ',' . $dbh->quote($note) . ')';
	$dbh->prepare($query)->execute();
	$dbh = null;
}

//Insere un commentaire dans la db
function insert_commentaire($commentaire,$id_jeu,$pseudo) {
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	$commentaire=strip_tags($commentaire);
	$pseudo=strip_tags($pseudo);
	$query = 'insert into commentaires (commentaire, id_jeu, pseudo) 
	          values ('. $dbh->quote($commentaire) . ',' . $dbh->quote($id_jeu) . ',' . $dbh->quote($pseudo) . ')';
	$dbh->prepare($query)->execute();
	$dbh = null;
}
//Insere un prix dans la db
function insert_prix($prix,$id_jeu,$pseudo) {
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	$prix=strip_tags($prix);
	$pseudo=strip_tags($pseudo);
	$query = 'insert into prix (prix, id_jeu, pseudo) 
	          values ('. $dbh->quote($prix) . ',' . $dbh->quote($id_jeu) . ',' . $dbh->quote($pseudo) . ')';
	$dbh->prepare($query)->execute();
	$dbh = null;
}

//Selectionne un jeu et les commentaires de celui ci
function detail_jeu_et_commentaire($id){
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	$query ='SELECT * from commentaires where commentaires.id_jeu ='.$id.'';
	$result = $dbh->query($query);
	$tableau=array();
	if ($result->rowcount()!=0) {
		$i=0;
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$tableau[$i] = array();
			$tableau[$i]['id_commentaire']=$row['id_commentaire'];
			$tableau[$i]['id_jeu']=$row['id_jeu'];
			$tableau[$i]['commentaire']=$row['commentaire'];
			$tableau[$i]['pseudo']=$row['pseudo'];
		
			$i++;
			}
	}	
	$dbh=null;
	return $tableau;
}

//Selectionne un jeu et les prix de celui ci
function detail_jeu_et_prix($id){
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	$query ='SELECT * from prix where prix.id_jeu ='.$id.'';
	$result = $dbh->query($query);
	$tableau=array();
	if ($result->rowcount()!=0) {
		$i=0;
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$tableau[$i] = array();
                        $tableau[$i]['id_prix']=$row['id_prix'];
			$tableau[$i]['id_jeu']=$row['id_jeu'];
			$tableau[$i]['prix']=$row['prix'];
			$tableau[$i]['pseudo']=$row['pseudo'];
			$i++;
			}
	}	
	$dbh=null;
	return $tableau;
}


//Supprime un commentaire
function delete_commentaire($id_commentaire){
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
		
	$query = 'DELETE FROM commentaires WHERE id_commentaire = '.$id_commentaire;
	$dbh->prepare($query)->execute();
	
	$dbh = null;	
}
//Selectionne le top 10 des commentaires
function table_top10commentaire(){
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	$query ='SELECT * FROM commentaires ORDER BY id_commentaire DESC LIMIT 10';
	$result = $dbh->query($query);
	$tableau = array();
	if($result->rowcount()!=0){
		$i=0;
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$tableau[$i] = array();
			$tableau[$i]['id_commentaire']=$row['id_commentaire'];
			$tableau[$i]['id_jeu']=$row['id_jeu'];
			$tableau[$i]['pseudo']=$row['pseudo'];
			$tableau[$i]['commentaire']=$row['commentaire'];
			
			$i++;
			}
	}	
	$dbh=null;
	return $tableau;
}
//Selectionne le top n des commentaire,n defini par l'admin
function table_top10commentaire_admin($nombre){
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	$query ='SELECT * FROM commentaires ORDER BY id_commentaire DESC LIMIT '. $nombre;
	$result = $dbh->query($query);
	$tableau = array();
	if($result->rowcount()!=0){
		$i=0;
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$tableau[$i] = array();
			$tableau[$i]['id_commentaire']=$row['id_commentaire'];
			$tableau[$i]['id_jeu']=$row['id_jeu'];
			$tableau[$i]['pseudo']=$row['pseudo'];
			$tableau[$i]['commentaire']=$row['commentaire'];
			
			$i++;
			}
	}	
	$dbh=null;
	return $tableau;
}
//Selectionne le top n des jeux,n defini par l'admin
function table_top10_admin($nombre){
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	$query ='SELECT avg(notes.note),jeu.titre, jeu.image  FROM jeu, notes WHERE jeu.id = notes.id_jeu GROUP BY notes.id_jeu ORDER BY avg(notes.note) DESC LIMIT ' . $nombre;
	$result = $dbh->query($query);
	$tableau = array();
	if($result->rowcount()!=0){
		$i=0;
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$tableau[$i] = array();
			$tableau[$i]['titre']=$row['titre'];
			$tableau[$i]['image']=$row['image'];
			$tableau[$i]['note']=$row['avg(notes.note)'];
			$i++;
			}
	}	
	$dbh=null;
	return $tableau;
}
//Selectionne la table des commentaires
function table_commentaire(){
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	$query ='SELECT * FROM commentaires';
	$result = $dbh->query($query);
	$tableau = array();
	if($result->rowcount()!=0){
		$i=0;
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$tableau[$i] = array();
			$tableau[$i]['id_commentaire']=$row['id_commentaire'];
			$tableau[$i]['id_jeu']=$row['id_jeu'];
			$tableau[$i]['pseudo']=$row['pseudo'];
			$tableau[$i]['commentaire']=$row['commentaire'];
			$tableau[$i]['date']=$row['date'];
			
			$i++;
			}
	}	
	$dbh=null;
	return $tableau;
}
//Selectionne la table des notes
function table_notes(){
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	$query ='SELECT avg(notes.note), count(notes.note),notes.id_jeu, jeu.image FROM jeu, notes WHERE jeu.id = notes.id_jeu GROUP BY notes.id_jeu';
	$result = $dbh->query($query);
	$tableau = array();
	if($result->rowcount()!=0){
		$i=0;
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$tableau[$i] = array();
			$tableau[$i]['note']=$row['avg(notes.note)'];
			$tableau[$i]['nombreVote']=$row['count(notes.note)'];
			$tableau[$i]['image']=$row['image'];
			$tableau[$i]['id_jeu']=$row['id_jeu'];
			$i++;
			}
	}	
	$dbh=null;
	return $tableau;
}
//Selectionne la table des derniers ajouts
function table_derniers_ajouts(){
	$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
	$query ='SELECT * FROM jeu ORDER BY id DESC LIMIT 10';
	$result = $dbh->query($query);
	$tableau = array();
	if($result->rowcount()!=0){
		$i=0;
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$tableau[$i] = array();
			$tableau[$i]['id']=$row['id'];
			$tableau[$i]['titre']=$row['titre'];
			$tableau[$i]['image']=$row['image'];
			$i++;
			}
	}	
	$dbh=null;
	return $tableau;
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////	ABRACADABRA 	///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Selectionne un objet au hasard dans la table
function select_hasard(){
		$dbh = new PDO('mysql:host=localhost;dbname=41481','root','');
		$query='SELECT id FROM jeu ORDER BY rand() LIMIT 1'; 
		$result = $dbh->query($query);
		if($result->rowcount()==1){
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				$id = $row['id'];
			}
		}
		$dbh = null;
		return $id;
	}
	
	
	
?>