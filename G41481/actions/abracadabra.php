<?php

$abracadabra = select_hasard();
header("Location: index.php?action=detail&id=$abracadabra"); # redirection HTTP vers l'action details
die(); 

require('vues/abracadabra.php');
?>
