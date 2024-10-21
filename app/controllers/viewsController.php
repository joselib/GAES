<?php 
    namespace app\controllers;
    use app\models\viewsModel;

    class viewsController extends viewsModel{

        public function getViewsController($view){
            if($view!=""){
                $answer=$this->getViewsModels($view);
            }else{
                $answer="welcome";
            }
                    // Verify if the user has permission to access certain views
            if ($answer == "./app/views/content/userNew-view.php" || $answer == "./app/views/content/userList-view.php") {
            // Verificar si el usuario está logueado y tiene id = 1
                if (!isset($_SESSION['id']) || $_SESSION['id'] != 1) {
                $answer = "403"; // Access denied view
                }
            }
            return $answer;
        }
    }