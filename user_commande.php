<?php
    session_start();
    require_once 'config.php'; // On inclu la connexion à la bdd
    // Si les variables existent et qu'elles ne sont pas vides

    $req = $bdd->prepare('SELECT * FROM user WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();

    $idUser = $data['id'];
?>


  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <br><br>
                <center><h1 class="h3 mb-2 text-gray-800">Mes commandes</h1></center>
                <br><br>
                <center><h2 class="h3 mb-2 text-gray-800">Compte client : <?php echo $data['pseudo'] ?></h2></center>

                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                  <th>Numéro de commande<br>&nbsp</th>
                                  <th>Date début<br>&nbsp</th>
                                  <th>Offre choisi<br>&nbsp</th>
                                  <th>Email de commande<br>&nbsp</th>
                                  <th>Actif<br>&nbsp</th>
                                  <th>Résilier<br>&nbsp</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Numéro de commande<br>&nbsp</th>
                                    <th>Date début<br>&nbsp</th>
                                    <th>Offre choisi<br>&nbsp</th>
                                    <th>Email de commande<br>&nbsp</th>
                                    <th>Actif<br>&nbsp</th>
                                    <th>Résilier<br>&nbsp</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                <?php
                                    $query = $bdd->query("SELECT * FROM commande WHERE fk_idUser=$idUser");
                                    $result = $query->fetchAll();
                                    foreach($result as $commande){
                                        ?>
                                        <tr>
                                            <td scope="row"><?php echo $commande["idCommande"];?></td>
                                            <td><?php echo $commande["dateDebut"];?></td>
                                            <td><?php echo $commande["offre"];?></td>
                                            <td><?php echo $commande["email"];?></td>
                                            <td><?php echo $commande["actif"];?></td>
                                            <td><a href="resiliation.php?idCommande=<?php echo $commande["idCommande"]; ?>" class="btn btn-info">Résilier</a></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <center><a href="index-2.php?>" class="btn btn-info">Page d'accueil</a></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
