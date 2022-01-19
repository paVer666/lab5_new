<?php
session_start();
require "conection.php";
global $dbh;
$query =  "UPDATE users SET date_last = :tims WHERE id_user = :id";
$params = [
    'tims' => date('Y-m-d H:i:s'),
    'id' => $_SESSION['user']['id']
];
$sth = $dbh->prepare($query);
$sth->execute($params);
$values = [
    'status' => date('Y-m-d H:i:s'), // 1 - успех авторизации, 0 - беда
];
unset($_SESSION['user']);
unset($_SESSION['pointer_review']);
unset($_SESSION['pointer_news']);
unset($_SESSION['dowland_img_rev']);// или $_SESSION = array() для очистки всех данных сессии
unset($_SESSION['dowland_img_news']);
session_destroy();
echo (json_encode($values));