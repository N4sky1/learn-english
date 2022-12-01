<?php 
require_once './functions/download-to-bd.php'; 
require_once('./connect-for-users.php'); // передаем $connection


if (isset($_POST['download-word'])) {
    $eng = htmlspecialchars($_POST['eng']);
    $rus = htmlspecialchars($_POST['rus']);
    $transcr = htmlspecialchars($_POST['transcr']);
    $comment = htmlspecialchars($_POST['comment']);
    $example_rus = htmlspecialchars($_POST['example-rus']);
    $example_eng = htmlspecialchars($_POST['example-eng']);

   
    get_to_bd($connection, $eng, $rus, $transcr, $comment, $example_rus, $example_eng);
}
if (isset($_POST['download-file'])) {
    $id = '1d2khNGXt9bxaKrMD4eVyhoOzj15s2-L3sKeK6zcQBQ0';
    $gid = '0';
    
    $csv = file_get_contents('https://docs.google.com/spreadsheets/d/' . $id . '/export?format=csv&gid=' . $gid);
    $csv = explode("\r\n", $csv);
    $array = array_map('str_getcsv', $csv);

    foreach ($array as $element) {
        if ($element[0] && $element[1]) {
            $element[4] != "Пример рус" ? get_to_bd($connection, $element[0], $element[1], $element[2], $element[3], $element[4], $element[5]) : "";
        }
    }
}
?>