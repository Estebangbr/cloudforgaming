

<?php session_start();
//if(!isset($_SESSION['email'])) {header('location: index.php?arn');}
//require "conf.inc.php";

require "function.php";
$pdo = connectDB();
$logError="";





$datetime=date("Y-m-d");
$providerName=$_POST['providerName'];
$providerAdress=$_POST['providerAdress'];
$providerPhoneNumber=$_POST['providerPhoneNumber'];
$providerEmail=$_POST['providerEmail'];
$providerZipCode=$_POST['providerZipCode'];
$providerCity=$_POST['providerCity'];

if (isset($_POST['providerName'])){
  if (isset($_POST['providerAdress'])){
    if (isset($_POST['providerPhoneNumber'])){
      if (isset($_POST['providerEmail'])){
        if (isset($_POST['providerZipCode'])){
          if (isset($_POST['providerCity'])){



          $query = "INSERT INTO fournisseur
          (nom,adresse,telephone,email,codePostal,dateAjout,ville)
          VALUES
          (:providerName, :providerAdress, :providerPhoneNumber, :providerEmail, :providerZipCode, :providerPutDate, :providerCity)";
          $queryPrepared = $pdo->prepare($query);
          $queryPrepared->execute(
              [
                  ":providerName"=>$providerName,
                  ":providerAdress"=>$providerAdress,
                  ":providerPhoneNumber"=>$providerPhoneNumber,
                  ":providerEmail"=>$providerEmail,
                  ":providerZipCode"=>$providerZipCode,
                  ":providerPutDate"=>$datetime,
                  ":providerCity"=>$providerCity
              ] );


          $q = "SELECT idFournisseur FROM fournisseur WHERE email = ?";
          $req = $pdo->prepare($q);
          $req->execute([$_POST['providerEmail']]);
          $fournisseur=$req->fetch();

          $codeFournisseur=$fournisseur["idFournisseur"]+4585;



          //UPDATE fournisseur SET codeFournisseur=$fournisseur WHERE email=['providerEmail']


          $query = "UPDATE fournisseur SET codeFournisseur=:codeFournisseur WHERE email=:email";
          $queryPrepared = $pdo->prepare($query);
          $queryPrepared->execute(
              [
                  "codeFournisseur"=>$codeFournisseur,
                  "email"=>$providerEmail
              ] );


              //insert en base sans codeFournisseur
              //recuperer idFournisseur qu'on vient d'insérer
              //update la ligne, en insérant codeFournisseur=ifFournisseur+245132







          header("Location: ../newProvider.php");

          }
        }
      }
    }
  }
}
