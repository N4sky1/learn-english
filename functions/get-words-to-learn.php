<?php
require_once('connect-for-users.php'); // передаем $connection

$data = $connection->prepare("SELECT `id` FROM `user` WHERE `username` = ?");
$data->execute(array($_SESSION['user_name']));
$array = $data->fetch(PDO::FETCH_ASSOC);


print_r($_SESSION['user_id']);