<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><? echo $pageTitle; ?></title>
    <? require_once "App/views/blocks/csslumino.php" ?>
    <style>
        .forAvatar {
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
            <li class="active"><? echo $profileInfo["nickname"] ?></li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header"><? echo $pageTitle; ?></h2>
        </div>
    </div><!--/.row-->

    <div class="panel panel-default">
        <div class="panel-heading">Основная информация</div>
        <div class="panel-body">

            <div class="row">
                <div class="col-sm-3">
                    <div>
                        <span class="forAvatar"
                              style="background-image:url(<? echo $profileInfo["avatar_big_url"]; ?>);"></span>
                    </div>

                </div>
                <div class="col-sm-9">
                    <div>Имя :<? echo $profileInfo["nickname"] ?></div>
                    <? if ($profileInfo["text"]) { ?>
                        <div style="margin-top: 20px;"> <? echo $profileInfo["text"] ?></div><? } ?>
                </div>
            </div>

        </div>
    </div>

    <? require_once "App/views/blocks/jslumino.php" ?>
    <script src="//cdn.ckeditor.com/4.6.1/basic/ckeditor.js"></script>
    <script>

        CKEDITOR.replace('editor1');
        $('#datepicker1').datepicker({});

        !function ($) {
            $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
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
    <? /* var_dump($profileInfo); */ ?>
</body>
</html>