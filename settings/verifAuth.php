<?php
include('function.php');
//Connexion à la bdd
$pdo = connectDB();
$logError="";

//est ce que j'ai un email un mot de passe dans $_POST
if( !empty($_POST['email']) && !empty($_POST['password'])){
//SI oui

    $email = strtolower($_POST['email']);
    $password = hash('sha256', $_POST['password']);

    $q = "SELECT idUser, email, password, role, actif FROM user WHERE email = ? AND password = ?";
    $req = $pdo->prepare($q);
    $req->execute(array($email, $password));
    $results = $req->fetch();


    if (count($results) == 5) {
        if ($results['role'] != 5) {
            if ($results['actif'] == 1) {
                session_start();
                $_SESSION['email'] = $email;

                isConnected();

                header('location: ../dashboard.php');
                exit;
            } else {
                header('location: ../index.php?error=actif');
            }
        } else {
            header('location: ../index.php?error=role');
        }
    } else {
        header('location: ../index.php?error=password');
    }
}