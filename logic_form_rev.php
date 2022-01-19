<?php
    session_start();
    require "conection.php";
    $name = $_POST['name'];
    $t_prev = $_POST['t_prev'];
    $t_main = $_POST['t_main'];
    $path = $_POST['path'];
    $dates = date('Y-m-d H:i:s');
    $name = trim((filter_var($name,FILTER_SANITIZE_STRING)));
    $t_prev = trim((filter_var($t_prev,FILTER_SANITIZE_STRING)));
    $t_main = trim((filter_var($t_main,FILTER_SANITIZE_STRING)));
    $file = $path;
    $new_file = 'img/posters/'.$_SESSION['dowland_img_rev']['file_name'];
    copy($file, $new_file); // делаем копию
    unlink($file); // удаляем оригинал
    global $dbh;
    $query =  "INSERT INTO review (id_user, name, picture, text_preview, text_main, date)
        VALUES (:id_user, :nm, :picture, :text_preview, :text_main, :dats);";
    $params = [
        'id_user' => $_SESSION['user']['id'],
        'nm' => $name,
        'picture' => $new_file,
        'text_preview' => $t_prev,
        'text_main' => $t_main,
        'dats' =>  $dates
    ];
// перемещение файла

    $sth = $dbh->prepare($query);
    $sth->execute($params);
    $id = $dbh->lastInsertId();
    $_SESSION['dowland_img_rev'] = [
        "status" => 1
    ];
    $_SESSION['pointer_review'] = [
        'id' =>$id,
        'status' => 1, // 1 - успех авторизации, 0 - беда
        'nick' => $_SESSION['user']['nik'],
        'film' =>  "Всем фильмам фильм",
        'name' =>  $name,
        'picture' =>  $path,
        'text_preview' =>  $t_prev,
        'text_main' => $t_main,
        'date' => $dates,
        'visit' =>  0
    ];
    $values = [
        'status' => 1
    ];
    echo (json_encode($values));