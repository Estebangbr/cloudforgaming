<?php

require "function.php";

//Connexion à la bdd
    $pdo = connectDB();

    $date =  $_POST["date"];
    $ville = $_POST["ville"];
    $adresse = $_POST["adresse"];
    $codePostal = $_POST["codePostal"];


    $q = "UPDATE camion SET date = :date,
                                ville = :ville,
                                adresse = :adresse,
                                codePostal = :codePostal
                                 WHERE idFranchise = :idFranchise";
          $req = $pdo->prepare($q);
          $req->execute([
              'date' => $date,
              'ville' => $ville,
              'adresse' => $adresse,
              'codePostal' => $codePostal,
              'idFranchise' => $_GET["id"]
            ]);

header("Location: ../emplacementCamion.php");
?>
