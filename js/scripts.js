// Кнопки фильтра
var catalog_btn_1 = document.getElementById('catalog_btn_1');
var catalog_btn_2 = document.getElementById('catalog_btn_2');
var catalog_btn_3 = document.getElementById('catalog_btn_3');
var catalog_btn_4 = document.getElementById('catalog_btn_4');

try{
    catalog_btn_1.onclick = change_catalog_active_btn_1;
    catalog_btn_2.onclick = change_catalog_active_btn_2;
    catalog_btn_3.onclick = change_catalog_active_btn_3;
    catalog_btn_4.onclick = change_catalog_active_btn_4;
}catch (err){

}




$('#reg_chbox').on('click', function () {
    if ( $(this).is(':checked') ) {
        document.getElementById('reg_btn').style.display = "block";
    } else {
        document.getElementById('reg_btn').style.display = "none";
    }
})
function change_catalog_active_btn_1()
{
      document.getElementById('catalog_btn_1').classList.add('catalog_btn_active');
      document.getElementById('catalog_btn_2').classList.remove('catalog_btn_active');
      document.getElementById('catalog_btn_3').classList.remove('catalog_btn_active');
      document.getElementById('catalog_btn_4').classList.remove('catalog_btn_active');
      show_all();
}
function change_catalog_active_btn_2()
{
      document.getElementById('catalog_btn_1').classList.remove('catalog_btn_active');
      document.getElementById('catalog_btn_2').classList.add('catalog_btn_active');
      document.getElementById('catalog_btn_3').classList.remove('catalog_btn_active');
      document.getElementById('catalog_btn_4').classList.remove('catalog_btn_active');
      show_new();
}
function change_catalog_active_btn_3()
{
      document.getElementById('catalog_btn_1').classList.remove('catalog_btn_active');
      document.getElementById('catalog_btn_2').classList.remove('catalog_btn_active');
      document.getElementById('catalog_btn_3').classList.add('catalog_btn_active');
      document.getElementById('catalog_btn_4').classList.remove('catalog_btn_active');
      show_best_com();
}

function change_catalog_active_btn_4()
{
      document.getElementById('catalog_btn_1').classList.remove('catalog_btn_active');
      document.getElementById('catalog_btn_2').classList.remove('catalog_btn_active');
      document.getElementById('catalog_btn_3').classList.remove('catalog_btn_active');
      document.getElementById('catalog_btn_4').classList.add('catalog_btn_active');
      show_best_all();
}

function show_all(){
      document.getElementById('new').style.display = "block";
      document.getElementById('best_com').style.display = "block";
      document.getElementById('best_all').style.display = "block";
}

function show_new(){
      document.getElementById('new').style.display = "block";
      document.getElementById('best_com').style.display = "none";
      document.getElementById('best_all').style.display = "none";
}
function show_best_com(){
      document.getElementById('new').style.display = "none";
      document.getElementById('best_com').style.display = "block";
      document.getElementById('best_all').style.display = "none";
}
function show_best_all(){
      document.getElementById('new').style.display = "none";
      document.getElementById('best_com').style.display = "none";
      document.getElementById('best_all').style.display = "block";
}
function show(state)
{
      document.getElementById('window_reg_auth').style.display = state;
      document.getElementById('gray_mask').style.display = state;
}
// Кнопки фильтра
// Кнопки хедера
function show_auth(state)
{
      document.getElementById('window_auth_reg').style.display = state;
      document.getElementById('gray_mask').style.display = state;
}

function show_laptop_menu(state)
{
      document.getElementById('header_laptop_menu').style.display = state;
      document.getElementById('gray_mask').style.display = state;
}

// Кнопки хедера
// Скроллы
jQuery(document).ready(function($) {
      $('#review_scroll_new').lightSlider({
            //auto:true,
            autoWidth:true,
            loop:true,
            onSliderLoad: function() {
                $('#review_scroll_new').removeClass('cS-hidden');
            }
        });

});
jQuery(document).ready(function($) {
      $('#review_scroll_best_com').lightSlider({
            //auto:true,
            autoWidth:true,
            loop:true,
            onSliderLoad: function() {
                  $('#review_scroll_best_com').removeClass('cS-hidden');
            }
      });

});

jQuery(document).ready(function($) {
      $('#review_scroll_best_all').lightSlider({
            //auto:true,
            autoWidth:true,
            loop:true,
            onSliderLoad: function() {
                  $('#review_scroll_best_all').removeClass('cS-hidden');
            }
      });

});


