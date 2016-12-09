<nav>
	<ul>
		<?php if (!isset($_SESSION['connect'])) { ?> <li><a href="<?=BASEURL?>/index.php/user/connexion">Connexion</a></li> <?php } ?>
		<?php if (isset($_SESSION['connect'])) { ?> <li><a href="<?=BASEURL?>/index.php/user/deconnexion">Déconnexion</a></li> <?php } ?>
		<?php if (!isset($_SESSION['connect'])) { ?> <li><a href="<?=BASEURL?>/index.php/user/inscription">Inscription</a></li> <?php } ?>
	</ul>
</nav>