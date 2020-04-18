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
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active"><a href="/task">Задачи</a></li>
            <li class="active">Создать</li>
        </ol>
    </div><!--/.row-->
    <? if ($error) { ?>
        <div class="row">
            <div class="alert alert-danger" role="alert" style="padding: 20px; margin: 20px;">
                <? echo $error["error_text"]; ?>
            </div>
        </div>

    <? } ?>

    <div class="row">
        <div class="col-lg-12">
        </div>
    </div><!--/.row-->

    <div class="panel panel-container">
        <div class="row">
            <div class="col-md-12">
                <div class="" style="padding: 25px;"><? echo $pageTitle; ?></div>
                <dl class="dl-horizontal">
                    <? $statuses = [
                        0 => ["type" => "default", "text" => "В процессе"],
                        1 => ["type" => "success", "text" => "Выполнено"],
                        2 => ["type" => "danger", "text" => "Провалено"],
                    ];
                    ?>
                    <dt>Статус :</dt>
                    <dd>
                        <span class="label label-<? echo $statuses[$taskInfo["status"]]["type"] ?>"><? echo $statuses[$taskInfo["status"]]["text"] ?></span>
                    </dd>
                    <dt style="margin-top: 10px;">От кого :</dt>
                    <dd style="margin-top: 10px;">
                        <a href="/profile/<? echo $taskInfo["from_user_id"] ?>">
                            <? echo $usersInfo[$taskInfo["from_user_id"]]["email"] . " (" . $usersInfo[$taskInfo["from_user_id"]]["nickname"] . ")" ?>
                        </a>
                    </dd>
                    <dt style="margin-top: 10px;">Для кого :</dt>
                    <dd style="margin-top: 10px;">
                        <a href="/profile/<? echo $taskInfo["for_user_id"] ?>">
                            <? echo $usersInfo[$taskInfo["for_user_id"]]["email"] . " (" . $usersInfo[$taskInfo["for_user_id"]]["nickname"] . ")" ?>
                        </a>
                    </dd>
                    <dt style="margin-top: 10px;">Дата создания :</dt>
                    <dd style="margin-top: 10px;">
                        <? echo date("d.m.Y H:i", $taskInfo["date_created"]) ?>
                    </dd>
                    <? if ($taskInfo["date_deadline"]) { ?>
                        <dt style="margin-top: 10px;">Дата deadline :</dt>
                        <dd style="margin-top: 10px;">
                            <? echo date("d.m.Y H:i", $taskInfo["date_deadline"]) ?>
                        </dd>
                    <? } ?>
                    <? if ($taskInfo["date_finished"]) { ?>
                        <dt style="margin-top: 10px;">Дата окончания :</dt>
                        <dd style="margin-top: 10px;">
                            <? echo date("d.m.Y H:i", $taskInfo["date_finished"]) ?>
                        </dd>
                    <? } ?>
                </dl>
                <hr>

                <div style="padding: 25px;">
                    <? echo $taskInfo["text"]; ?>
                </div>

            </div>
        </div>
        <!--/.row-->
    </div>

</div>    <!--/.main-->

<? //var_dump($resItem); ?>

<? require_once "App/views/blocks/jslumino.php" ?>

<script src="//cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
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

</body>
</html>