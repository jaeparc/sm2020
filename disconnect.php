<?php session_start(); ?>
<img class="logo" src="logo.PNG">
<link rel="stylesheet" href="css/disconnect.css" />
Vous &ecirc;tes d&eacute;connect&eacute; !
<form method="post" action="index.php">
    <input class="button" type="submit" value="Retour à l'accueil">
</form>
<?php session_destroy(); ?>