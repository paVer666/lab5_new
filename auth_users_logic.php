<?php
session_start();
require "conection.php";
$login = $_POST['login'];
$pass = $_POST['pass'];

global $dbh;
$sucs_inpt = 0;
$sth = $dbh->prepare("SELECT * FROM users WHERE login = :login ");
$sth->execute([
    'login' => $login
]);
$array = $sth->fetchAll(PDO::FETCH_ASSOC);
if (password_verify($pass, $array[0]['password'])) {
    $sucs_inpt = 1;
}
else {
    $sucs_inpt = 0;
}



//$sth = $dbh->prepare("SELECT COUNT(*) as counts FROM users WHERE login = :login AND password = :pass");
//$sth->execute([
//    'login' => $login,
//    'pass' => $pass
//]);


//$array = $sth->fetchAll(PDO::FETCH_ASSOC);
if($sucs_inpt){
    $sth = $dbh->prepare("SELECT * FROM users WHERE login = :login");
    $sth->execute([
        'login' => $login
    ]);
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['user'] = [
        "status" => $sucs_inpt,
        "id" => $array[0]['id_user'],
        "login" => $login,
        "password" => $pass,
        "phone" => $array[0]['phone'],
        "nik" => $array[0]['nickname'],
        "mail" => $array[0]['mail']
    ];
}

$values = [
    'status' => $sucs_inpt, // 1 - успех авторизации, 0 - беда
    'login' => $login,
    'pass' => $pass
];
echo (json_encode($values));