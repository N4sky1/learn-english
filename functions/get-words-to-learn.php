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
    $execute = array($_SESSION['user_id']);
    $array = connect_bd($request, $execute, false);
    shuffle($array);
    send_data($array);
}
if (isset($_POST['wordStrong'])) {
    update_strong_field($_POST['wordStrong'], false);
}
if (isset($_POST['wordLite'])) {
    update_strong_field($_POST['wordLite'], true);
}

function update_strong_field($word, $know) {
    //
    $request = "SELECT `strong`, `try` FROM `words` WHERE `Eng` = ?";
    $execute = array($word);
    $array = connect_bd($request, $execute, false);
    //send_data($array[0]);
    $strong = $array[0]['strong'];
    $try = $array[0]['try'];
    if ($try == null) $try = 0;
    
    if ($know && $strong == 1 && $try == 4)  {
        $strong = 0;
        $try = 0;
    };

    if ($know && $strong == 1 && $try <=3)  $try++;
    if (!$know && $strong == 1) $try = 0;
    if (!$know && !$strong) {
        $strong = 1;
        $try = 0;
    };
    echo $strong;
    echo $try;
    
    $request = "UPDATE `words` SET `strong` = :strong, `try` = :try WHERE `Eng` = :Eng";
    $execute = array('strong' => $strong, 'try' => $try, 'Eng' => $word);
    connect_bd($request, $execute, true);

}
function connect_bd($request, $execute, $update) {
    require('../connect-for-users.php'); // передаем $connection
    $data = $connection->prepare($request);
    $data->execute($execute);
    if (!$update) $array = $data->fetchAll(PDO::FETCH_ASSOC);
    if (!$update) return $array;
}
function send_data($array) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($array);
}


