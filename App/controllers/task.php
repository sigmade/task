<?php


if(!$Auth->check_auth())
{
    include "App/views/template.php";
}
else
{
    include "App/views/task.php";
}