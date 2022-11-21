<?php


require_once 'partials/_check_is_not_logged.php';
require_once 'models/User.php';

if(isset($_POST['submit'])){



    require_once 'partials/_start_session.php';
    // vérification de la présence des datas dans tous les champs
    if(empty($_POST['email']) || empty($_POST['password']) || empty($_POST['password_repeat'])){
        $_SESSION['errors'][] = "veuillez remplir tous les champs";
        
    }else{
    // vérifier l'adresse mail 
    $secured_data = [
        'email' => htmlspecialchars($_POST['email']),
        'password' => htmlspecialchars($_POST['password']),
        'password_repeat' => htmlspecialchars($_POST['password_repeat'])
    ];
    
 
    //      1- vérifier la structure de l'adresse mail
    try {
        $user = new User();
        $user->setEmail($secured_data['email']);
        $user->setPassword($secured_data['password']);
    } catch (Exception $e) {
        var_dump($e->getMessage()); die;
        $_SESSION['errors'] = $e->getMessage();
    }
    
    if(empty($_SESSION['errors']))    {
       
        if ($user->isExisted()) {
            $_SESSION['errors'][] = "cette adresse mail existe déjà";
        }
        
    }

    if(empty($_SESSION['errors']))    {

        if($secured_data['password'] != $secured_data['password_repeat']){
            $_SESSION['errors'][] = "Les deux mots de passe ne correspondent pas";
        }   
        
    }

    
    if(empty($_SESSION['errors']))    {
    
        $user->insert();
        header('Location: login.php');
        exit;
    }

        
    }

    
}

require_once 'views/register.php'; 