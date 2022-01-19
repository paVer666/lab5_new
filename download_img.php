<?php
session_start();
cleanDir('img/dowland');
$uploaddir = 'img/dowland/';
// это папка, в которую будет загружаться картинка
$apend=date('YmdHis').rand(100,1000).'.jpg';
// это имя, которое будет присвоенно изображению
$uploadfile = "$uploaddir$apend";
//в переменную $uploadfile будет входить папка и имя изображения

// В данной строке самое важное - проверяем загружается ли изображение (а может вредоносный код?)
// И проходит ли изображение по весу. В нашем случае до 512 Кб
if(($_FILES['userfile']['type'] == 'image/gif' || $_FILES['userfile']['type'] == 'image/jpeg' || $_FILES['userfile']['type'] == 'image/png') && ($_FILES['userfile']['size'] != 0 and $_FILES['userfile']['size']<=1024000))
{
// Указываем максимальный вес загружаемого файла. Сейчас до 512 Кб
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))
    {
        //Здесь идет процесс загрузки изображения
        $size = getimagesize($uploadfile);
        // с помощью этой функции мы можем получить размер пикселей изображения
        if ($size[0] < 8000 && $size[1]<4000)
        {

            // если размер изображения не более 500 пикселей по ширине и не более 1500 по  высоте
            $_SESSION['dowland_img_rev'] = [
                "status" => 0,
                "path" => $uploadfile,
                "file_name" => $apend
            ];
            header('Location:form_rev.php');
        } else {
            $_SESSION['dowland_img_rev'] = [
                "status" => 1
            ];
            unlink($uploadfile);
            // удаление файла
            header('Location:form_rev.php');
        }
    } else {
        echo "Файл не загружен, вернитеcь и попробуйте еще раз";
    }
} else {
    echo "Размер файла не должен превышать 512Кб";
}
function cleanDir($dir) {
    $files = glob($dir."/*");
    $c = count($files);
    if (count($files) > 0) {
        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }
}