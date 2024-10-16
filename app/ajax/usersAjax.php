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

		if($_POST['module_user']=="actualizar"){
			echo $insUser->actualizarUsuarioControlador();
		}

		if($_POST['module_user']=="eliminarFoto"){
			echo $insUser->eliminarFotoUsuarioControlador();
		}

		if($_POST['module_user']=="actualizarFoto"){
			echo $insUser->actualizarFotoUsuarioControlador();
		}
		
	}else{
		session_destroy();
		header("Location: ".APP_URL."login/");
	}