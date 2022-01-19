<?php require "functions.php";  session_start();
if($_SESSION['user']['login'] == NULL){
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--   <meta name="viewport" content="width=1200"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style_form.css">
    <link rel="stylesheet" href="css/main_form.css">
        <link rel="stylesheet" href="css/header_style.css"/>
        <script src="js/scripts.js"></script>
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
                <div id="more_info_content" class="box info flex">
                    <form name="upload" action="download_img.php" method="POST" ENCTYPE="multipart/form-data">


                        <div class="info_img info_box">
                            <?php
                            if($_SESSION['dowland_img_rev']['status'] == 0 && $_SESSION['dowland_img_rev']['status'] !== null)  {
                                print (' <img id="path_img" class="info_avatar_img" src="'.$_SESSION['dowland_img_rev']['path'].'" alt="">');
                            }
                            else{
                                print ('<img class="info_avatar_img" src="img/avatars/squidward.jpg" alt="">');
                            }
                            ?>

                            <input type="file" name="userfile">
                            <input class="info_btn" type="submit" name="upload" class="info_btn" value="Сохранить">

                        </div>

                    </form>
                    <div class="info_text info_box">

                        <p class="large_text">Добавить Обзор</p>


                        <!-- Никнейм -->
                        <div class="info_text_box">
                            <p class="small_text">Обзор</p>
                            <input id="rev_name" class="info_input middle_text" maxlength="20" placeholder="Название обзора" type="text">
                        </div>
                        <!-- Пароль -->
                        <!-- Текущий пароль -->
                        <div class="info_text_box">
                            <p class="small_text">Превью текст</p>
                            <textarea class="info_input middle_text" name="" id="rev_t_prev" cols="" maxlength="100" rows="" placeholder="Текст для превью обзора"></textarea>
                        </div>
                        <div class="info_text_box">
                            <p class="small_text">Главный текст</p>
                            <textarea class="info_input middle_text" name="" id="rev_t_main" cols="50" rows="4"  placeholder="Текст для  обзора"></textarea>

                        </div>
                        <div class="help_code">
                        <?php
                        if($_SESSION['dowland_img_rev']['status'] == 0 && $_SESSION['dowland_img_rev']['status'] !== null) {
                            print (' <button onclick="scripts.js/rev_submit()" class="info_btn">Добавить</button>');
                        }
                        ?>

                        <a href="account.php" class="info_btn">Назад</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>