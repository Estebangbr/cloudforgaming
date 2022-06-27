<?php

require "function.php";

//Connexion à la bdd
    $pdo = connectDB();



        $date = $_POST["date"];
        $kilometrage =$_POST["kilometrage"];
        $descriptif = $_POST["descriptif"];
        $modification = $_POST["modification"];
        $montant = $_POST["montant"];


        $query = "INSERT INTO entretien
		(date, kilometrage, descriptif, modification, montant)
		VALUES
		(:date, :kilometrage, :descriptif, :modification, :montant)";

        $queryPrepared = $pdo->prepare($query);
        $queryPrepared->execute(
            [
                ":date"=>$date,
                ":kilometrage"=>$kilometrage,
                ":descriptif"=>$descriptif,
                ":modification"=>$modification,
                ":montant"=>$montant
            ] );

      header("Location: ../carnetEntretiens.php");
