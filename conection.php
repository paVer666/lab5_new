<?php
    $array_info = parse_ini_file('config/parametrs.ini', true);
    $main_info = 'mysql:host='.$array_info['host'].';dbname='.$array_info['name'];
    $login = $array_info['login'];
    $password = $array_info['password'];
    $dbh = null;
    try
    {
        $dbh = new PDO($main_info, $login,  $password);
    }
    catch (PDOException $e)
    {
        print "Has errors: " . $e->getMessage(); die();
    }

