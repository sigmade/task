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
                        <? foreach ($taskItems["items"] as $item) { ?>
                              <tr data-index="0">
                                <td class="text-right"><? echo $item["ID"]; ?></td>
                                <td style="text-right"><a href=""><? echo $item["title"]; ?></a></td>
                                <td style="text-right"><? echo date("d.m.Y", $item["date_created"]); ?></td>
                                <td style="text-right"><? echo (!$item["date_deadline"])? "---" : date("d.m.Y", $item["date_deadline"])?></td>
                                <td style="text-right"><? echo (!$item["date_finished"])? "---" : date("d.m.Y", $item["date_finished"])?></td>
                                <td style="text-right"><? echo $item["status"]; ?></td>
                                <td style="text-center">

                                    <a href="/task/complete/ID/<? echo $item["ID"]; ?>" style="margin: 5px;"><svg class="bi bi-check-box" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M15.354 2.646a.5.5 0 010 .708l-7 7a.5.5 0 01-.708 0l-3-3a.5.5 0 11.708-.708L8 9.293l6.646-6.647a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                                            <path fill-rule="evenodd" d="M1.5 13A1.5 1.5 0 003 14.5h10a1.5 1.5 0 001.5-1.5V8a.5.5 0 00-1 0v5a.5.5 0 01-.5.5H3a.5.5 0 01-.5-.5V3a.5.5 0 01.5-.5h8a.5.5 0 000-1H3A1.5 1.5 0 001.5 3v10z" clip-rule="evenodd"/>
                                        </svg></a>
                                    <a href="/task/edit/ID/<? echo $item["ID"]; ?>" style="margin: 5px;"><svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd"/>
                                        </svg></a>
                                    <a href="/task/delete/ID/<? echo $item["ID"]; ?>" style="margin: 5px;"><svg class="bi bi-x-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" d="M14 1H2a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V2a1 1 0 00-1-1zM2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2z" clip-rule="evenodd"/>
                                            <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                                            <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z" clip-rule="evenodd"/>
                                        </svg></a>

                                </td>
                            </tr>
                         <? } ?>
                        </tbody>
                        </table>
                <? if($taskItems["stack"]) {
                    $paginationUrl = $thisUrl."?/p=";
                    $stack = $taskItems["stack"];

                    include "App/views/blocks/pagination.php";

                } ?>

            </div>
            <div class="col-md-2"></div>
        </div><!--/.row-->
    </div>

</div>	<!--/.main-->

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