jQuery(document).ready(function($) {
      $('#autoWidth').lightSlider({

            autoWidth:true,
            loop:true,
            onSliderLoad: function() {
                $('#autoWidth').removeClass('cS-hidden');
            }
        });

});


jQuery(document).ready(function($) {
      $('#laptop_scroll').lightSlider({
            auto:true,
            autoWidth:true,
            loop:true,
            onSliderLoad: function() {
                $('#laptop_scroll').removeClass('cS-hidden');
            }
        });

});

// Скроллы
// Функции
function auth_user(){
       document.getElementById('auth_login').style.background = "rgb(255, 255, 255)";
       document.getElementById('auth_password').style.background = "rgb(255, 255, 255)";
    document.getElementById('error_login_auth').style.display = "none";
    document.getElementById('error_password_auth').style.display = "none";
       var login = document.getElementById('auth_login').value.trim();
       var password = document.getElementById('auth_password').value.trim();
       if(login == ""){
             document.getElementById('auth_login').style.background = "rgb(255, 199, 199)";
           document.getElementById('error_login_auth').style.display = "block";
           document.getElementById('error_login_auth').textContent = "Данное поле обязательно для заполнения";
       }
       if(password == ""){
             document.getElementById('auth_password').style.background = "rgb(255, 199, 199)";
           document.getElementById('error_password_auth').style.display = "block";
           document.getElementById('error_password_auth').textContent = "Данное поле обязательно для заполнения";
       }else{
             $.ajax({
                   url: '/auth_users_logic.php',
                   type: 'POST',
                   dataType: 'json',
                   data: {
                         login: login,
                         pass: password
                   },
                   success(data) {
                         if (data['status']) {
                                window.location.href = 'account.php';
                               //console.log("Успех авторизации") ;
                         }
                         if (!data['status']) {
                             //console.log("Ошибка авторизации");
                             document.getElementById('auth_login').style.background = "rgb(255, 199, 199)";
                             document.getElementById('error_login_auth').style.display = "block";
                             document.getElementById('error_login_auth').textContent = "Неверный логин или пароль";
                             document.getElementById('auth_password').style.background = "rgb(255, 199, 199)";
                         }
                   }
             });
       }
}
function out_user(){
    $.ajax({

        url: '/out_users_logic.php',
        type: 'POST'
        ,
        success(data) {

            window.location.href = 'index.php';
        }
    });
}



function reg_user() {
    document.getElementById('reg_login').style.background = "rgb(255, 255, 255)";
    document.getElementById('reg_nick').style.background = "rgb(255, 255, 255)";
    document.getElementById('reg_mail').style.background = "rgb(255, 255, 255)";
    document.getElementById('reg_pass_1').style.background = "rgb(255, 255, 255)";
    document.getElementById('reg_pass_2').style.background = "rgb(255, 255, 255)";
    document.getElementById('reg_phone').style.background = "rgb(255, 255, 255)";
    document.getElementById('error_login').style.display = "none";
    document.getElementById('error_nick').style.display = "none";
    document.getElementById('error_mail').style.display = "none";
    document.getElementById('error_pass').style.display = "none";


    var login = document.getElementById('reg_login').value.trim();
    var nick = document.getElementById('reg_nick').value.trim();
    var mail = document.getElementById('reg_mail').value.trim();
    var pass_1 = document.getElementById('reg_pass_1').value.trim();
    var pass_2 = document.getElementById('reg_pass_2').value.trim();
    var phone = document.getElementById('reg_phone').value.trim();
    var chbox = document.getElementById('reg_chbox');


    var re = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
    var cheked_mail = mail;
    var valid = re.test(cheked_mail);
    var phone_dispatch = "-";
    if (chbox.checked) {
        if (valid && login !== "" && nick !== "" &&
            pass_1 == pass_2 && pass_1 !== "") {
            if (phone !== "") {
                phone_dispatch = phone;
            }
            $.ajax({

                url: '/reg_users_logic.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    login: login,
                    nick: nick,
                    mail: mail,
                    pass: pass_1,
                    phone: phone_dispatch
                },
                success(data) {
                    if (data['status']) {
                        console.log("Пользователь успешно добавлен");
                        // console.log(data['info']);
                        window.location.href = 'account.php';
                    }
                    if (!data['status']) {
                        //console.log("Ошибка регистрации");
                        document.getElementById('reg_login').style.background = "rgb(255, 199, 199)";
                        document.getElementById('error_login').style.display = "block";
                        document.getElementById('error_login').textContent = "Данный логин возможно занят";
                        document.getElementById('reg_mail').style.background = "rgb(255, 199, 199)";
                        document.getElementById('error_mail').style.display = "block";
                        document.getElementById('error_mail').textContent = "Данная почта возможно занята";
                    }
                }
            });
        }
        else{
            if (login == "") {
                document.getElementById('reg_login').style.background = "rgb(255, 199, 199)";
                document.getElementById('error_login').style.display = "block";
                document.getElementById('error_login').textContent = "Данное поле обязательно для заполнения";
            }
            if (nick == "") {
                document.getElementById('reg_nick').style.background = "rgb(255, 199, 199)";
                document.getElementById('error_nick').style.display = "block";
                document.getElementById('error_nick').textContent = "Данное поле обязательно для заполнения";
            }
            if (!valid) {
                document.getElementById('reg_mail').style.background = "rgb(255, 199, 199)";
                document.getElementById('error_mail').style.display = "block";
                document.getElementById('error_mail').textContent = "Образец почты: sample@mail.ru";
            }
            if (pass_1 !== pass_2 || (pass_1 == "" || pass_1 == "")) {
                document.getElementById('reg_pass_1').style.background = "rgb(255, 199, 199)";
                document.getElementById('reg_pass_2').style.background = "rgb(255, 199, 199)";
                document.getElementById('error_pass').style.display = "block";
                document.getElementById('error_pass').textContent = "Пароли не совпадают";
            }

        }
    }
}


