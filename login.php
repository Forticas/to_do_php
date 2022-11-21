<?php

require_once 'partials/_check_is_not_logged.php';
require_once 'models/User.php';

if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password'])){

    

    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    
  
    $user = User::findOneByEmail($email);

    var_dump($user); die;

    if (!$user) {
        $_SESSION['errors'][] = "nous n'avons pas un compte avec cette adresse";
    }else{
        if(password_verify(htmlspecialchars($_POST['password']), $user->getPassword())){
            $_SESSION['user'] = [
                'is_logged' => TRUE,
                'email' => $user->getEmail(),
                'id' => $user->getId()
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