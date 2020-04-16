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
            <li class="active">Приглашения</li>
            <li class="active">Мои</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><? echo $pageTitle; ?></h1>
        </div>
    </div><!--/.row-->
    <? if ($error) : ?>
        <div class="row">
            <div class="col-lg-12">
                <div class='alert alert-danger mt-3' role='alert'><b>Ошибка! </b><? echo $error['error_text']; ?></div>
            </div>
        </div>
    <? endif; ?>

    <div class="panel panel-container">
        <div class="row" style="margin-bottom: 35px;>
            <div class=" col-md-12 text-right
        " ">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="method_name" value="create">
            <div class="input-group" style="margin: 20px;">
                <input type="email" name="email" class="form-control" placeholder="Укажите email" required>
                <div class="input-group-btn">
                    <input type="submit" name="submit" value="Создать приглашение" class="btn btn-success">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="panel panel-container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive" style="padding: 25px;">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr class="active">
                        <th class="">
                            <div class="th-inner ">Date</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th class="">
                            <div class="th-inner ">Email</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th class="">
                            <div class="th-inner ">Status</div>
                            <div class="fht-cell"></div>
                        </th>
                        <th class="">
                            <div class="th-inner ">Settings</div>
                            <div class="fht-cell"></div>
                        </th>
                    </thead>
                    <tbody>

                    <tr data-index="0">
                        <td class=""><a href="">11 13 19</a></td>
                        <td style="text-right"><a href="">ss@ss</a></td>
                        <td style="text-right"><span class="label label-default">Ожидается</span></td>
                        <td style="text-right">
                            <a title="Скрыть?" href="<? echo $item["ID"]; ?>" style="margin: 5px;">
                                <svg class="bi bi-check-box" width="1em" height="1em" viewBox="0 0 16 16"
                                     fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M15.354 2.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3-3a.5.5 0 11.708-.708L8 9.293l6.646-6.647a.5.5 0 01.708 0z"
                                          clip-rule="evenodd"/>
                                    <path fill-rule="evenodd"
                                          d="M1.5 13A1.5 1.5 0 003 14.5h10a1.5 1.5 0 001.5-1.5V8a.5.5 0 00-1 0v5a.5.5 0 01-.5.5H3a.5.5 0 01-.5-.5V3a.5.5 0 01.5-.5h8a.5.5 0 000-1H3A1.5 1.5 0 001.5 3v10z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </a>
                        </td>
                    </tr>

                    </tbody>
                </table>
                <? if ($taskItems["stack"]) {
                    $paginationUrl = $thisUrl . "?p=";
                    $stack = $taskItems["stack"];

                    include "App/views/blocks/pagination.php";

                } ?>

            </div>
        </div><!--/.row-->
    </div>
</div>

</div>    <!--/.main-->

<? require_once "App/views/blocks/jslumino.php" ?>
<script>
    window.onload = function () {
        var chart1 = document.getElementById("line-chart").getContext("2d");
        window.myLine = new Chart(chart1).Line(lineChartData, {
            responsive: true,
            scaleLineColor: "rgba(0,0,0,.2)",
            scaleGridLineColor: "rgba(0,0,0,.05)",
            scaleFontColor: "#c5c7cc"
        });
    };
</script>

</body>
</html>