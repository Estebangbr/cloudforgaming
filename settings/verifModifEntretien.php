<?php

require "function.php";

//Connexion à la bdd
    $pdo = connectDB();

    $date =  $_POST["date"];
    $kilometrage = $_POST["kilometrage"];
    $montant = $_POST["montant"];
    $descriptif = $_POST["descriptif"];
    $modification = $_POST["modification"];


    $q = "UPDATE entretien SET date = :date,
                                kilometrage = :kilometrage,
                                montant = :montant,
                                descriptif = :descriptif,
                                modification = :modification
                                 WHERE idEntretien = :idEntretien";
          $req = $pdo->prepare($q);
          $req->execute([
              'date' => $date,
              'kilometrage' => $kilometrage,
              'montant' => $montant,
              'descriptif' => $descriptif,
              'modification' => $modification,
              'idEntretien' => $_GET["id"]
            ]);

header("Location: ../carnetEntretiens.php");
?>
