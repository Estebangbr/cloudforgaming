<?php

require "conf.inc.php";

function connectDB(){

    if ($_SERVER['SERVER_NAME'] == 'localhost') {
        return new PDO('mysql:host=localhost;dbname=drivncook;port=3306', 'root', '',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
    } else {
        return new PDO(DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME . ";port=" . DBPORT, DBUSER, DBPWD,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
    }
}


function writelog($text, $file){
    $handle = fopen($file,'a+');
    fwrite($handle, $text);
    fclose($handle);
}


function createToken(){
    $token = md5(uniqid()."fkldmù!35".time());
    $token = substr($token, 0, rand(10,20));
    return $token;
}


function login($user){
    $token=createToken();
    $_SESSION["token"]=$token;
    $_SESSION["userid"]=$user["idUser"];
    $_SESSION["email"]=$user["email"];
    $query = "UPDATE user SET token='".$token."' WHERE idUser='".$user["idUser"]."' AND email='".$user["email"]."'";

    //UPDATE fdp_users SET token='5c61b056c6f79fkl' WHERE id=23 AND email='yohann.vql@gmail.com'

    $pdo = connectDB();
    $pdo->query($query);
}


function isConnected(){
    // est ce que les sessions existent
    //si oui
    //comparaison des variables de session avec la bdd
    //si oui
    //nouveau token
    //return true
    //si non
    //return false
    //si non return false

    if( !empty($_SESSION["token"]) && !empty($_SESSION["userid"]) && !empty($_SESSION["email"])){
        $query = "SELECT idUser FROM user WHERE token='".$_SESSION["token"]."' AND idUser=".$_SESSION["userid"]." AND email='".$_SESSION["email"]."'";
        $pdo = connectDB();
        $query = $pdo->query($query);
        $result = $query->fetch();

        if(!empty($result)){
            $user=["idUser"=>$_SESSION["userid"], "email"=>$_SESSION["email"]];
            login($user);
            ?>
            <html>
            <br>
            <a class="d-block small" href="logout.php">Se déconnecter</a>
            <a class="d-block small" href="myspaceUser.php">Mon espace</a>

            </html>
            <?php
            return true;

        }
    }
    echo "<br>";
    echo "Vous n'êtes pas connecté. Connectez vous ou créez un compte";
    return false;

}


function logout($email){
    $query = "UPDATE user SET token=null where email='".$email."'";
    $pdo = connectDB();
    $pdo->query($query);
    session_destroy();

}

function isAdmin(){
    if($_SESSION['admin'] == 1){
    }else{
        header('Location: index.php');
    }
}
/*function test(){


	header("Location: login.php");
}
*/