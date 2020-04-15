<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><? echo $pageTitle; ?></title>
    <? require_once "App/views/blocks/csslumino.php" ?>
    <style>
        .forAvatar{
            display: block;
            width: 150px;
            height: 150px;
            background: no-repeat center / cover;
            border-radius: 50%;
        }
    </style>
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
                            <span class="forAvatar" style="background-image:url(<? echo $profileInfo["avatar_big_url"]; ?>);"></span>
                        </a>
                        <div class="form-group" style="margin-top: 15px;">
                            <label for="" style="margin-bottom: 15px;">Добавить фотографию</label>
                            <input style="form-control" type="file" name="avatar">
                        </div>
                    </div>
                    <div class="col-sm-9">
                        <div class="form-group">
                            <label for="">Ваше имя (nickname)</label><br>
                            <input style="form-control" type="text" name="nickname" value="<? echo $profileInfo["nickname"]; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Текст</label><br>
                            <textarea name="text" id="editor1"  value=""><? echo $profileInfo["text"]; ?></textarea>
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
                            <input type="password" class="form-control" name="new_pass1" required>
                        </div>
                        <div class="form-group">
                            <label for="">Укажите новый пароль (повтор)</label>
                            <input type="password" class="form-control" name="new_pass2" required>
                        </div>
                        <div class="text-left" style="margin-top: 15px;">
                            <input class="btn btn-success" type="submit" name="submit" value="Сохранить">
                        </div>
                    </form>

                </div>
                <div class="col-sm-5">
                    <div class="list-group">
                        <a href="/profile/change_token" class="list-group-item">Обновить токен (снять автризацию на
                            других устройствах)</a>
                        <a href="/profile/delete" class="list-group-item list-group-item-danger">Удалить аккаунт</a>
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
<?/* var_dump($profileInfo); */?>
</body>
</html>