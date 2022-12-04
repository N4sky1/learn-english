<?php
function connect_bd($request, $execute, $update) {
    require('connect-for-users.php'); // передаем $connection
    $data = $connection->prepare($request);
    $data->execute($execute);
    if (!$update) $array = $data->fetchAll(PDO::FETCH_ASSOC);
    if (!$update) return $array;
}