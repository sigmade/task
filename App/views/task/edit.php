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
            <h1 class="page-header"><? echo $pageTitle; ?></h1>
        </div>
    </div><!--/.row-->

    <div class="panel panel-container">
        <div class="row">
            <div class="col-md-12 text-right" style="padding-right: 25px;">
                <a href="/task/create" class="btn btn-primary btn-lg mr15">Добавить задачу <span
                            class="glyphicon glyphicon-plus-sign"></span></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="referer" value="<? echo $referer; ?>">
                    <input type="hidden" name="method_name" value="edit">
                    <input type="hidden" name="ID" value="<? echo $inputs_val["ID"]; ?>">
                    <div class="form-group">
                        <label>Заголовок</label>
                        <input class="form-control" name="title" type="text" value="<? echo $inputs_val["title"]; ?>"
                               required>
                    </div>

                    <? if ($resTeam["items"]): ?>

                        <div class="form-group">
                            <label>Для кого?</label>
                            <select class="form-control" name="for_user_id" id="">
                                <option value="">Для себя</option>
                                <? foreach ($resTeam["items"] as $item) {

                                    $selected = ($item["ID"] == $inputs_val["for_user_id"]) ? "selected" : null;

                                    ?>
                                    <option value="<? echo $item["ID"] ?>"<? echo $selected ?>><? echo $item["email"] ?></option>
                                <? } ?>
                            </select>
                        </div>

                    <? endif; ?>

                    <div class="form-group">
                        <label>Дата когда задача должна быть выполнена (Deadline)</label>
                        <input type="date" id="start" name="date_deadline"
                               value="<? echo date("Y-m-d", $inputs_val["date_deadline"]); ?>">
                    </div>
                    <div class="form-group">
                        <label>Текст</label>
                        <div>
                            <textarea id="editor1" name="text"><? echo $inputs_val["text"] ?></textarea>
                        </div>
                    </div>
                    <div class="form-group" style="padding-bottom: 50px;">
                        <div class="pull-left">
                            <a href="<? echo $referer ?>" class="btn btn-default">Отмена</a>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-primary">Готово</button>
                        </div>
                    </div>
                </form>


            </div>
            <div class="col-md-3"></div>
        </div><!--/.row-->
    </div>

</div>    <!--/.main-->

<? //var_dump(date("m.d.Y", $inputs_val["date_deadline"])); ?>

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