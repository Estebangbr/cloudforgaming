<?php
    try
    {
        $bdd = new PDO("mysql:host=c4g-database:3306;dbname=cloudforgaming;charset=utf8", "admin", "ESGIProjet123!");
    }
    catch(PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }