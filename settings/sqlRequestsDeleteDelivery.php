

<?php session_start();
  if(!isset($_SESSION['email'])) {header('location: index.php?arn');}
//require "conf.inc.php";

require "function.php";
$pdo = connectDB();
$logError="";





if (isset($_POST['idLivraison'])){
  //DELETE FROM LIVRAISON && COMMANDE

  $q = "UPDATE commande SET actif=0  WHERE idLivraison = ?";
  $req = $pdo->prepare($q);
  $req->execute([$_POST['idLivraison']]);

  $q = "UPDATE livraison SET actif=0  WHERE idLivraison = ?";
  $req = $pdo->prepare($q);
  $req->execute([$_POST['idLivraison']]);

  header('location: ../deleteDelivery.php');

}else {
  echo ("Erreur, contactez votre administrateur système");
}
