<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><? echo $pageTitle; ?></title>
    <link href="resources/lumino/css/bootstrap.min.css" rel="stylesheet">
    <link href="resources/lumino/css/font-awesome.min.css" rel="stylesheet">
    <link href="resources/lumino/css/datepicker3.css" rel="stylesheet">
    <link href="resources/lumino/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="/resources/css/dashboard.css">
</

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="resources/lumino/js/html5shiv.js"></script>
    <script src="resources/lumino/js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<? require_once "App/views/blocks/header.php"?>
<? require_once "App/views/blocks/sidebar.php"?>


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active"><? echo $pageTitle; ?></li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Текущие задачи</div>
                <div class="panel-body">
                    <? if ($resTasks["items"]) { ?>
                        <ul class="media simple-list">
                            <? foreach ($resTasks["items"] as $item) { ?>
                                <li>
                                    <a href="/task/<? echo $item["ID"]; ?>"
                                       class="media-body"><? echo $item["title"]; ?></a>
                                    <div class="media-right"><? echo ($item["date_deadline"]) ? date("d.m.Y", $item["date_deadline"]) : null; ?></div>
                                </li>
                            <? } ?>
                        </ul>
                    <? } else { ?>
                        <p>Задач не найдено ... <a href="/task">Создать?</a></p>
                    <? } ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Моя команда</div>
                <div class="panel-body">
                    <? if ($myTeam["items"]) { ?>
                        <ul class="simple-list media">
                            <? foreach ($myTeam["items"] as $item) {
                                $avatar_url = (!$item["avatar"]) ? "/resources/img/nobody.jpg" : "/resources/FILES/small/" . $item["avatar"];
                                ?>
                                <li>
                                    <a href="/profile/<? echo $item["ID"]; ?>">
                            <span class="media-left">
                                <span class="avatar" style="background-image:url(<? echo $avatar_url; ?>);"> </span>
                            </span>
                                        <span class="media-body"><? echo $item["nickname"]; ?></span>
                                    </a>
                                </li>
                            <? } ?>
                        </ul>
                    <? } else { ?>
                        <p>В вашей команде никого нет.. <a href="/invite">Пригласить?</a></p>
                    <? } ?>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading"> Site Traffic Overview</div>
                <div class="panel-body">
                    <div class="canvas-wrapper">
                        <canvas class="chart" id="doughnut-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->




<script src="resources/lumino/js/jquery-1.11.1.min.js"></script>
<script src="resources/lumino/js/bootstrap.min.js"></script>
<script src="resources/lumino/js/chart.min.js"></script>
<script src="resources/lumino/js/chart-data.js"></script>
<script src="resources/lumino/js/easypiechart.js"></script>
<script src="resources/lumino/js/easypiechart-data.js"></script>
<script src="resources/lumino/js/bootstrap-datepicker.js"></script>
<script src="resources/lumino/js/custom.js"></script>
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