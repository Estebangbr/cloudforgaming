<?php
    session_start();
    require_once 'config.php'; // On inclu la connexion à la bdd
    // Si les variables existent et qu'elles ne sont pas vides

    $req = $bdd->prepare('SELECT * FROM user WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();

    $idUser = $data['id'];
    echo $idUser;
    $idCommande = $_GET['idCommande'];
    echo $idCommande;


    $q = "UPDATE commande SET actif=0 WHERE idCommande =?";
    $req = $bdd->prepare($q);
    $req->execute([$_GET['idCommande']]);


    header('Location:user_commande.php?reg_err=success');
?>


