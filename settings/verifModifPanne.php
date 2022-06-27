<?php

require "function.php";

//Connexion à la bdd
    $pdo = connectDB();

    $date =  $_POST["date"];
    $descriptif = $_POST["descriptif"];

    $q = "UPDATE panne SET date = :date,
                                descriptif = :descriptif
                                 WHERE idPanne = :idPanne";
          $req = $pdo->prepare($q);
          $req->execute([
              'date' => $date,
              'descriptif' => $descriptif,
              'idPanne' => $_GET["id"]
            ]);

header("Location: ../panne.php");
?>
