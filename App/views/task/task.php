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
            <li class="active">Задачи</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><? echo $pageTitle; ?></h1>
        </div>
    </div><!--/.row-->

    <div class="panel panel-container">
        <div class="row">
            <div class="col-md-12 text-right" style="padding-right: 25px;">
                <a href="/task/create" class="btn btn-primary btn-lg mr15">Добавить задачу <span class="glyphicon glyphicon-plus-sign"></span></a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="active">
                            <th class="text-right">
                                <div class="th-inner ">ID</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th class="">
                                <div class="th-inner ">Title</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th class="">
                                <div class="th-inner ">Date of create</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th class="">
                                <div class="th-inner ">Date of deadline</div>
                                <div class="fht-cell"></div>
                            </th>
                            <th class="">
                                <div class="th-inner ">Date of finished</div>
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
                            </tr>
                        </thead>
                        <tbody>

                        <?
                        $statuses = [
                            0 => ["type" => "default", "text" => "В процессе"],
                            1 => ["type" => "success", "text" => "Выполнено"],
                            2 => ["type" => "danger", "text" => "Провалено"],
                        ];
                        foreach ($taskItems["items"] as $item) { ?>
                              <tr data-index="0">
                                <td class="text-right"><? echo $item["ID"]; ?></td>
                                  <td style="text-right"><a
                                              href="/task/<? echo $item["ID"]; ?>"><? echo $item["title"]; ?></a></td>
                                <td style="text-right"><? echo date("d.m.Y", $item["date_created"]); ?></td>
                                <td style="text-right"><? echo (!$item["date_deadline"])? "---" : date("d.m.Y", $item["date_deadline"])?></td>
                                <td style="text-right"><? echo (!$item["date_finished"])? "---" : date("d.m.Y", $item["date_finished"])?></td>

                                  <td style=""><span
                                              class="label label-<? echo $statuses[$item["status"]]["type"] ?>"><? echo $statuses[$item["status"]]["text"] ?></span>
                                  </td>

                                  <td style="text-right">
                                      <a title="В процессе"
                                         href="/task/change_status/status/no/ID/<? echo $item["ID"] ?>"
                                         class="glyphicon glyphicon-time js-confirm"></a>
                                      <a title="Выполнено"
                                         href="/task/change_status/status/1/ID/<? echo $item["ID"] ?>"
                                         class="glyphicon glyphicon-ok js-confirm"></a>
                                      <a title="Отклонить" href="/task/change_status/status/2/ID/<? echo $item["ID"] ?>"
                                         class="glyphicon glyphicon-remove-sign js-confirm"></a>

                                      <span style="margin: 8px;"> | </span>

                                      <a href="/task/edit/ID/<? echo $item["ID"] ?>"
                                         class="ml5 glyphicon glyphicon-edit"></a>
                                      <a href="/task/delete/ID/<? echo $item["ID"] ?>"
                                         class="ml5 glyphicon glyphicon-trash js-confirm"></a>
                                  </td>
                            </tr>
                         <? } ?>
                        </tbody>
                        </table>
                <? if($taskItems["stack"]) {
                    $paginationUrl = $thisUrl."?p=";
                    $stack = $taskItems["stack"];

                    include "App/views/blocks/pagination.php";

                } ?>

            </div>
            <div class="col-md-2"></div>
        </div><!--/.row-->
    </div>

</div>	<!--/.main-->
    <? require_once "App/views/blocks/scripts.php" ?>
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