<?php
#
$h2_titre = 'Détail jeu';
# --------------------
# Vue : Page de detail video
# --------------------
if(isset($_GET['id']) && is_numeric($_GET['id']) && count(detail_jeu($_GET['id'])) !=0){
$id = $_GET['id'];
$formulaire_note = formulaire_note(detail_jeu($id),$id);
$formulaire_commentaire = formulaire_commentaire(detail_jeu($id),$id);
$formulaire_prix=formulaire_prix(detail_jeu($id),$id);
 
if(isset($_POST['note'])){
        insert_note($_POST['note'],$id);
}
if(isset($_POST['commentaire'])&&isset($_POST['pseudo']) && !empty($_POST['pseudo'])){
        insert_commentaire($_POST['commentaire'],$id,$_POST['pseudo']);
}
if(isset($_POST['prix'])&&isset($_POST['pseudo']) && !empty($_POST['pseudo'])){
        insert_prix($_POST['prix'],$id,$_POST['pseudo']);
}

if (isset($_SESSION['authenticated'])) {
        $commentaire = table_commentaires_admin(detail_jeu_et_commentaire($id));
        $prix=  table_prix_admin(detail_jeu_et_prix($id));
} else {
        
        $commentaire = table_commentaires(detail_jeu_et_commentaire($id));
        $prix=  table_prix(detail_jeu_et_prix($id));
}
if(isset($_POST['delete'])){
        foreach ($_POST['delete'] as $id) {
                delete_commentaire($id);
        }
        $commentaire = table_commentaires_admin(detail_jeu_et_commentaire($id));
}
$detail_jeu = tableau_jeu_detaille(detail_jeu($id));
 
if(isset($_POST['supprimer'])){
        foreach ($_POST['supprimer'] as $id) {
                delete_prix($id);
        }
        $prix = table_prix_admin(detail_jeu_et_prix($id));
}
$detail_jeu = tableau_jeu_detaille(detail_jeu($id));

}else{
        header("Location: index.php?action=erreur"); # redirection HTTP vers l'action erreur
        die();
}
require('vues/detail.php');
?>