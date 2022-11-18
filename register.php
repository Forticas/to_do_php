<?php

require_once 'partials/_check_is_not_logged.php';


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
    if(!filter_var($secured_data['email'], FILTER_VALIDATE_EMAIL)){
        $_SESSION['errors'][] = "adresse mail non valide";
    }
    
    if(empty($_SESSION['errors']))    {
        //      2 - si ça existe dans la bdd
        require_once 'partials/_db_connect.php';

        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute([
            'email' => $secured_data['email']
        ]);

        $count_user = $stmt->rowCount();

        if ($count_user > 0 ) {
            $_SESSION['errors'][] = "cette adresse mail existe déjà";
        }
        
    }
    

    if(empty($_SESSION['errors']))    {
    // PWD

    //      1- les 2 pwd se correspondent 
        if($secured_data['password'] != $secured_data['password_repeat']){
            $_SESSION['errors'][] = "Les deux mots de passe ne correspondent pas";
        }
    //      2- vérifier la force du mot de passe 
      

        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $secured_data['password'])){
            $_SESSION['errors'][] = "Le mot de passe doit contenir au moins 8 caractères dont une minuscule, une majuscule, un chiffre et un caractère spécial";
        }
        
    }

        

    if(empty($_SESSION['errors']))    {
    // enregistrement dans la bdd
     
        $stmt2 =  $pdo->prepare("INSERT INTO user (email , `password`) VALUES (:email, :password)");
        $stmt2->execute([
            'email' => $secured_data['email'],
            'password' => password_hash($secured_data['password'], PASSWORD_ARGON2ID)
        ]);
    // fermer la cnx vers la bdd
        $pdo == null;
            // unset($pdo);
        // redirection vers la page login || ou bien s'authentifier directement
        header('Location: login.php');
        exit;
    }

        
    }

    
}

require_once 'views/register.php';