<?php session_start(); ?>
<html>

<head>
    <title>Mon profil - SkoolMeat</title>
    <link rel="stylesheet" href="css/profileperso.css" />
    <nav>
	    <a href="swipe.php">Accueil</a>
        <a href="profilperso.php">Mon profil</a>
        <a href="disconnect.php">Deconnexion</a>
        <a href="disconnect.php">MES MEATS</a>
	    <div class="animation start-home"></div>
    </nav>
</head>

<body>
<img class="logo" src="img/logo.PNG">
    <?php
    $bdd = new PDO('mysql:host=192.168.65.194; dbname=skoolmeat; charset=utf8', 'root', 'root');
    $mailconnect = $_SESSION['mail'];
    $requser = $bdd->prepare("SELECT * FROM user WHERE mail = ?");
    $requser->execute(array($mailconnect));
    $userexist = $requser->rowCount();
    $userinfo = $requser->fetch();
    $_SESSION['id'] = $userinfo['id_user'];?>
    <div class="card">
        <div class="photoprofile">
            <img src="icon.png">
        </div>
        <h1>Nom : <?php echo $userinfo['nom']." ".$userinfo['prenom'];?></h1>
            <p class="title">Age : <?php echo $userinfo['age'];?></p>
            <p class="title">Email : <?php echo $userinfo['mail'];?></p>
            <p class="title2">Ma bio : <?php echo $userinfo['bio'];?></p>
            <form method="post" action="">
        <input class="bio" type="text" name="bio">
        <input class="button" type="submit" name="submit" value="Editer ma bio">
    </form>
    </div>
    <?php
    if(isset($_POST['bio'])){
        $modify = $bdd->prepare("UPDATE `user` SET `bio` = ? WHERE `user`.`id_user` = ?");
        $modify->execute(array($_POST['bio'],$userinfo['id_user']));
    }
    if($userinfo['rights'] = "admin"){
        ?><form action ="admin.php" method="post">
            <input type="submit" class="button" value="Acceder a la page administrateur">
        </form><?php
    }?>
    <form method="post" action="swipe.php">
        <input class="button" type="submit" value="Meat !">
    </form>
    <form method="post" action="disconnect.php">
        <input class="button" type="submit" value="Deconnexion">
    </form>

</body>

</html>
