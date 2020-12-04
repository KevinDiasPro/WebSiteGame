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
		$detail_jeu
		$commentaire
                $prix
		$formulaire_commentaire
		$formulaire_note
                $formulaire_prix
		
		
	</div><!-- #contenu -->
	<div id="pied">
	    $footer
	</div><!-- #pied -->
</div><!-- #global -->
</body>
</html>
FIN
?>