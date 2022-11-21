<?php


class User{

    private int $id;
    private string $email;
    private string $password;


    public function getId() : int
    {
        return $this->id;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function setEmail(string $email)  : void
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new Exception("adresse mail non valide");
        }
        $this->email = $email;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function setPassword(string $password) : void
    {
        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $password)){
            throw new Exception("Le mot de passe doit contenir au moins 8 caractères dont une minuscule, une majuscule, un chiffre et un caractère spécial");
        }
        $this->password = password_hash($password, PASSWORD_ARGON2ID);
    }

    public function insert()
    {
        $db_config = parse_ini_file('config/db.ini');

        try {
            $pdo = new PDO(
                "mysql:host=".$db_config['db_host'].";dbname=".$db_config['db_name'],
                $db_config['db_user'],
                $db_config['db_password']
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }

        $stmt = $pdo->prepare("INSERT INTO user (`email`, `password`) VALUES (:email, :password)");
        $stmt->execute([
            'email' => $this->email,
            'password' => $this->password
        ]);

        unset($pdo);

    }

    public function isExisted()
    {
        $db_config = parse_ini_file('config/db.ini');

        try {
            $pdo = new PDO(
                "mysql:host=".$db_config['db_host'].";dbname=".$db_config['db_name'],
                $db_config['db_user'],
                $db_config['db_password']
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
            die;
        }
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute([
            'email' => $this->email
        ]);

        $count_user = $stmt->rowCount();

        return $count_user>0 ? true : false;
    }

}
