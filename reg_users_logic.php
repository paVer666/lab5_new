<?php
    session_start();
    require "conection.php";
    $login = $_POST['login'];
    $nick = $_POST['nick'];
    $mail = $_POST['mail'];
    $pass = $_POST['pass'];
    $phone = $_POST['phone'];
    global $dbh;
    $sth = $dbh->prepare("SELECT COUNT(*) as counts FROM users WHERE login = :login or mail = :mail");
    $sth->execute([
        'login' => $login,
        'mail' => $mail
    ]);

    $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    $sucs_inpt = 0;
    if($array[0]['counts'] == 0) {
        $sucs_inpt = 1;
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $query =  "INSERT INTO users (login, password, mail, phone, nickname, id_role)
    VALUES (:login, :password, :mail, :phone, :nick, 2);";
        $params = [
            'login' => $login,
            'password' => $hash,
            'mail' => $mail,
            'phone' => $phone,
            'nick' => $nick
        ];
        $sth = $dbh->prepare($query);
        $sth->execute($params);
        $id = $dbh->lastInsertId();
        //$info = $sth->errorInfo();
        $_SESSION['user'] = [
            "status" => $sucs_inpt,
            "id" => $id,
            "login" => $login,
            "password" => $hash,
            "phone" => $phone,
            "nik" => $nick,
            "mail" => $mail
        ];

    }


    $values = [
        'status' => $sucs_inpt, // 1 - успех авторизации, 0 - беда
        'login' => $login,
        'nick' => $nick,
        'mail' => $mail,
        'pass' => $pass,
        'phone' => $phone//,
       // 'info' => $info
    ];
    echo (json_encode($values));
