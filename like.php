<?php session_start();
/*
<img class="logo" src="logo.PNG">
<link rel="stylesheet" href="disconnect.css" />
Work in progress come back later !
<form method="post" action="swipe.php">
    <input class="button" type="submit" value="Retour en sécurité">
</form>*/


$bdd = new PDO('mysql:host=192.168.65.194; dbname=skoolmeat; charset=utf8', 'root', 'root');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$test = $bdd->prepare("SELECT * FROM `friendsys` WHERE `id_friend` = ? AND `id_user` = ?");
$test->execute(array($_SESSION['id'],$_SESSION['idstranger']));
$demandexist = $test->rowCount();
if($demandexist == 1){
    $friend = $bdd->prepare("UPDATE `friendsys` SET `state` = 1 WHERE `friendsys`.`id_user` = ? AND `friendsys`.`id_friend` = ?");
    $friend->execute(array($_SESSION['idstranger'],$_SESSION['id']));
}
else if($demandexist == 0){
    $demand = $bdd->prepare("INSERT INTO `friendsys` (`id_user`, `id_friend`, `state`) VALUES(?, ?, ?)");
    $demand->execute(array($_SESSION['id'],$_SESSION['idstranger'],0));
}
echo $_SESSION['id'];
echo $_SESSION['idstranger'];
?>
<!-- <meta http-equiv="refresh" content="0;URL=seconnecter.php"> -->