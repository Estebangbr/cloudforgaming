

<?php session_start();
  if(!isset($_SESSION['email'])) {header('location: index.php?arn');}
//require "conf.inc.php";

require "function.php";
$pdo = connectDB();
$logError="";

$datetime=date("Y-m-d");
if (isset($_POST['idLivraisonRecue'])){
  if (isset($_POST['etatLivraisonRecue'])){


    $q = "UPDATE livraison SET livre='oui',livraisonProblematique=:livraisonProblematique,dateLivraison=:dateLivraison  WHERE idLivraison =:idLivraisonRecue";
    $req = $pdo->prepare($q);
    $req->execute(array('livraisonProblematique'=>$_POST['etatLivraisonRecue'],'idLivraisonRecue'=>$_POST['idLivraisonRecue'],'dateLivraison'=>$datetime));

    header('location: ../confirmDelivery.php');

  }
}elseif (isset($_POST['idLivraisonNonRecue'])) {
    $q = "UPDATE livraison SET livre='non',livraisonProblematique='oui' WHERE idLivraison = ?";
    $req = $pdo->prepare($q);
    $req->execute([$_POST['idLivraisonNonRecue']]);

    header('location: ../confirmDelivery.php');
}


else echo ("Saisir tout les champs");
