<?php
    session_start();
    require "conection.php";
    $id= $_POST['id'];
    global $dbh;
try {
    $sth_give = $dbh->prepare("SELECT * FROM review WHERE id_review = :id");
    $sth_give->execute( [
        'id' => $id
    ]);
    $array_res = $sth_give->fetchAll(PDO::FETCH_ASSOC);
    $query_get =  "UPDATE review SET visit = :visit WHERE id_review = :id";
    $params_get = [
        'visit' => $array_res[0]['visit'] + 1,
        'id' => $id
    ];
    $sth_get = $dbh->prepare($query_get);
    $sth_get->execute($params_get);
}catch (Exception $e){
    $info = $e->getMessage();
}
    $sth = $dbh->prepare("SELECT * FROM review WHERE id_review = :id ");
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
    $sth_fl = $dbh->prepare("SELECT * FROM film WHERE id_film = :id ");
    $sth_fl->execute([
        'id' => $array[0]['id_film']
    ]);
    $array_fl = $sth_fl->fetchAll(PDO::FETCH_ASSOC);
    //$info_fl = $sth_fl->errorInfo();
    $_SESSION['pointer_review'] = [
        'id' => $id,
        'status' => 1, // 1 - успех авторизации, 0 - беда
        'nick' => $array_us[0]['nickname'],
        'film' =>  $array_fl[0]['name'],
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
        'film' =>  $array_fl[0]['name'],
        'name' =>  $array[0]['name'],
        'picture' =>  $array[0]['picture'],
        'text_preview' =>  $array[0]['text_preview'],
        'text_main' => $array[0]['text_main'],
        'date' =>  $array[0]['date'],
        'visit' =>  $array[0]['visit']//,
        //'info' => $info
    ];
    echo (json_encode($values));