<?php
    session_start();
    if(!$d['role'] == 1 && !isset($_SESSION['email'])) {header('location: index.php?arn');}
    include('function.php');
    $pdo = connectDB();

    $saveId = $_POST['saveId'];
    $saveEmail = $_POST['saveEmail'];
    $q = "SELECT password FROM user WHERE email = ?";
    $req = $pdo->prepare($q);
    $req->execute([$saveEmail]);
    $pwd = $req->fetch();

    if (isset($saveId) && $saveId != 0) {
        $email = $saveEmail;
        $c_email = $_POST['email'];
        $c_pwd = $_POST['password'];
        $c_surname = $_POST['surname'];
        $c_name = $_POST['name'];
        $c_birth = $_POST['birthday'];
        $c_phone = $_POST['phoneNumber'];
        $c_droit = $_POST['droit'];
        $c_actif = $_POST['actif'];

        if (hash('sha256',$_POST['pwd_old']) == $pwd['password']) {
            funcPwd($pdo, $email, $c_pwd);
        }
        funcSurname($pdo, $email, $c_surname);
        funcName($pdo, $email, $c_name);
        funcImage($pdo, $email, $saveId);
        funcBirth($pdo, $email, $c_birth);
        funcPhone($pdo, $email, $c_phone);
        funcDroit($pdo, $email, $c_droit);
        funcActif($pdo, $email, $c_actif);
        funcEmail($pdo, $email, $c_email);

        header('location: ../memberList.php');
    } else {
        $email = $_SESSION['email'];
        $c_email = $_POST['email'];
        $c_pwd = $_POST['password'];
        $c_surname = $_POST['surname'];
        $c_name = $_POST['name'];
        $c_birth = $_POST['birthday'];
        $c_phone = $_POST['phoneNumber'];

        if (hash('sha256',$_POST['pwd_old']) == $pwd['password']) {
            funcPwd($pdo, $email, $c_pwd);
        }
        funcSurname($pdo, $email, $c_surname);
        funcName($pdo, $email, $c_name);
        funcImage($pdo, $email, $saveId);
        funcBirth($pdo, $email, $c_birth);
        funcPhone($pdo, $email, $c_phone);
        funcEmail($pdo, $email, $c_email);
        $_SESSION['email'] = $c_email;

        header('location: ../profile.php');
    }

    function funcEmail($pdo, $email, $c_email)
    {
        if (isset($_POST['email']))
        {
            $q = "UPDATE user SET email = :change WHERE email = :email";
            $req = $pdo->prepare($q);
            $req->execute(array(
                'change' => $c_email,
                'email' => $email
            ));
            $req->closeCursor();
        }
    }

    function funcPwd($pdo, $email, $c_pwd)
    {
        if (isset($_POST['password'])) {
            $q = "UPDATE user SET password = :change WHERE email = :email";
            $req = $pdo->prepare($q);
            $req->execute(array(
                'change' => hash("sha256",$c_pwd),
                'email' => $email
            ));
        }
    }

    function funcBirth($pdo, $email, $c_birth)
    {
        if (isset($_POST['birthday'])) {
            $q = "UPDATE user SET birthdate = :change WHERE email = :email";
            $req = $pdo->prepare($q);
            $req->execute(array(
                'change' => $c_birth,
                'email' => $email
            ));
        }
    }

    function funcSurname($pdo, $email, $c_surname)
    {
        if (isset($_POST['surname'])) {
            $q = "UPDATE user SET nom = :change WHERE email = :email";
            $req = $pdo->prepare($q);
            $req->execute(array(
                'change' => $c_surname,
                'email' => $email
            ));
        }
    }

    function funcName($pdo, $email, $c_name)
    {
        if (isset($_POST['name'])) {
            $q = "UPDATE user SET prenom = :change WHERE email = :email";
            $req = $pdo->prepare($q);
            $req->execute(array(
                'change' => $c_name,
                'email' => $email
            ));
        }
    }


    function funcDroit($pdo, $email, $c_droit)
    {
        if (isset($_POST['droit'])) {
            $q = "UPDATE user SET role = :change WHERE email = :email";
            $req = $pdo->prepare($q);
            $req->execute(array(
                'change' => $c_droit,
                'email' => $email
            ));
        }
    }

    function funcActif($pdo, $email, $c_actif)
    {
        if (isset($_POST['actif'])) {
            $q = "UPDATE user SET actif = :change WHERE email = :email";
            $req = $pdo->prepare($q);
            $req->execute(array(
                'change' => $c_actif,
                'email' => $email
            ));
        }
    }

    function funcPhone($pdo, $email, $c_phone)
    {
        if (isset($_POST['surname'])) {
            $q = "UPDATE user SET telephone = :change WHERE email = :email";
            $req = $pdo->prepare($q);
            $req->execute(array(
                'change' => $c_phone,
                'email' => $email
            ));
        }
    }

    function funcImage($pdo, $email, $saveId)
    {
        $acceptable = array(
            'image/jpeg',
            'image/jpg',
            'image/gif',
            'image/png'
        );

        if ((!in_array($_FILES['image']['type'], $acceptable)) && (!empty($_FILES["image"]["type"]))) {
            header("location: ../modifProfile.php?error=file_type&id=".$saveId);
            exit;
        };

        $maxsize = 2097152; // 2Mo
        if (($_FILES['image']['size'] > $maxsize)) {
            header("location: ../modifProfile.php?error=file_size&id=".$saveId);
            exit;
        };

        if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
            $q = "SELECT image FROM user WHERE email = ?";
            $req = $pdo->prepare($q);
            $req->execute([$email]);
            $img = $req->fetch();
            $temp_array = explode(".", $img['image']);
            $extension = end($temp_array);
            unlink('../profil/'.$email.'.'.$extension);

            //déterminer un chemin pour l'image
            $image_name = $email;
            $filename = $_FILES["image"]["name"];
            $temp_array = explode(".", $filename);
            $extension = end($temp_array);
            $chemin_image = '../profil/' . $image_name . '.' . $extension;
            $chemin_image2 = 'profil/' . $image_name . '.' . $extension;
            move_uploaded_file($_FILES["image"]["tmp_name"], $chemin_image);

            $q = "UPDATE user SET image = :change WHERE email = :email";
            $req = $pdo->prepare($q);
            $req->execute(array(
                'change' => $chemin_image2,
                'email' => $email
            ));
        }
    }


?>
