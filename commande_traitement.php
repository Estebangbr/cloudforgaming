<?php
    session_start();
    require_once 'config.php'; // On inclu la connexion à la bdd
    // Si les variables existent et qu'elles ne sont pas vides

    $req = $bdd->prepare('SELECT * FROM user WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();



    if(!empty($_POST['offre']) && !empty($_POST['email']) && !empty($_POST['dateDebut']))
    {
                // Patch XSS
                $offre = htmlspecialchars($_POST['offre']);
                $email = htmlspecialchars($_POST['email']);
                $dateDebut = $_POST['dateDebut'];
                $fk_idUser = $data['id'];
                $actif = 1;

                $insert = $bdd->prepare('INSERT INTO commande(offre, email, dateDebut, actif, fk_idUser) VALUES(:offre, :email, :dateDebut, :actif, :fk_idUser)');
                            $insert->execute(array(
                                'offre' => $offre,
                                'email' => $email,
                                'dateDebut' => $dateDebut,
                                'actif' => $actif,
                                'fk_idUser' => $fk_idUser
                            ));

        header('Location:user_commande.php?reg_err=success');


    }  