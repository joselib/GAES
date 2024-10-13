<?php

namespace app\controllers;
use app\models\mainModel;

class userController extends mainModel {

    public function resgistreUserController() {
        # Storing data
        $name = $this->cleanChain($_POST['user_name']);
        $lastname = $this->cleanChain($_POST['user_lastname']);
        $user = $this->cleanChain($_POST['user_user']);
        $email = $this->cleanChain($_POST['user_email']);
        $password1 = $this->cleanChain($_POST['user_password_1']);
        $password2 = $this->cleanChain($_POST['user_password_2']);

        # Verifying required fields #
        if ($name == "" || $lastname == "" || $user == "" || $password1 == "" || $password2 == "") {
            $alert = [
                "type" => "simple",
                "title" => "Ocurrió un error inesperado",
                "text" => "No has llenado todos los campos que son obligatorios",
                "icon" => "error"
            ];
            return json_encode($alert);
        }
        
        // Verify Data Function (Regular Expression)
        if($this->verifyData("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$name))
        {
            $alert = [
                "type" => "simple",
                "title" => "Ocurrió un error inesperado",
                "text" => "El NOMBRE no coincide con el formato solicitado",
                "icon" => "error"
            ];
            return json_encode($alert);
        }

        if($this->verifyData("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$lastname))
        {
            $alert = [
                "type" => "simple",
                "title" => "Ocurrió un error inesperado",
                "text" => "El APELLIDO no coincide con el formato solicitado",
                "icon" => "error"
            ];
            return json_encode($alert);
        }

        if($this->verifyData("[a-zA-Z0-9]{4,20}",$user))
        {
            $alert = [
                "type" => "simple",
                "title" => "Ocurrió un error inesperado",
                "text" => "El USUARIO no coincide con el formato solicitado",
                "icon" => "error"
            ];
            return json_encode($alert);
        }

        if($this->verifyData("[a-zA-Z0-9$@.-]{7,100}",$password1) || $this->verifyData ("[a-zA-Z0-9$@.-]{7,100}",$password2  ))
        {
            $alert = [
                "type" => "simple",
                "title" => "Ocurrió un error inesperado",
                "text" => "Las contraseñas  no coincide con el formato solicitado  ",
                "icon" => "error"
            ];
            return json_encode($alert);
        }

        		    # check email #
		    if($email!=""){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$check_email=$this->ejecuteConsultation("SELECT user_email FROM users WHERE user_email='$email'");
					if($check_email->rowCount()>0){
                        $alert = [
                            "type" => "simple",
                            "title" => "Ocurrió un error inesperado",
                            "text" => "El EMAIL que acaba de ingresar ya se encuentra registrado en el sistema, por favor verifique e intente nuevamente",
                            "icon" => "error"
                         ];
						return json_encode($alert);

					}
				}else{
            $alert = [
                "type" => "simple",
                "title" => "Ocurrió un error inesperado",
                "text" => "Las EMAIL  no valido  ",
                "icon" => "error"
            ];
					return json_encode($alert);
				}
            }

            # check password and encrypt password #
            if($password1!=$password2){
            $alert = [
                "type" => "simple",
                "title" => "Ocurrió un error inesperado",
                "text" => "Las  contraseñas no son iguales   ",
                "icon" => "error"
            ];
            return json_encode($alert);
            }else{
                $password=password_hash($password1,PASSWORD_BCRYPT,["cost"=>10]);
            }

            # check user unice #
					$check_user=$this->ejecuteConsultation("SELECT user_user FROM users WHERE user_user='$user'");
					if($check_user->rowCount()>0){
                        $alert = [
                            "type" => "simple",
                            "title" => "Ocurrió un error inesperado",
                            "text" => "El USUARIO que acaba de ingresar ya se encuentra registrado en el sistema, por favor verifique e intente nuevamente",
                            "icon" => "error"
                         ];
						return json_encode($alert);
                        }
                # Dir photos #
    		$img_dir="../views/photos/";

            
        // If registration is successful, return a success alert
        $alert = [
            "type" => "clear",
            "title" => "Usuario registrado",
            "text" => "El USUARIO se ha registrado correctamente",
            "icon" => "success"
        ];
        return json_encode($alert);
    }
}