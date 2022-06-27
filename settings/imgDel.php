<?php
    session_start();
    if (!isset($_SESSION['email'])) {header('location: ../index.php?arn');}
    include('function.php');
    $pdo = connectDB();

    $q = "SELECT image FROM user WHERE email = ?";
    $req = $pdo->prepare($q);
    $req->execute([$_GET['email']]);
    $img = $req->fetch();
    $temp_array = explode(".", $img['image']);
    $extension = end($temp_array);
    unlink('../profil/'.$_GET['email'].'.'.$extension);

    $imgDefaultPath = "profil/default-profile.png";

    $q = "UPDATE user SET image = :image WHERE email = :email";
    $req = $pdo->prepare($q);
    $req->execute(array(
        'image' => $imgDefaultPath,
        'email' => $_GET['email']
    ));


