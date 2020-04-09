<!doctype html>
<html lang="кг">
<head>
    <meta charset="utf-8">
    <title>Случилась ошибка</title>
    <link rel="stylesheet" href="/resources/css/for_error.scss">
    <? require_once "App/views/blocks/metaHeaders.php" ?>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid" id="top-container-fluid-nav">
        <div class="container">
            <!---- for nav container ----->
        </div>
    </div>


    <div class="container-fluid" id="body-container-fluid">
        <div class="container">
            <!---- for body container ---->


            <div class="jumbotron">
                <h1 class="display-1">4<i class="fa  fa-spin fa-cog fa-3x"></i> 4</h1>
                <h1 class="display-3">ERROR</h1>
                <p class="lower-case"><? echo $error["error_text"]; ?></p>

            </div>

            <!-------mother container middle class------------------->


        </div>
    </div>



    <div class="container-fluid" id="footer-container-fluid">
        <div class="container">
            <!---- for footer container ---->
        </div>
    </div>



</div>

<? require_once "App/views/blocks/scripts.php"?>
</body>
</html>
