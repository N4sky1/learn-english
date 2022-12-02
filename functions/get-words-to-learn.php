<?php
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}


if (isset($_POST['hard'])) {
    $hard = $_POST['hard'];

    function select($hard) {
        switch ($hard) {
            case "easy":
                return " AND `strong` = 0";
            case "hard":
                return " AND `strong` = 1";
            case "all":
                return false;
        }
    }

    $get_hard = select($hard);
    $request = "SELECT * FROM `words` WHERE `UserId` = ?" . ($get_hard ? $get_hard : "");
    //$lang = $_POST['lang'];
    //print_r($hard);
    require_once('../connect-for-users.php'); // передаем $connection
    
    $data = $connection->prepare($request);
    $data->execute(array($_SESSION['user_id']));
    $array = $data->fetchAll(PDO::FETCH_ASSOC);
    shuffle($array);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($array);
}

