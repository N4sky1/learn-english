<?php
    /*define('USER', 'root');
    define('PASSWORD', '');
    define('HOST', 'localhost');
    define('DATABASE', 'english');*/
    $user = 'root';
    $pass = '';
    $host = 'localhost';
    $db = 'english';
    try {
        $connection = new PDO("mysql:host=".$host.";dbname=".$db, $user, $pass);
    } catch (PDOException $e) {
        exit("Error: " . $e->getMessage());
    }
?>