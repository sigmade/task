<?php

$Auth = new App\models\Auth();

if($_POST["method_name"] == "enter")
{
    try
    {
        $resAuth = $Auth->enter($_POST);
    }
    catch (Exception $e)
    {
        $error = ["error_text" => $e->getMessage()];
    }
}

/*
 Если были переданы GET параметры
 */

if($_GET["confirm_email"])
{
    try
    {
        $Auth->confirm_email($_GET["confirm_email"]);
    }
    catch (Exception $e)
    {
        $error = ["error_text" => $e->getMessage()];
    }
}

/*
 Если были переданы GET параметры
 */

include "App/views/login.php";