<?php
    namespace app\models;

    class viewsModel{
        protected function getViewsModels($view){
            $whiteList=["dashboard","userNew","userList","userUpdate","userSearch","userPhoto","logOut","login"];

            if(in_array($view,$whiteList)){
                if(is_file("./app/views/content/".$view."-view.php")){
                        $content="./app/views/content/".$view."-view.php";

                }else{
                    $content="404";
                }
            }elseif($view=="welcome" || $view=="index"){
                $content="welcome";
            }else{
                $content="404";
            }
            return $content;
        }

    }