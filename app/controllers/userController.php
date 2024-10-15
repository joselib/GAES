<?php

namespace app\controllers;
use app\models\mainModel;
use DateTime;

class userController extends mainModel {

public function registerUserController() {
    # Storing data
    $name = $this->cleanChain($_POST['user_name']);
    $lastname = $this->cleanChain($_POST['user_lastname']);
    $user = $this->cleanChain($_POST['user_user']);
    $email = $this->cleanChain($_POST['user_email']);
	$birthdate = $this->cleanChain($_POST['birthdate']);
    $password1 = $this->cleanChain($_POST['user_password_1']);
    $password2 = $this->cleanChain($_POST['user_password_2']);


	# Verifying required fields #
    if (empty($name) || empty($lastname) || empty($user) || empty($birthdate) || empty($password1) || empty($password2)) {
        return json_encode([
            "type" => "simple",
            "title" => "Ocurrió un error inesperado",
            "text" => "No has llenado todos los campos que son obligatorios",
            "icon" => "error"
        ]);
    }
// Verify Data Function (Regular Expression)
    $validations = [
        'name' => "[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",
        'lastname' => "[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",
        'user' => "[a-zA-Z0-9]{4,20}",
        'password1' => "[a-zA-Z0-9$@.-]{7,100}",
        'password2' => "[a-zA-Z0-9$@.-]{7,100}",
		'birthdate' => "\d{4}-\d{2}-\d{2}"
    ];

    foreach ($validations as $field => $pattern) {
        if (!preg_match("/^$pattern$/", $$field)) {
            return json_encode([
                "type" => "simple",
                "title" => "Ocurrió un error inesperado",
                "text" => "El campo " . strtoupper($field) . " no coincide con el formato solicitado",
                "icon" => "error"
            ]);
        }
    }
        		    # check email #
		    if($email!=""){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$check_email = $this->executeConsultation("SELECT user_email FROM users WHERE user_email = ?", [$email]);
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
				#check birthdate #
			if (!$this->validateDate($birthdate)) {
        			return json_encode([
            	"type" => "simple",
            	"title" => "Ocurrió un error inesperado",
            	"text" => "El formato de la fecha de nacimiento no es válido",
           	 "icon" => "error"
       		]);
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
                    $check_user = $this->executeConsultation("SELECT user_user FROM users WHERE user_user = ?", [$user]);
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

            #test if select a photo #
if (!empty($_FILES['user_photo']['name']) && $_FILES['user_photo']['size'] > 0) {
    $img_dir = "../views/photos/";
    if (!is_dir($img_dir) && !mkdir($img_dir, 0755, true)) {
        return json_encode([
            "type" => "simple",
            "title" => "Ocurrió un error inesperado",
            "text" => "Error al crear el directorio",
            "icon" => "error"
        ]);
    }

    $allowed_types = ['image/jpeg', 'image/png'];
    $file_type = mime_content_type($_FILES['user_photo']['tmp_name']);
    if (!in_array($file_type, $allowed_types)) {
        return json_encode([
            "type" => "simple",
            "title" => "Ocurrió un error inesperado",
            "text" => "La imagen que ha seleccionado es de un formato no permitido",
            "icon" => "error"
        ]);
    }

		        # Checking image weight #
		        if(($_FILES['user_photo']['size']/1024)>5120){
		        	$alert=[
						"type"=>"simple",
						"title"=>"Ocurrió un error inesperado",
						"text"=>"La imagen que ha seleccionado supera el peso permitido",
						"icono"=>"error"
					];
					return json_encode($alert);

		        }

                		        # name  photo #
		        $photo=str_ireplace(" ","_",$name);
		        $photo=$photo."_".rand(0,100);

                
		        # Ext of  photo #
		        switch(mime_content_type($_FILES['user_photo']['tmp_name'])){
		            case 'image/jpeg':
		                $photo=$photo.".jpg";
		            break;
		            case 'image/png':
		                $photo=$photo.".png";
		            break;
		        }

		        chmod($img_dir,0777);

                		        # Moving img to dir #
		        if(!move_uploaded_file($_FILES['user_photo']['tmp_name'],$img_dir.$photo)){
		        	$alert=[
						"type"=>"simple",
						"title"=>"Ocurrió un error inesperado",
						"text"=>"No podemos subir la imagen al sistema en este momento",
						"icono"=>"error"
					];
					return json_encode($alert);
		        }

            }else{
                $photo="";
            }

            $user_data_reg=[
				[
					"name_field"=>"user_name",
					"marker_field"=>":Name",
					"value_field"=>$name
				],
				[
					"name_field"=>"user_lastname",
					"marker_field"=>":Lastname",
					"value_field"=>$lastname
				],
				[
					"name_field"=>"user_user",
					"marker_field"=>":User",
					"value_field"=>$user
				],
				[
					"name_field"=>"user_email",
					"marker_field"=>":Email",
					"value_field"=>$email
				],
				[
					"name_field"=>"user_password",
					"marker_field"=>":Password",
					"value_field"=>$password
				],
				[
					"name_field"=>"user_photo",
					"marker_field"=>":Photo",
					"value_field"=>$photo
				],
				[
					"name_field"=>"user_created",
					"marker_field"=>":Created",
					"value_field"=>date("Y-m-d H:i:s")
				],
								[
					"name_field"=>"birthdate",
					"marker_field"=>":Birthdate",
					"value_field"=> $birthdate
				],
				[
					"name_field"=>"user_updated",
					"marker_field"=>":Updated",
					"value_field"=>date("Y-m-d H:i:s")
				]
			];

            $registre_user=$this->saveData("users",$user_data_reg);

            if($registre_user->rowCount()==1){
				$alert=[
					"type"=>"clear",
					"title"=>"Usuario registrado",
					"text"=>"El usuario ".$name." ".$lastname." se registro con exito",
					"icono"=>"success"
				];
			}else{
				
				if(is_file($img_dir.$photo)){
		            chmod($img_dir.$photo,0777);
		            unlink($img_dir.$photo);
		        }

				$alert=[
					"type"=>"simple",
					"title"=>"Ocurrió un error inesperado",
					"text"=>"No se pudo registrar el usuario, por favor intente nuevamente",
					"icono"=>"error"
				];
			}

			return json_encode($alert);

    }

	// method Validation DATE

private function validateDate($date, $format = 'Y-m-d') {
    try {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    } catch (\Exception $e) {
        error_log("Error validating date: " . $e->getMessage());
        return false;
    }
}

//user List controlller

public function listUserController($page,$registration,$url,$search)
{
	$page = $this->cleanChain($page);
	$registration = $this->cleanChain($registration);

	$url = $this->cleanChain($url);
	$url = APP_URL.$url."/";

	$search = $this->cleanChain($search);
	$tabla="";

	$page= (isset($page) && $page>0) ? (int) $page : 1;
	$init = ($page>0) ? (($page*$registration)-$registration) : 0 ;

	if(isset($search) && $search!=""){

		$consult_data="SELECT * FROM users WHERE ((user_id!='".$_SESSION['id']."' AND user_id!='1) AND (user_name LIKE '%$search%' OR user_lastname	LIKE '%$search%' OR user_email	LIKE '%$search%' OR user_user LIKE '%$search%' )) ORDER BY  user_name ASC LIMIT $init, $registration";
		
		$consult_total="SELECT COUNT(user_id) FROM users WHERE ((user_id!='".$_SESSION['id']."' AND user_id!='1) AND (user_name LIKE '%$search%' OR user_lastname	LIKE '%$search%' OR user_email	LIKE '%$search%' OR user_user LIKE '%$search%' )) ";
	}else{

		$consult_data="SELECT * FROM users WHERE user_id!='".$_SESSION['id']."' AND user_id!='1' ORDER BY  user_name ASC LIMIT $init, $registration";
		
		$consult_total="SELECT COUNT(user_id) FROM users WHERE user_id!='".$_SESSION['id']."' AND user_id!='1'";
	}
	$data= $this->executeConsultation($consult_data);
	$data= $data->fetchALL();

	$total= $this->executeConsultation($consult_total);
	$total= (int) $total->fetchColumn();

	$numberPages=ceil($total/$registration);
$tabla.='
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Email</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Creado</th>
                        <th scope="col">Actualizado</th>
                        <th scope="col" colspan="3">Opciones</th>
                    </tr>
                </thead>
                <tbody>
		    ';

		    if($total>=1 && $page<=$numberPages){
				$count=$init+1;
				$pag_init=$init+1;
				foreach($data as $rows){
					$tabla.='
						   <tr>
                    <td>'.$count.'</td>
                    <td>'.$rows['user_name'].' '.$rows['user_lastname'].'</td>
                    <td>'.$rows['user_user'].'</td>
                    <td>'.$rows['user_email'].'</td>
                    <td>'.date("d-m-Y",strtotime($rows['birthdate'])).'</td>
                    <td>'.date("d-m-Y h:i:s A",strtotime($rows['user_created'])).'</td>
                    <td>'.date("d-m-Y h:i:s A",strtotime($rows['user_updated'])).'</td>
                    <td>
                        <a href="'.APP_URL.'userPhoto/'.$rows['user_id'].'/" class="btn btn-info btn-sm">Foto</a>
                    </td>
                    <td>
                        <a href="'.APP_URL.'userUpdate/'.$rows['user_id'].'/" class="btn btn-success btn-sm">Actualizar</a>
                    </td>
                    <td>
                        <form class="FormAjax" action="'.APP_URL.'app/ajax/userAjax.php" method="POST" autocomplete="off">
                            <input type="hidden" name="modulo_usuario" value="eliminar">
                            <input type="hidden" name="user_id" value="'.$rows['user_id'].'">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
					';
					$count++;
				}
				$pag_end=$count-1;
			}else{
				if($total>=1){
					$tabla.='
                <tr>
                    <td colspan="10" class="text-center">
                        <a href="'.$url.'1/" class="btn btn-primary btn-sm mt-4 mb-4">
                            Haga clic acá para recargar el listado
                        </a>
                    </td>
                </tr>
					';
				}else{
					$tabla.='
                <tr>
                    <td colspan="10" class="text-center">
                        No hay registros en el sistema
                    </td>
                </tr>
					';
				}
			}

			$tabla.='
			 </tbody>
            </table>
        </div>';

			### pagecion ###
			if($total>=0 && $page<=$numberPages){
				$tabla.='<p class="has-text-right">Mostrando usuarios <strong>'.$pag_init.'</strong> al <strong>'.$pag_end.'</strong> de un <strong>total de '.$total.'</strong></p>';

				$tabla.=$this->pagerTables($page,$numberPages,$url,10);
			}

			return $tabla;
		}

}
