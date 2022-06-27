<?php

require "function.php";

//Connexion à la bdd
    $pdo = connectDB();



        $date = $_POST["date"];
        $ville = $_POST["ville"];
        $adresse = $_POST["adresse"];
        $codePostal = $_POST["codePostal"];


        $query = "INSERT INTO camion
		(date, ville, adresse, codePostal)
		VALUES
		(:date, :ville, :adresse, :codePostal)";

        $queryPrepared = $pdo->prepare($query);
        $queryPrepared->execute(
            [
                ":date"=>$date,
                ":ville"=>$ville,
                ":adresse"=>$adresse,
                ":codePostal"=>$codePostal
            ] );

      header("Location: ../emplacementCamion.php");
