<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><? echo $pageTitle; ?></title>
    <? require_once "App/views/blocks/csslumino.php" ?>
</head>
<body>
<? require_once "App/views/blocks/header.php" ?>
<? require_once "App/views/blocks/sidebar.php" ?>


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">
                    <em class="fa fa-home"></em>
                </a></li>
            <li><a href="/profile">Профиль</a></li>
            <li class="active">Настройки</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header"><? echo $pageTitle; ?></h2>
        </div>
    </div><!--/.row-->

    <div class="panel panel-default">
        <div class="panel-heading">Основные настройки</div>
        <div class="panel-body">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="method_name" value="edit_profile_info">
                <div class="row">
                    <div class="col-sm-3">
                        <a href="">
                            <img src="http://lorempixel.com/150/150/people/" alt="" class="img-circle">
                        </a>
                        <div class="form-group" style="margin-top: 15px;">
                            <label for="" style="margin-bottom: 15px;">Добавить фотографию</label>
                            <input style="form-control" type="file" name="avatar">
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label for="">Ваше имя (nickname)</label><br>
                            <input style="form-control" type="text" name="nickname">
                        </div>
                        <div class="form-group">
                            <label for="">Текст</label><br>
                            <textarea name="text" id="editor1" ></textarea>
                        </div>
                    </div>
                </div>
                <div class="text-left" style="margin-top: 15px;">
                    <input class="btn btn-success" type="submit" name="" value="Сохранить">
                </div>
            </form>

        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Дополнительные настройки</div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-7">
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="method_name" value="edit_pass">
                        <div class="form-group">
                            <label for="">Укажите новый пароль</label>
                            <input type="text" class="form-control" name="new_pass1">
                        </div>
                        <div class="form-group">
                            <label for="">Укажите новый пароль (повтор)</label>
                            <input type="text" class="form-control" name="new_pass2">
                        </div>
                    </form>
                    <div class="text-left" style="margin-top: 15px;">
                        <input class="btn btn-success" type="submit" name="" value="Сохранить">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="list-group">
                        <a href="" class="list-group-item">Обновить токен (снять автризацию на других устройствах)</a>
                        <a href="" class="list-group-item list-group-item-danger">Удалить аккаунт</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <? require_once "App/views/blocks/jslumino.php" ?>
    <script src="//cdn.ckeditor.com/4.6.1/basic/ckeditor.js"></script>
    <script>

        CKEDITOR.replace( 'editor1' );
        $('#datepicker1').datepicker({});

        !function ($) {
            $(document).on("click","ul.nav li.parent > a > span.icon", function(){
                $(this).find('em:first').toggleClass("glyphicon-minus");
            });
            $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
        }(window.jQuery);

        $(window).on('resize', function () {
            if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
        })
        $(window).on('resize', function () {
            if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
        })
    </script>
</body>
</html>