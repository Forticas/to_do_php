<?php

require_once 'partials/_check_is_not_logged.php';


if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password'])){

    

    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);


    require_once 'partials/_db_connect.php';

    $stmt = $pdo->prepare("SELECT * from user WHERE email = :email");
    $stmt->bindParam(':email', $email);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['errors'][] = "nous n'avons pas un compte avec cette adresse";
    }else{
        if(password_verify(htmlspecialchars($_POST['password']), $user['password'])){
            $_SESSION['user'] = [
                'is_logged' => TRUE,
                'email' => $user['email'],
                'id' => $user['id']
            ];

            header('Location: index.php');
            exit;
        }else{
            $_SESSION['errors'][] = "Le mot de passe est erroné";
        }
    }
    
}else{
    $_SESSION['errors'][] = "Tous les champs sont obligatoires";
}


require_once 'views/login.php'; 