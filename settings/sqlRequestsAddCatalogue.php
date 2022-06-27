

<?php session_start();
//if(!isset($_SESSION['email'])) {header('location: index.php?arn');}
//require "conf.inc.php";

require "function.php";
$pdo = connectDB();
$logError="";





$datetime=date("Y-m-d");
$productName=$_POST['productName'];
$productBuyPrice=$_POST['productBuyPrice'];
$productProvider=$_POST['productProvider'];
$productInputDate=$_POST['productInputDate'];
$productDescription=$_POST['productDescription'];

if (isset($_POST['productName'])){
  if (isset($_POST['productBuyPrice'])){
    if (isset($_POST['productProvider'])){
      if (isset($_POST['productDescription'])){



          $query = "INSERT INTO catalogue
          (dateSaisie,libelle,prixAchat,email,description)
          VALUES
          (:dateSaisie, :libelle, :prixAchat, :email, :description)";
          $queryPrepared = $pdo->prepare($query);
          $queryPrepared->execute(
              [
                  ":dateSaisie"=>$datetime,
                  ":libelle"=>$productName,
                  ":prixAchat"=>$productBuyPrice,
                  ":email"=>$productProvider,
                  ":description"=>$productDescription
              ] );
          header("Location: ../newProduct.php");

      }
    }
  }
}
