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
                $resTeam = $Profile->get(["m" => 4]);
                $inputs_val = $_POST;
                include "App/views/task/create.php";
                exit;
            }

        break;
        case "edit" :

            try {
                $resTask = $Task->edit($_POST);
                header("Location: " . $referer);

            } catch (Exception $e) {
                $error = ["error_text" => $e->getMessage()];
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
            $sideBar_page = ["lvl1" => "task"];
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
            break;
        case "delete":

            try {
                $Task->delete($_GET["ID"]);
                header("Location: " . $referer);
            } catch (Exception $e) {
                $error = ["error_text" => $e->getMessage()];
                include "App/views/for_error.php";
            }

            break;
        case "edit":

            try {
                $sideBar_page = ["lvl1" => "task"];
                $resTeam = $Profile->get(["m" => 4]);
                $resItem = $Task->get(["m" => 2, "ID" => $_GET["ID"]]);
                $inputs_val = $resItem["item"];
                $pageTitle = "Добавить задачу";
                include "App/views/task/edit.php";
            } catch (Exception $e) {
                $error = ["error_text" => $e->getMessage()];
                include "App/views/for_error.php";
            }

            break;
        case "for_me":

            $sideBar_page = ["lvl1" => "task", "lvl2" => "for_me"];
            $taskItems = $Task->get(["m" => 3, "limit" => 20, "p" => $_GET["p"], "sort_by" => @$_GET["sort_by"]]);
            $thisUrl = $Path->withoutGet();
            $pageTitle = "Задачи для меня";
            include "App/views/task/for_me.php";
            break;
        case is_numeric($_GET["method"]):

            try {

                $sideBar_page = ["lvl1" => "task"];
                $resItem = $Task->get(["m" => 2, "ID" => $_GET["method"]]);
                $taskInfo = $resItem["item"];
                $usersInfo = $resItem["usersInfo"];
                $pageTitle = $taskInfo["title"];
                include "App/views/task/show.php";
            } catch (Exception $e) {
                $error = ["error_text" => $e->getMessage()];
                include "App/views/for_error.php";
            }

            break;

    endswitch;
}
else
{
    $sideBar_page = ["lvl1" => "task", "lvl2" => "my"];
    $taskItems = $Task->get(["m" => 1, "limit" => 20, "p" => @$_GET["p"], "sort_by" => @$_GET["sort_by"]]);
    $thisUrl = $Path->withoutGet();
    $pageTitle = "Задачи";
    include "App/views/task/task.php";


}

