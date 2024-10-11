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
    <?php
    use app\controllers\viewsController;

/* si la vista existe carga la vista */
    
$viewsController= new viewsController();
    $view=$viewsController->getViewsController($url[0]);

    if($view=="welcome" || $view=="404"){
        require_once "./app/views/content/".$view."-view.php";
    }else{
        require_once "./app/views/inc/navbar.php";
        require_once $view;
    }

    require_once "./app/views/inc/script.php";



    ?> 

    
</body>
</html>