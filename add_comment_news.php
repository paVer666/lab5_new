<?php
    session_start();
    require "conection.php";
    $text = $_POST['text'];
    $text = trim((filter_var($text,FILTER_SANITIZE_STRING)));
    $id_news = $_SESSION['pointer_news']['id'];
    $id_user = $_SESSION['user']['id'];
    $date = date('Y-m-d H:i:s');
    global $dbh;
    $query =  "INSERT INTO comment (id_news, id_user, text, date)
            VALUES (:id_review, :id_user, :text, :dats);";
    $params = [
        'id_review' => $id_news,
        'id_user' => $id_user,
        'text' => $text,
        'dats' => $date
    ];
    $sth = $dbh->prepare($query);
    $sth->execute($params);
    $values = [
        'status' => 1
    ];
    echo (json_encode($values));