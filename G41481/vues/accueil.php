<?php

echo <<<FIN
$header
<body>
<div id="global">
	<div id="entete">
		<h1>
			<a href="$homepage">
			</a>
			$titre
		</h1>
		<p class="sous-titre">
		</p>
	</div><!-- #entete -->
	<div id="navigation">
		$menu
	</div><!-- #navigation -->
	<div id="contenu">
		<h2>$h2_titre</h2>
		<p>Bienvenue dans la GameTheque</p>
		<p> Ici, nous vous montrons nos jeux vidéos préférés et nous vous donnons nos avis pour vous convaincre à les essayer. </p>
		<p>Cette GameTheque est le fruit d'une passion partagée par deux amis. Oui, nous sommes fort passionnés par les jeux vidéos depuis tout petits,</p>
		<p>mais comme on dit " I'm not a geek, I'm a gamer" même si les termes sont proches l'un de l'autre.</p>
		<p>Nous vous souhaitons une très bonne visite.</p>
        
		<p>Rechercher un jeu plus vite par ici : $formulaire_recherche </p>
		<p>
			<center>$tablejeux</center>
		</p>
	</div><!-- #contenu -->
	
	<div id="pied">
	    $footer
	</div><!-- #pied -->
</div><!-- #global -->
</body>
</html>
FIN
?>


