

<?php session_start();
//if(!isset($_SESSION['email'])) {header('location: index.php?arn');}
//require "conf.inc.php";

require "function.php";
$pdo = connectDB();
$logError="";


if (isset($_POST['idDepot'])){
  if (isset($_POST['commandProduct'])){
    if (isset($_POST['commandQuantity'])){
      if (isset($_POST['commandPrice'])){
        if (isset($_POST['commandComment'])){

          $idProduct=$_POST['commandProduct'];
          $delivery=$_POST['idDepot'];
          $commandDate=date("Y-m-d");
          $comment=$_POST['commandComment'];
          $quantity=$_POST['commandQuantity'];
          $price=$_POST['commandPrice'];

          //CREER LA Commande
          $query = "INSERT INTO commande
          (idProduit,descriptif,quantite,dateCommande,prix)
          VALUES
          (:idProduit, :descriptif, :quantite, :dateCommande, :prix)";
          $queryPrepared = $pdo->prepare($query);
          $queryPrepared->execute(
              [
                  ":idProduit"=>$idProduct,
                  ":descriptif"=>$comment,
                  ":quantite"=>$quantity,
                  ":dateCommande"=>$commandDate,
                  ":prix"=>$price
              ] );

          //Recuperation de notre idCommande
          $query = "SELECT * FROM commande WHERE idCommande=(SELECT max(idCommande) FROM commande)";
          $queryPrepared = $pdo->prepare($query);
          $queryPrepared->execute();
          $result=$queryPrepared->fetchAll();
          foreach ($result as $id) {
            if ($id["idProduit"]==$idProduct){
              if ($id["descriptif"]==$comment){
                if ($id["quantite"]==$quantity){
                  if ($id["dateCommande"]==$commandDate){
                    if ($id["prix"]==$price) {
                      //On s'est assuré que l'idCommande récupéré est bien le bon
                      $idCommande=$id["idCommande"];
                    }
                  }
                }
              }
            }
          }

          //Créer la livraison
          $query = "INSERT INTO livraison
          (idCommande,idDepot,livre,livraisonProblematique)
          VALUES
          (:idCommande, :idDepot, :livre, :livraisonProblematique)";
          $queryPrepared = $pdo->prepare($query);
          $queryPrepared->execute(
              [
                  ":idCommande"=>$idCommande,
                  ":idDepot"=>$delivery,
                  ":livre"=>"non",
                  ":livraisonProblematique"=>"non"
              ] );

          //Récupération de notre idLivraison
          $query = "SELECT idCommande,idLivraison FROM livraison WHERE idLivraison=(SELECT max(idLivraison) FROM livraison)";
          $queryPrepared = $pdo->prepare($query);
          $queryPrepared->execute();
          $result=$queryPrepared->fetchAll();
          foreach ($result as $id) {
            if ($id["idCommande"]==$idCommande){
              //On s'est assuré que l'idLivraison récupéré est bien le bon
              $idLivraison=$id["idLivraison"];
            }
          }

          //Insertion de notre idLivraison dans notre table Commande
          $query = "UPDATE commande SET idLivraison=:idLivraison WHERE idCommande=:idCommande";
          $queryPrepared = $pdo->prepare($query);
          $queryPrepared->execute(
              [
                  "idLivraison"=>$idLivraison,
                  "idCommande"=>$idCommande
              ] );
          //Redirection vers le dashboard
          header("Location: ../commande.php");
        }
      }
    }
  }
}
