

<?php session_start();
  if(!isset($_SESSION['email'])) {header('location: index.php?arn');}
//require "conf.inc.php";

require "function.php";
$pdo = connectDB();
$logError="";





if (isset($_POST['idCommande'])){
  //DELETE FROM COMMANDE && LIVRAISON
  $q = "UPDATE commande SET actif=0  WHERE idCommande = ?";
  $req = $pdo->prepare($q);
  $req->execute([$_POST['idCommande']]);

  $q = "UPDATE livraison SET actif=0  WHERE idCommande = ?";
  $req = $pdo->prepare($q);
  $req->execute([$_POST['idCommande']]);

  header('location: ../deleteCommand.php');

}else {
  echo ("Erreur, contactez votre administrateur système");
}
