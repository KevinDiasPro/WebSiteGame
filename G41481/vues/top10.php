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
		<p>Voici le Top10 des jeux selon nous, n'oubliez pas que chaque personne a un gout différent.</p>
			$top10jeu
			$tableau
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



