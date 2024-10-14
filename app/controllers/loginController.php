<?php	namespace app\controllers;
	use app\models\mainModel;

    class loginController extends mainModel{

        /*---------- init session controller   ----------*/

public function initSessionController(){
    # Storing data
    $user = $this->cleanChain($_POST['login_user']);
    $password = $this->cleanChain($_POST['login_password']);

    # Check required data
    if($user == "" || $password == ""){
        $this->showError("No has llenado todos los campos que son obligatorios");
        return;
    }

    # Check data integrity
    if(!preg_match("/^[a-zA-Z0-9]{4,20}$/", $user)){
        $this->showError("El USUARIO no coincide con el formato solicitado");
        return;
    }

    if(!preg_match("/^[a-zA-Z0-9$@.-]{7,100}$/", $password)){
        $this->showError("La CONTRASEÑA no coincide con el formato solicitado");
        return;
    }

    # Check user
    $check_user = $this->executeConsultation("SELECT * FROM users WHERE user_user = ?", [$user]);
    
    if($check_user->rowCount() == 1){
        $check_user = $check_user->fetch();

        if($check_user['user_user'] == $user && password_verify($password, $check_user['user_password'])){
            // Login successful
            $_SESSION['id'] = $check_user['user_id'];
            $_SESSION['name'] = $check_user['user_name'];
            $_SESSION['lastname'] = $check_user['user_lastname'];
            $_SESSION['user'] = $check_user['user_user'];
            $_SESSION['photo'] = $check_user['user_photo'];

            if(headers_sent()){
                echo "<script> window.location.href='".APP_URL."dashboard/'; </script>";
            } else {
                header("Location: ".APP_URL."dashboard/");
            }
        } else {
            $this->showError("El USUARIO o CONTRASEÑA son incorrectos");
        }
    } else {
        $this->showError("El USUARIO o CONTRASEÑA son incorrectos");
    }
}

private function showError($message){
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Ocurrió un error inesperado',
            text: '$message',
            confirmButtonText: 'Aceptar'
        });
    </script>
    ";
}
		/*----------  close of session controller  ----------*/
		public function closeSessionControlller(){

			session_destroy();

		    if(headers_sent()){
                echo "<script> window.location.href='".APP_URL."welcome/'; </script>";
            }else{
                header("Location: ".APP_URL."welcome/");
            }
		}
    }