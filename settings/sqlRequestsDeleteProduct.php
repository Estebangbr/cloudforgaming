

<?php session_start();
  if(!isset($_SESSION['email'])) {header('location: index.php?arn');}
//require "conf.inc.php";

require "function.php";
$pdo = connectDB();
$logError="";





if (isset($_POST['idProduit'])){
  //DELETE FROM LIVRAISON && COMMANDE

  $q = "UPDATE catalogue SET actif=0  WHERE idProduit = ?";
  $req = $pdo->prepare($q);
  $req->execute([$_POST['idProduit']]);


  header('location: ../deleteProduct.php');

}else {
  echo ("Erreur, contactez votre administrateur système");
}
