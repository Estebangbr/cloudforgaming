<?php
    session_start();
    if (!isset($_SESSION['email'])) {header('location: ../index.php?arn');}
    include('function.php');
    $pdo = connectDB();

    $saveId = $_POST['saveId'];
    $saveEmail = $_POST['saveEmail'];

    if (isset($saveId) && $saveId != 0) {
        $email = $saveEmail;
        delProfil($pdo, $email);
        if ($email == $_SESSION['email']) {
            header('location: ../deconnexion.php');
        } else {
            header('location: ../memberList.php');
        }
    } else {
        $email = $_SESSION['email'];
        delProfil($pdo, $email);
        header('location: deconnect.php');
    }

    function delProfil($pdo, $email)
    {
        $q = "SELECT image FROM user WHERE email = ?";
        $req = $pdo->prepare($q);
        $req->execute([$email]);
        $img = $req->fetch();
        $temp_array = explode(".", $img['image']);
        $extension = end($temp_array);
        unlink('../profil/'.$email.'.'.$extension);

        $q = "DELETE FROM user WHERE email = ?";
        $req = $pdo->prepare($q);
        $req->execute([$email]);
    }
