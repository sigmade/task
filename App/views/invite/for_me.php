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
            <li><a href="/invite">Приглашения</a></li>
            <li class="active">Для меня</li>
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
        <? if ($resInv["items"]) : ?>
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
                        <?
                        $statuses = [
                            0 => ["type" => "default", "text" => "Ожидается"],
                            1 => ["type" => "success", "text" => "Принято"],
                            2 => ["type" => "danger", "text" => "Отклонен"],
                        ];
                        foreach ($resInv["items"] as $item) { ?>
                            <tr data-index="0">
                                <td class=""><? echo date("d. m. Y", $item["date"]); ?></td>
                                <td style="text-right">
                                    <? if ($u_inf = $resInv['users_info'][$item["from_user_id"]]) {

                                        ?>
                                        <a href="/profile/<? echo $u_inf["id"] ?>"><? echo $u_inf["email"] ?></a>
                                    <? } else { ?>
                                        <span>-------</span>
                                    <? } ?>
                                </td>
                                <td style="text-right"><span
                                            class="label label-<? echo $statuses[$item["status"]]["type"] ?>"><? echo $statuses[$item["status"]]["text"] ?></span>
                                </td>
                                <td style="text-right">
                                    <a title="Скрыть?" href="/invite/delete/ID/<? echo $item["ID"] ?>"
                                       class="glyphicon glyphicon-trash js-confirm"></a>
                                    </a>
                                </td>
                            </tr>
                        <? } ?>
                        </tbody>
                    </table>
                    <? // var_dump($resInv['users_info'][41]["id"]); //$resInv["users_info" ][41]["id"]?>
                    <? if ($resInv["stack"]) {
                        $paginationUrl = $thisUrl . "?p=";
                        $stack = $resInv["stack"];

                        include "App/views/blocks/pagination.php";

                    } ?>

                </div>
            </div><!--/.row-->
        </div>
    </div>
<? endif; ?>
</div>    <!--/.main-->

<? /* require_once "App/views/blocks/jslumino.php" */ ?>
<? require_once "App/views/blocks/scripts.php" ?>


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