<?php

if (!$Auth->check_auth()) {
    header("Location: /");
    exit;
}

/** GLOBAL */
$Task       = new \App\models\Task();
$Profile = new \App\models\Profile();
$referer    = ($_POST["referer"])? $_POST["referer"] : $_SERVER["HTTP_REFERER"];

/** POST */

if ($_POST["method_name"]) {
    switch ($_POST["method_name"]):
        case "create" :

            try {
                $resTask = $Task->create($_POST);
                header("Location: ".$referer);

            } catch (Exception $e)
            {
                $error      = ["error_text" => $e->getMessage()];
                $inputs_val = $_POST;
                include "App/views/task/create.php";
                exit;
            }

        break;
    endswitch;
}

/** GET */
if($_GET["method"])
{
    switch ($_GET["method"]):
        case "create":
            $resTeam = $Profile->get(["m" => 4]);
            $pageTitle = "Добавить задачу";
            include "App/views/task/create.php";
            break;
        case "change_status":

            try {
                $Task->change_status($_GET);
                header("Location: " . $referer);
            } catch (Exception $e) {
                $error = ["error_text" => $e->getMessage()];
                include "App/views/for_error.php";
            }

    endswitch;
}
else
{
    $taskItems = $Task->get(["m" => 1, "limit" => 20, "p" => $_GET["p"]]);
    $thisUrl = $Path->withoutGet();

    $pageTitle = "Задачи";

include "App/views/task/task.php";
//var_dump($paginationUrl);

}

