<?php
	
	require_once "../../config/app.php";
	require_once "../views/inc/session_start.php";
	require_once "../../autoload.php";
	
	use app\controllers\userController;

	if(isset($_POST['module_user'])){

		$insUser = new userController();

		if($_POST['module_user']=="registre"){
			echo $insUser->registerUserController();
		}

		if($_POST['module_user']=="deleter"){
			echo $insUser->deleterUserController();
		}

		if($_POST['module_user']=="update"){
			echo $insUser->updateUserController();
		}

		if($_POST['module_user']=="deletePhoto"){
			echo $insUser->deletePhotoUserController();
		}

		if($_POST['module_user']=="upPhoto"){
			echo $insUser->upPhotoUserController();
		}
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}