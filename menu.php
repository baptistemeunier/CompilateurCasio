<ul id="nav">
	<li><a href="menu.html">Accueil</a></li>
	<li><a href="./">Compilateur</a></li>
	<?php if(isset($_SESSION['pseudo'])){
		echo'<li><a href="programmes.php">Mes programmes</a></li>
		<li><a href="#">Deconnexion</a></li>';
	}else{ ?>
	<li><a href="inscription.php">Inscription</a></li>
	<li><a href="connexion.php">Connexion</a></li>
	<?php } ?>
</ul>