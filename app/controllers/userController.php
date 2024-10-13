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

        # Verifying required fields
        if ($name == "" || $lastname == "" || $user == "" || $password1 == "" || $password2 == "") {
            $alert = [
                "type" => "simple",
                "title" => "Ocurrió un error inesperado",
                "text" => "No has llenado todos los campos que son obligatorios",
                "icon" => "error"
            ];
            return json_encode($alert);
        }

        // Add your user registration logic here
        // ...

        // If registration is successful, return a success alert
        $alert = [
            "type" => "clear",
            "title" => "Usuario registrado",
            "text" => "El usuario se ha registrado correctamente",
            "icon" => "success"
        ];
        return json_encode($alert);
    }
}