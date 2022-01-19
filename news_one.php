<?php require "functions.php";  session_start();
if($_SESSION['pointer_news']['name'] == NULL){
    header('Location: index.php');
}
?>
<!DOCTYP
<!DOCTYPE html>
<html lang="en">
    <head>
    
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--   <meta name="viewport" content="width=1200"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style_film.css">
    <link rel="stylesheet" href="css/main_film.css">
        <link rel="stylesheet" href="css/header_style.css"/>
      <title>Shamy</title> 
    </head>
<body>
<?php
require_once 'header.php';
?>
    <section>
        <header>

        </header>
    </section>
    <section>
        <div class="container">
                <!-- Кнопка Избранное -->
                <div class="library">
                    <!-- Обзор 1 -->
                    <div class="film_content_place">
                        <?php
                        print ('
                        <img class="library_poster" src="'.$_SESSION['pointer_news']['picture'].'" alt="">
                        <div class="library_content_place_text">
                            <p class="library_content_place_name_text large_text">'.$_SESSION['pointer_news']['name'].'</p>
                            <p class="library_text middle_text">Описание :</p>
                            <p class="roboto library_text review gray_text">'.$_SESSION['pointer_news']['text_preview'].'</p>
                            <p class="roboto library_text review gray_text">'.$_SESSION['pointer_news']['text_main'].'</p>
                            <p class="library_text middle_text">Автор :</p>
                            <p class="roboto library_text review gray_text">'.$_SESSION['pointer_news']['nick'].'</p>
                            <p class="library_text middle_text">Дата создания :</p>
                            <p class="roboto library_text review gray_text">'.$_SESSION['pointer_news']['date'].'</p>
                            <p class="library_text middle_text">Просмотров :</p>
                            <p class="roboto library_text review gray_text">'.$_SESSION['pointer_news']['visit'].'</p>
                        </div>
                        ');
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div>
            <?php
            if($_SESSION['user']['login'] !== NULL){
                print ('
                <button class="info_btn" id="commnet_btn" style="margin-bottom: 50px;">Оставить комментарий</button>
                ');
            }
            ?>

        </div>
    </section>
    <section id="comment" style="display: flex;">
        <div class="container">
                <!-- Кнопка Избранное -->
                <div   class="library">
                    <!-- Обзор 1 -->


                    <?php
                    $comment = conectDB_comment_news($_SESSION['pointer_news']['id']);
                    for ($i=0; $i < count($comment); $i++) {
                        $id = $comment[$i]['id_user'];
                        $text = $comment[$i]['text'];
                        $date = $comment[$i]['date'];
                        $id_review = $comment[$i]['id_review'];
                        print('
                      <div class="library_content_place">
                        <div class="library_content_place_text">
                            <p class="library_content_place_name_text large_text">комментарий</p>
                            <p class="library_text middle_text">Комментарий :</p>
                            <p class="roboto library_text review gray_text">'.$text.'</p>
                            <div class="accaunt_container_info" style="margin-bottom: 30px;">
                                <div>
                                    <p class="library_text middle_text">Автор :</p>
                                    <a href="#"><p class="roboto library_text review gray_text">'.get_nick($id).'</p></a>
                                </div>
                                <div>
                                    <p class="library_text middle_text">Дата :</p>
                                    <a href="#"><p class="roboto library_text review gray_text">'.$date.'</p></a>
                                </div>
                            </div>
                        </div>
                    </div>
                      ');
                    }
                    ?>




                </div>

            </div>

    </section>
    <section>
        <div class="container">
            <!-- Кнопка Избранное -->
            <div id="comment_taker"  class="library" style="display: none;">
                <!-- Обзор 1 -->
                <div class="library_content_place">
                    <div class="library_content_place_text">
                        <p class="library_content_place_name_text large_text">Никнейм пользователя</p>
                        <p class="library_text middle_text">Ваш комментарий :</p>
                        <textarea class="info_input middle_text" id="text_comment" cols="" placeholder="Начало вышего великолепного комментария^~^" rows="4"></textarea>
                        <div class="accaunt_container_info">
                            <button id="stop_btn" class="info_btn" style="margin-bottom: 50px;">Отмена</button>
                            <button class="info_btn" onclick="scripts.js/insert_comment_news()" style="margin-bottom: 50px;">Отправить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/scripts_film.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>