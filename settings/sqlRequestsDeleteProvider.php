

<?php session_start();
  if(!isset($_SESSION['email'])) {header('location: index.php?arn');}
//require "conf.inc.php";

require "function.php";
$pdo = connectDB();
$logError="";





if (isset($_POST['email'])){
  //DELETE FROM FOURNISSEUR
  $q = "UPDATE fournisseur SET actif=0 WHERE email =?";
  $req = $pdo->prepare($q);
  $req->execute([$_POST['email']]);


  //DELETE FROM CATALOGUE WHERE
  $q = "UPDATE catalogue SET actif=0  WHERE email = ?";
  $req = $pdo->prepare($q);
  $req->execute([$_POST['email']]);


  header('location: ../deleteProvider.php');
}else{
  echo ("Erreur, contactez votre administrateur système");
}
