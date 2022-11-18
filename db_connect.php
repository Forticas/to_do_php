<?php

$db_config = parse_ini_file('config/db.ini');

var_dump($db_config);die;
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