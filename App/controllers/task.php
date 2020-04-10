<?php


if(!$Auth->check_auth()) { include "App/views/template.php"; exit;}

/** GET */
if($_GET["method"])
{
    switch ($_GET["method"]):
        case "create":

            $pageTitle = "Добавить задачу";
            include "App/views/task/create.php";
            break;

    endswitch;
}
else
{
    $pageTitle = "Задачи";
    include "App/views/task/task.php";
}