function rev_submit()
{
    name = document.getElementById('rev_name').value.trim();
    t_prev = document.getElementById('rev_t_prev').value.trim();
    t_main = document.getElementById('rev_t_main').value.trim();
    path = document.getElementById('path_img').getAttribute("src");
    // console.log(name);
    // console.log(t_prev);
    // console.log(t_main);
    // console.log(path);
    if(name!=="" && t_prev!=="" && t_main !== "")
    {
        $.ajax({
            url: '/logic_form_rev.php',
            type: 'POST',
            dataType: 'json',
            data: {
                name: name,
                t_prev: t_prev,
                t_main: t_main,
                path: path
            },
            success(data) {
                if (data['status']) {
                    window.location.href = 'rev_one.php';
                    // console.log(data['nick']) ;
                    // console.log(data['film']) ;
                    // console.log(data['name']) ;
                    // console.log(data['picture']) ;
                    // console.log(data['text_preview']) ;
                    // console.log(data['text_main']) ;
                    // console.log(data['date']) ;
                    // console.log(data['visit']) ;
                    // console.log(data['visit']) ;
                    //console.log(data['info']) ;
                }
                if (!data['status']) {
                    console.log("Ошибка выгрузки информации");
                }
            }
        });
    }

}
function rev_submit_news()
{
    name = document.getElementById('news_name').value.trim();
    t_prev = document.getElementById('news_t_prev').value.trim();
    t_main = document.getElementById('news_t_main').value.trim();
    path = document.getElementById('path_img').getAttribute("src");
    // console.log(name);
    // console.log(t_prev);
    // console.log(t_main);
    // console.log(path);
    if(name!=="" && t_prev!=="" && t_main !== "")
    {
        $.ajax({
            url: '/logic_form_news.php',
            type: 'POST',
            dataType: 'json',
            data: {
                name: name,
                t_prev: t_prev,
                t_main: t_main,
                path: path
            },
            success(data) {
                if (data['status']) {
                    window.location.href = 'news_one.php';
                    // console.log(data['nick']) ;
                    // console.log(data['film']) ;
                    // console.log(data['name']) ;
                    // console.log(data['picture']) ;
                    // console.log(data['text_preview']) ;
                    // console.log(data['text_main']) ;
                    // console.log(data['date']) ;
                    // console.log(data['visit']) ;
                    // console.log(data['visit']) ;
                    //console.log(data['info']) ;
                }
                if (!data['status']) {
                    console.log("Ошибка выгрузки информации");
                }
            }
        });
    }

}
function insert_comment () {
    text = document.getElementById('text_comment').value.trim();
    if (text !== "") {
        $.ajax({
            url: '/add_comment.php',
            type: 'POST',
            dataType: 'json',
            data: {
                text: text
            },
            success(data) {
                if (data['status']) {
                    window.location.href = 'rev_one.php';
                    // console.log(data['nick']) ;
                    // console.log(data['film']) ;
                    // console.log(data['name']) ;
                    // console.log(data['picture']) ;
                    // console.log(data['text_preview']) ;
                    // console.log(data['text_main']) ;
                    // console.log(data['date']) ;
                    // console.log(data['visit']) ;
                    // console.log(data['visit']) ;
                    //console.log(data['info']) ;
                }
                if (!data['status']) {
                    console.log("Ошибка выгрузки информации");
                }
            }
        });
    }

}
function insert_comment_news () {
    text = document.getElementById('text_comment').value.trim();
    if (text !== "") {
        $.ajax({
            url: '/add_comment_news.php',
            type: 'POST',
            dataType: 'json',
            data: {
                text: text
            },
            success(data) {
                if (data['status']) {
                    window.location.href = 'news_one.php';
                    // console.log(data['nick']) ;
                    // console.log(data['film']) ;
                    // console.log(data['name']) ;
                    // console.log(data['picture']) ;
                    // console.log(data['text_preview']) ;
                    // console.log(data['text_main']) ;
                    // console.log(data['date']) ;
                    // console.log(data['visit']) ;
                    // console.log(data['visit']) ;
                    //console.log(data['info']) ;
                }
                if (!data['status']) {
                    console.log("Ошибка выгрузки информации");
                }
            }
        });
    }

}
// Функции

