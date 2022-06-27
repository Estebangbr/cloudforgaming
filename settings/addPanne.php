<?php

require "function.php";

//Connexion à la bdd
    $pdo = connectDB();



        $date = $_POST["date"];
        $descriptif = $_POST["descriptif"];

        $query = "INSERT INTO panne
		(date, descriptif)
		VALUES
		(:date, :descriptif)";

        $queryPrepared = $pdo->prepare($query);
        $queryPrepared->execute(
            [
                ":date"=>$date,
                ":descriptif"=>$descriptif
            ] );

      header("Location: ../panne.php");
