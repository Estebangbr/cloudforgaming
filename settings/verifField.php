<?php

include('function.php');

  $pdo = connectDB();



  if (isset($_GET['email'])) {
      $email = $_GET['email'];

      $sql = $pdo->prepare("SELECT email FROM user WHERE email = ?");
      $sql->execute([$email]);
      $res = $sql->fetchColumn();
      echo !$res ? 'false':'true';

  }

  if (isset($_GET['pwd'])) {
      $q = "SELECT password FROM user WHERE password = ?";
      $req = $pdo->prepare($q);
      $req->execute([$_GET['pwd']]);
      $pwd = $req->fetch();

      if (hash('sha256',$_GET['pwd']) == $pwd['password']) {
          echo true;
      } else {
          echo false;
      }
  }
