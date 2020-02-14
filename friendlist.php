<?php session_start(); ?>
<html>

<head>
    <title>Mes amis - SkoolMeat</title>
</head>

<body>
    <?php
    $IdSession = $_SESSION['id'];
    $bdd = new PDO('mysql:host=192.168.65.194; dbname=skoolmeat; charset=utf8', 'root', 'root');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $test = $bdd->query("SELECT id_user FROM `friendsys` WHERE `id_friend` = " . $IdSession . " AND state = 1");
    $testDemande = $bdd->query("SELECT * FROM friendsys WHERE id_user = " . $IdSession . "");
    while ($friendID = $test->fetch()) {
        $reqfriend = $bdd->query("SELECT * FROM user WHERE id_user != ".$IdSession." AND id_user = ".$friendID[0]."");
        $friendinfo = $reqfriend->fetch();
        echo $friendinfo['nom']." ".$friendinfo['prenom'];
        ?>
        <form action="" method="post">
            <input type=submit name="delete" value="supprimer">
        </form>
        <?php
        if(isset($_POST['delete'])){
            $delfriend = $bdd->query("DELETE FROM `friendsys` WHERE id_user = ".$friendID[0]." AND id_friend = ".$IdSession."");
        }
        echo "<br>";
    }
    while ($friendID1 = $testDemande->fetch()) {
        $reqfriendemand = $bdd->query("SELECT * FROM user WHERE id_user != ".$IdSession." AND id_user = ".$friendID1['id_friend']."");
        $frienddemandinfo = $reqfriendemand->fetch();
        if($friendID1['state'] == 1){
            echo $frienddemandinfo['nom']." ".$frienddemandinfo['prenom'];
            ?>
        <form action="" method="post">
            <input type=submit name="delete" value="supprimer">
        </form>
        <?php
        if(isset($_POST['delete'])){
            $delfriend1 = $bdd->query("DELETE FROM `friendsys` WHERE id_user = ".$IdSession." AND id_friend = ".$friendID1[0]."");
        }
        }
        echo "<br>";
    }   
    ?>
</body>

</html>