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
            return $answer;
        }
    }