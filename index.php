<?php

    require_once "./config/app.php";
    require_once "./autoload.php";

        /*---------- Iniciando sesion ----------*/
    require_once "./app/views/inc/session_start.php";

    if(isset($_GET['views'])){
        $url=explode("/",$_GET['views']);
    }else{
        $url=["welcome"];
    }
    ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php require_once "./app/views/inc/head.php"; ?>
</head>
<body>
    <?php require_once "./app/views/inc/script.php"; ?>

    
</body>
</html>