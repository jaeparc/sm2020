<?php session_start(); ?>
<html>
    <head>
        <title>Se connecter - SkoolMeat</title>
        <link rel="stylesheet" href="css/styleseconnecter.css" />
        <nav>
	        <a href="index.php">Accueil</a>
            <a href="seconnecter.php">Connexion</a>
            <a href="signin.php">Inscription</a>
	        <div class="animation start-home"></div>
        </nav>
</head>
<body>
        <img class="logo" src="img/logo.PNG">
    <h1><br>Bienvenue sur SkoolMeat</br></h1>
    
<form id="login" method="post" action="seconnecter.php">
    <h3>Log In</h3>
        <fieldset id="inputs">
            <input type="text" name="email" placeholder="Adresse Mail" autofocus required>
            <input type="text" name="password" placeholder="Mot de passe" required>
        </fieldset>
        <fieldset id="actions">
            <form method="post" action="">
                <input class="button" type="submit" value="Se connecter">    
            </form>
            <form method="post" action="signin.php">
                <input class="button" type="submit" value="S'inscrire">
            </form>
        </fieldset>
</form>
    
<?php
    $bdd = new PDO('mysql:host=192.168.65.194; dbname=skoolmeat; charset=utf8', 'root', 'root');

    if(isset($_POST['email']) && isset($_POST['password'])){
    $mailconnect = $_POST['email'];
    $mdpconnect = $_POST['password'];
    $requser = $bdd->prepare("SELECT * FROM user WHERE mail = ? AND password = ?");
    $requser->execute(array($mailconnect, $mdpconnect));
    $userexist = $requser->rowCount();
    $userinfo = $requser->fetch();
    if ($userexist == 1) {
        $_SESSION['mail'] = $userinfo['mail'];
        //echo "Connecté en tant que ".$userinfo['prenom']." ".$userinfo['nom'];
        ?> 
        <h1>Connexion en cours</h1>
        <meta http-equiv="refresh" content="2;URL=profilperso.php">
    <?php
    }
    else{
        echo "E-mail ou mot de passe incorrect";
    }
}
    ?>
</body>

</html>