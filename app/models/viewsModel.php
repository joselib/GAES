<?php
    namespace app\models;

    class viewsModel{
        protected function getViewsModels($view){
            $whiteList=["dashboard","userNew","userList","userUpdate","userSearch","userPhoto","logOut"];

            if ($view == "welcome") {
        $content = "welcome";
    } elseif ($view == "login") {
        $content = "login";
    } elseif (in_array($view, $whiteList)) {
        if (is_file("./app/views/content/" . $view . "-view.php")) {
            $content = "./app/views/content/" . $view . "-view.php";
        } else {
            $content = "404";
        }
    } elseif($view == "403") {
        $content = "./app/views/content/403-view.php";
    } else{
         $content = "404";
    }
            return $content;
        }

    }