<?php


if(!$Auth->check_auth())
{
    include "App/views/template.php";
}
else
{
    $pageTitle = "Главная";
    include "App/views/main.php";
}