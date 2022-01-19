<?php
	require "conection.php";
	$main_review = 0;
	function coonectDB_news()
	{
		global $dbh;
		$sth = $dbh->prepare("SELECT *, (SELECT COUNT(*) FROM comment WHERE comment.id_news = news.id_news) AS counts FROM news ORDER BY date DESC LIMIT 4");
		$sth->execute();
		$array = $sth->fetchAll(PDO::FETCH_ASSOC);
		return ($array);			
	}
	function coonectDB_reviews_new()
	{
		global $dbh;
		$sth = $dbh->prepare("SELECT *, (SELECT COUNT(*) FROM comment WHERE comment.id_review = review.id_review) AS counts FROM review ORDER BY date DESC LIMIT 10");
		$sth->execute();
		$array = $sth->fetchAll(PDO::FETCH_ASSOC);
		return ($array);
	}
	function coonectDB_reviews_besr_com()
	{
		global $dbh;
		$sth = $dbh->prepare("SELECT *, (SELECT COUNT(*) FROM comment WHERE comment.id_review = review.id_review) AS counts FROM review  ORDER BY counts DESC LIMIT 10");
		$sth->execute();
		$array = $sth->fetchAll(PDO::FETCH_ASSOC);
		return ($array);
	}
	function coonectDB_reviews_besr_all()
	{
		global $dbh;
		$sth = $dbh->prepare("SELECT *, (SELECT COUNT(*) FROM comment WHERE comment.id_review = review.id_review) AS counts FROM review  ORDER BY (visit + counts) DESC LIMIT 10");
		$sth->execute();
		$array = $sth->fetchAll(PDO::FETCH_ASSOC);
		return ($array);
	}
	function coonectDB_reviews_rec()
	{
		global $dbh;
		$sth = $dbh->prepare("SELECT *, (SELECT COUNT(*) AS counts FROM comment WHERE comment.id_review = review.id_review) AS counts FROM review ORDER BY id_review DESC LIMIT 4");
		$sth->execute();
		$array = $sth->fetchAll(PDO::FETCH_ASSOC);
		return ($array);
	}
    function coonectDB_reviews_best()
    {
        global $dbh;
        $sth = $dbh->prepare("SELECT *, (SELECT COUNT(*) AS counts FROM comment WHERE comment.id_review = review.id_review) AS counts FROM review  ORDER BY (visit + counts) DESC LIMIT 3");
        $sth->execute();
        $array = $sth->fetchAll(PDO::FETCH_ASSOC);
        return ($array);
    }
    function connectDB_lk_info($user_login)
    {
        global $dbh;
        $sth = $dbh->prepare("SELECT  id_user  FROM users WHERE login = :login");
        $sth->execute( [
            'login' => $user_login
        ]);
        $array_review = $sth->fetchAll(PDO::FETCH_ASSOC);
        $user_id = $array_review[0]['id_user'];
        $sth = $dbh->prepare("SELECT   COUNT(*) AS counts  FROM review WHERE id_user = :id");
        $sth->execute( [
            'id' => $user_id
        ]);
        $array_review = $sth->fetchAll(PDO::FETCH_ASSOC);
        $sth = $dbh->prepare("SELECT   COUNT(*) AS counts FROM news WHERE id_user = :id");
        $sth->execute( [
            'id' => $user_id
        ]);
        $array_news = $sth->fetchAll(PDO::FETCH_ASSOC);
        $sth = $dbh->prepare("SELECT   COUNT(*) AS counts FROM comment WHERE id_user = :id");
        $sth->execute( [
            'id' => $user_id
        ]);
        $array_comment = $sth->fetchAll(PDO::FETCH_ASSOC);
        $array = [$array_review[0]['counts'], $array_news[0]['counts'], $array_comment[0]['counts']];
        return ($array);
    }

    function conncetDB_lk_rev($user_login){
        global $dbh;
        $sth = $dbh->prepare("SELECT  id_user  FROM users WHERE login = :login");
        $sth->execute( [
            'login' => $user_login
        ]);
        $array= $sth->fetchAll(PDO::FETCH_ASSOC);
        $user_id = $array[0]['id_user'];
        $sth = $dbh->prepare("SELECT *  FROM review WHERE id_user = :id");
        $sth->execute( [
            'id' => $user_id
        ]);
        $array_res = $sth->fetchAll(PDO::FETCH_ASSOC);
        return ($array_res);
    }
    function conncetDB_lk_news($user_login){
        global $dbh;
        $sth = $dbh->prepare("SELECT  id_user  FROM users WHERE login = :login");
        $sth->execute( [
            'login' => $user_login
        ]);
        $array= $sth->fetchAll(PDO::FETCH_ASSOC);
        $user_id = $array[0]['id_user'];
        $sth = $dbh->prepare("SELECT *  FROM news WHERE id_user = :id");
        $sth->execute( [
            'id' => $user_id
        ]);
        $array_res = $sth->fetchAll(PDO::FETCH_ASSOC);
        return ($array_res);
    }
    function conectDB_comment($id)
    {
        global $dbh;
        $sth = $dbh->prepare("SELECT * FROM comment WHERE id_review = :id ORDER BY date DESC");
        $sth->execute( [
            'id' => $id
        ]);
        $array = $sth->fetchAll(PDO::FETCH_ASSOC);
        return ($array);
    }
    function conectDB_comment_news($id)
    {
        global $dbh;
        $sth = $dbh->prepare("SELECT * FROM comment WHERE id_news = :id ORDER BY date DESC");
        $sth->execute( [
            'id' => $id
        ]);
        $array = $sth->fetchAll(PDO::FETCH_ASSOC);
        return ($array);
    }
    function get_nick($id)
    {
        global $dbh;
        $sth = $dbh->prepare("SELECT nickname FROM users WHERE id_user = :id");
        $sth->execute( [
            'id' => $id
        ]);
        $array = $sth->fetchAll(PDO::FETCH_ASSOC);
        return ($array[0]['nickname']);
    }
    function rev_catalog(){
        global $dbh;
        $sth = $dbh->prepare("SELECT *  FROM review ORDER BY date DESC");
        $sth->execute();
        $array_res = $sth->fetchAll(PDO::FETCH_ASSOC);
        return ($array_res);
    }
    function news_catalog(){
        global $dbh;
        $sth = $dbh->prepare("SELECT *  FROM news ORDER BY date DESC");
        $sth->execute();
        $array_res = $sth->fetchAll(PDO::FETCH_ASSOC);
        return ($array_res);
    }
