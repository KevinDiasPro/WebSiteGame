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
		<p>Bienvenue $nom</p>
		<div id="formulaire">$form</div>
		$tablejeux
		<p> Changer le mot de passe ? </p>
		$formchangemdp
			</div><!-- #contenu -->
	<div id="pied">
	    $footer
	</div><!-- #pied -->
</div><!-- #global -->
</body>
</html>
FIN
?>