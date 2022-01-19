<?php
    session_start();
    require "conection.php";
    $id= $_POST['id'];
    global $dbh;

try {
    $sth_give = $dbh->prepare("SELECT * FROM news WHERE id_news = :id");
    $sth_give->execute( [
        'id' => $id
    ]);
    $array_res = $sth_give->fetchAll(PDO::FETCH_ASSOC);
    $query_get =  "UPDATE news SET visit = :visit WHERE id_news = :id";
    $params_get = [
        'visit' => $array_res[0]['visit'] + 1,
        'id' => $id
    ];
    $sth_get = $dbh->prepare($query_get);
    $sth_get->execute($params_get);
}catch (Exception $e){
    $info = $e->getMessage();
}

    $sth = $dbh->prepare("SELECT * FROM news WHERE id_news = :id ");
    $sth->execute([
        'id' => $id
    ]);
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    //$info = $sth->errorInfo();
    $sth_us = $dbh->prepare("SELECT * FROM users WHERE id_user = :id ");
    $sth_us->execute([
        'id' => $array[0]['id_user']
    ]);
    $array_us = $sth_us->fetchAll(PDO::FETCH_ASSOC);

    //$info_us = $sth_us->errorInfo();
    //$info_fl = $sth_fl->errorInfo();
    $_SESSION['pointer_news'] = [
        'id' => $id,
        'status' => 1, // 1 - успех авторизации, 0 - беда
        'nick' => $array_us[0]['nickname'],
        'name' =>  $array[0]['name'],
        'picture' =>  $array[0]['picture'],
        'text_preview' =>  $array[0]['text_preview'],
        'text_main' => $array[0]['text_main'],
        'date' =>  $array[0]['date'],
        'visit' =>  $array[0]['visit']
    ];
    $values = [
        'status' => 1, // 1 - успех авторизации, 0 - беда
        'nick' => $array_us[0]['nickname'],
        'name' =>  $array[0]['name'],
        'picture' =>  $array[0]['picture'],
        'text_preview' =>  $array[0]['text_preview'],
        'text_main' => $array[0]['text_main'],
        'date' =>  $array[0]['date'],
        'visit' =>  $array[0]['visit'],
        'info' => $info
    ];
    echo (json_encode($values));