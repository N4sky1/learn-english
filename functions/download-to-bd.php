<?php
require_once 'connect-bd.php'; 
require_once 'get_count_words.php';
function get_to_bd($connection, $eng, $rus, $transcr, $comment, $example_rus, $example_eng) {
    

    if (chek_data($eng, $connection)) {
        echo "<span>" . $eng. " - Это слово уже есть в словаре </span>";
        return;
    }
    

    $data = $connection->prepare(
        "INSERT INTO `words` SET 
        `UserId` = :UserId,
        `Eng` = :Eng, 
        `Rus` = :Rus, 
        `Transcription` = :Transcription, 
        `Comment` = :Comment,
        `ExampleRus` = :ExampleRus,
        `ExampleEng` = :ExampleEng"
        );

    $data->execute(array(
        'UserId' => $_SESSION['user_id'], 
        'Eng' =>  $eng, 
        'Rus' => $rus,
        'Transcription' => $transcr, 
        'Comment' => $comment,
        'ExampleRus' => $example_rus,
        'ExampleEng' => $example_eng
    )); 

    $info = $data->errorInfo();
    if($info[1] > 0) {
        print_r($info[2]);
        return;
    };
    echo "<p> загрузка прошла успешно</p>";
    get_count_words();
} 

function chek_data($eng, $connection) {
    $check_data = $connection->prepare("SELECT `Eng` FROM `words` WHERE `UserId` = :UserId AND `Eng` = :Eng");
    $check_data->execute(array('UserId' => $_SESSION['user_id'], 'Eng' => $eng));
    $array = $check_data->fetch(PDO::FETCH_ASSOC);
    if ($array) return true;
}