// Обработчики вызова
$('.item_btn.poster_btn').click(function (){
    console.log(($(this).attr('data-id')));

    $.ajax({
        url: '/review_one_logic.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id: ($(this).attr('data-id'))
        },
        success(data) {
            if (data['status']) {
                window.location.href = 'rev_one.php';
                // console.log(data['nick']) ;
                // console.log(data['film']) ;
                // console.log(data['name']) ;
                // console.log(data['picture']) ;
                // console.log(data['text_preview']) ;
                // console.log(data['text_main']) ;
                // console.log(data['date']) ;
                // console.log(data['visit']) ;
                // console.log(data['visit']) ;
                //console.log(data['info']) ;
            }
            if (!data['status']) {
                console.log("Ошибка выгрузки информации");
            }
        }
    });
})
$('.item_btn.poster_btn_recomend').click(function (){
    console.log(($(this).attr('data-id')));

    $.ajax({
        url: '/review_one_logic.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id: ($(this).attr('data-id'))
        },
        success(data) {
            if (data['status']) {
                window.location.href = 'rev_one.php';
                // console.log(data['nick']) ;
                // console.log(data['film']) ;
                // console.log(data['name']) ;
                // console.log(data['picture']) ;
                // console.log(data['text_preview']) ;
                // console.log(data['text_main']) ;
                // console.log(data['date']) ;
                // console.log(data['visit']) ;
                // console.log(data['visit']) ;
                //console.log(data['info']) ;
            }
            if (!data['status']) {
                console.log("Ошибка выгрузки информации");
            }
        }
    });
})
$('.info_btn.catalog').click(function (){
    console.log(($(this).attr('data-id')));

    $.ajax({
        url: '/review_one_logic.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id: ($(this).attr('data-id'))
        },
        success(data) {
            if (data['status']) {
                window.location.href = 'rev_one.php';
                // console.log(data['nick']) ;
                // console.log(data['film']) ;
                // console.log(data['name']) ;
                // console.log(data['picture']) ;
                // console.log(data['text_preview']) ;
                // console.log(data['text_main']) ;
                // console.log(data['date']) ;
                // console.log(data['visit']) ;
                // console.log(data['visit']) ;
                //console.log(data['info']) ;
            }
            if (!data['status']) {
                console.log("Ошибка выгрузки информации");
            }
        }
    });
})
$('.info_btn.news').click(function (){
    console.log(($(this).attr('data-id')));

    $.ajax({
        url: '/news_one_logic.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id: ($(this).attr('data-id'))
        },
        success(data) {
            if (data['status']) {
                window.location.href = 'news_one.php';
                // console.log(data['nick']) ;
                // console.log(data['film']) ;
                // console.log(data['name']) ;
                // console.log(data['picture']) ;
                // console.log(data['text_preview']) ;
                // console.log(data['text_main']) ;
                // console.log(data['date']) ;
                // console.log(data['visit']) ;
                // console.log(data['visit']) ;
                //console.log(data['info']) ;
            }
            if (!data['status']) {
                console.log("Ошибка выгрузки информации");
            }
        }
    });
})
// Обработчики вызова

