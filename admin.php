<?php session_start(); ?>
<html>

<head>
    <title>Mon profil - SkoolMeat</title>
    <link rel="stylesheet" href="profileperso.css" />
    <nav>
        <a href="swipe.php">Accueil</a>
        <a href="profilperso.php">Mon profil</a>
        <a href="disconnect.php">Deconnexion</a>
        <div class="animation start-home"></div>
    </nav>
</head>

<body>
    <?php require("user.php"); ?>
    <img class="logo" src="logo.PNG">
    <p>
        <h1>SkoolMeat</h1>
    </p>
    <p>
        <h2>Interface admin</h2>
    </p>
    <?php
    $bdd = new PDO('mysql:host=192.168.65.194; dbname=skoolmeat; charset=utf8', 'root', 'root');
    $mailconnect = $_SESSION['mail'];
    $requser = $bdd->prepare("SELECT * FROM user WHERE mail = ?");
    $requser->execute(array($mailconnect));
    $userexist = $requser->rowCount();
    $userinfo = $requser->fetch();
    if ($userinfo['rights'] == "admin") {
        echo "Vous êtes admin!";
        $profilbrut = $bdd->query("SELECT * FROM user");
        $TabUserIndex = 0;
        while ($tab = $profilbrut->fetch()) {
            $TabUser[$TabUserIndex++] = new User($tab['id_user'], $tab['prenom'], $bdd);
        }
    ?>
        <FORM action="" method="POST">
            <select name="Perso">
                <?php

                if (isset($_POST['Perso'])) {

                    foreach ($TabUser as $objetUser) {
                        if ($objetUser->getId() == $_POST["Perso"]) {
                            echo '<option selected="' . $objetUser->getId() . '"value="' . $objetUser->getId() . '">' . $objetUser->getNom() . '</option>';
                        } else {
                            echo '<option value="' . $objetUser->getId() . '">' . $objetUser->getNom() . '</option>';
                        }
                    }
                } else {
                    foreach ($TabUser as $objetUser) {
                        echo '<option value="' . $objetUser->getId() . '">' . $objetUser->getNom() . '</option>';
                    }
                }

                ?>
            </select>
            <input type="submit" class="button"></input>

            <?php if (isset($_POST['Perso'])) {
                foreach ($TabUser as $objetUser) {
                    if ($objetUser->getId() == $_POST["Perso"]) {
                        $objetUser->afficheUser();
                    }
                }
            } else {
                echo "Aucun user ou action selectionné";
            }
            ?><br>Supprimer un utilisateur<?php
                                            if (isset($_POST["check"])) {
                                                foreach ($_POST['check'] as $idcheck) {
                                                    $bdd->query("DELETE FROM `user` WHERE `user`.`id_user` = $idcheck");
                                                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                                }
                                            }

                                            ?>

            <form action="" method="POST">
                <?php foreach ($TabUser as $objetUser) {
                    echo '<div> <input type="checkbox" name="check[]" value="' . $objetUser->getId() . '">';
                    echo "<label for ='coding'>" . $objetUser->getNom() . "</label> </div>";
                } ?>

                <button type="submit" class="button">Supprimer</button>
            </form>
        </FORM>

        <br>Donner les droits d'admins
        <form action="" method="POST">

            <?php

            if ($objetUser->getId() == $_POST["radiobtn"] && isset($_POST["radiobtn"])) {
                foreach ($TabUser as $objetUser) {
                    echo "<div> <input type='radio' name='radiobtn[]' value='" . $objetUser->getId() . "' checked/>";
                    echo "<label for='code'>" . $objetUser->getNom() . "</label>";
                }
            } else {
                foreach ($TabUser as $objetUser) {
                    echo "<div> <input type='radio' name='radiobtn[]' value='" . $objetUser->getId() . "'";
                    echo "<label for='code'>" . $objetUser->getNom() . "</label>";
                }
            }


            ?>
            <div>
                <button type="submit" class="button">Donner les droits </button>
            </div>
        </form>

        <?php

        if (isset($_POST["radiobtn"])) {
            foreach ($_POST['radiobtn'] as $idUser) {


                $j = 0;
                foreach ($TabUser as $objetUser) {

                    if ($objetUser->getId() == $idUser) {
                        $objetUser->GiveDroit();
                        unset($TabUser[$j]);
                    }
                    $j++;
                }
            }
        }
        ?>

    <?php
    } else {
        echo "Vous n'avez rien à faire ici!";
    }
    ?>

</body>

</html>