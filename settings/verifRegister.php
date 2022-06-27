<?php

require "function.php";

//Connexion à la bdd
    $pdo = connectDB();

if( true ){


    $firstName = ucwords(strtolower(trim($_POST["firstName"])));
    $lastName = strtoupper(trim($_POST["lastName"]));
    $email = strtolower(trim($_POST["inputEmail"]));
    $birthDate = $_POST["birthDate"];
    $phoneNumber = trim($_POST["phoneNumber"]);
    $pwd = $_POST["inputPassword"];
    $pwdConfirm = $_POST["confirmPassword"];
    $role = $_POST["droit"];
    $actif = $_POST["actif"];

    $longueurKey = 12;
    $key = "";
    for($i=1;$i<$longueurKey;$i++){
        $key .= mt_rand(0,9);
    }

    $image = "profil/default-profile.png";

        $query = "INSERT INTO user 
		(prenom, nom, email, image, birthdate, telephone, password, role, actif, confirmkey) 
		VALUES
		(:firstname, :lastname, :email, :image, :birthDate, :phone, :pwd, :role, :actif, :key)";
        //(:firstname , :lastname , :email , :birthDate , :phone, :pwd)
        //rôle 1 = Admin

        $pwd = hash('sha256',$pwd);

        $queryPrepared = $pdo->prepare($query);
        $queryPrepared->execute(
            [
                ":firstname"=>$firstName,
                ":lastname"=>$lastName,
                ":email"=>$email,
                ":image"=>$image,
                ":birthDate"=>$birthDate,
                ":phone"=>$phoneNumber,
                ":pwd"=>$pwd,
                ":role"=>$role,
                ":actif"=>$actif,
                ":key"=>$key
            ] );

/*
        // Send Email
            //$pwd = substr(md5(microtime()),rand(0,26),5);
            if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui rencontrent des bogues.
            {
                $passage_ligne = "\r\n";
            }
            else
            {
                $passage_ligne = "\n";
            }
        // Déclaration des messages au format texte et au format HTML.
            $message_txt = "Bonjour,".$passage_ligne.$passage_ligne."Voici votre identifiant:".$passage_ligne."Email: ".$email.$passage_ligne."Mot de passe de première connexion: ".$pwd.$passage_ligne.$passage_ligne."https://drivncook.tk
        ".$pwd.$passage_ligne.$passage_ligne."Cordialement,".$passage_ligne.$passage_ligne."L'équipe Driv'n Cook.";
            $message_html = '
        <html>
          <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
          </head>
          <body>
            <h1>Bonjour,</h1>
            <br><br>
            Voici votre identifiant:
              <br>
              <pre>
              <span>Email: <code>'.$email.'</code></span><br>
              <span>Mot de passe de première connexion: <code>'.$pwd.'</code></span>
              <br>
              <a href="https://www.mybiosec.fr/">https://www.mybiosec.fr/</a>
              </pre>
              <br>
              <br>
            Cordialement,
            <br><br>
            L\'équipe Driv\'n Cook.
          </body>
        </html>';

        // Création de la boundary
            $boundary = "-----=".md5(rand());

        // Définition du sujet.
            $sujet = "Inscription Driv'n Cook";

        // Création du header de l'e-mail.
            $header = "From: \"Driv'n Cook\"<drivncook.team@drivncook.tk>".$passage_ligne;
            $header.= "Reply-to: \"Driv'n Cook\" <drivncook.team@drivncook.tk>".$passage_ligne;
            $header.= "MIME-Version: 1.0".$passage_ligne;
            $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

        // Création du message.
            $message = $passage_ligne."--".$boundary.$passage_ligne;

        // Ajout du message au format texte.
            $message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
            $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
            $message.= $passage_ligne.$message_txt.$passage_ligne;

            $message.= $passage_ligne."--".$boundary.$passage_ligne;
        // Ajout du message au format HTML
            $message.= "Content-Type: text/html; charset=\"UTF-8\"".$passage_ligne;
            $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
            $message.= $passage_ligne.$message_html.$passage_ligne;

            $message.= $passage_ligne."--".$boundary."--".$passage_ligne;
            $message.= $passage_ligne."--".$boundary."--".$passage_ligne;


        // Envoi de l'e-mail.
            mail($email,$sujet,$message,$header);
*/

         


        //Redirection login.php
        header("Location: ../memberList.php?inc");


}else{
    header("Location: ../register.php?faux");
}
