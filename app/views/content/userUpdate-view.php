<div class="container-fluid mb-6 text-center">
    <?php 
        $id = $insLogin->cleanChain($url[1]);
        if($id == $_SESSION['id']){ 
    ?>
    <h1 class="display-4">Mi cuenta</h1>
    <h2 class="lead">Actualizar cuenta</h2>
    <?php } else { ?>
    <h1 class="display-4">Usuarios</h1>
    <h2 class="lead">Actualizar usuario</h2>
    <?php } ?>
</div>

<div class="container py-8 d-flex justify-content-center">
    <?php
        include "./app/views/inc/btn_back.php";
        $data = $insLogin->selectData("Only","users","user_id",$id);
        if($data->rowCount() == 1){
            $data = $data->fetch();
    ?>

    <h2 class="text-center mb-4"><?php echo $data['user_name']." ".$data['user_lastname']; ?></h2>

    <p class="text-center mb-4">
        <?php echo "<strong>Usuario creado:</strong> ".date("d-m-Y  h:i:s A", strtotime($data['user_created']))." &nbsp; <strong>Usuario actualizado:</strong> ".date("d-m-Y  h:i:s A", strtotime($data['user_updated'])); ?>
    </p>

    <form class="FormAjax" action="<?php echo APP_URL; ?>app/ajax/usersAjax.php" method="POST" autocomplete="off">
        <input type="hidden" name="module_user" value="update">
        <input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_name" class="form-label">Nombres</label>
                    <input class="form-control" type="text" id="user_name" name="user_name" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" value="<?php echo $data['user_name']; ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_lastname" class="form-label">Apellidos</label>
                    <input class="form-control" type="text" id="user_lastname" name="user_lastname" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" value="<?php echo $data['user_lastname']; ?>" required>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_user" class="form-label">Usuario</label>
                    <input class="form-control" type="text" id="user_user" name="user_user" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" value="<?php echo $data['user_user']; ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_email" class="form-label">Email</label>
                    <input class="form-control" type="email" id="user_email" name="user_email" maxlength="70" value="<?php echo $data['user_email']; ?>">
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
                    <input class="form-control" type="date" id="birthdate" name="birthdate" value="<?php echo $data['birthdate']; ?>">
                </div>
            </div>
        </div>

        <div class="alert alert-info text-center my-4">
            SI desea actualizar la Contraseña de este usuario por favor llene los 2 campos. Si NO desea actualizar la Contraseña deje los campos vacíos.
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_password_1" class="form-label">Nueva Contraseña</label>
                    <input class="form-control" type="password" id="user_password_1" name="user_password_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_password_2" class="form-label">Repetir nueva Contraseña</label>
                    <input class="form-control" type="password" id="user_password_2" name="user_password_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                </div>
            </div>
        </div>

        <div class="alert alert-warning text-center my-4">
            Para poder actualizar los datos de este usuario por favor ingrese su USUARIO y CONTRASEÑA con la que ha iniciado sesión
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="admin_user" class="form-label">Usuario</label>
                    <input class="form-control" type="text" id="admin_user" name="admin_user" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="admin_password" class="form-label">Contraseña</label>
                    <input class="form-control" type="password" id="admin_password" name="admin_password" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success rounded-pill">Actualizar</button>
        </div>
    </form>
    <?php
        } else {
            include "./app/views/inc/error_alert.php";
        }
    ?>
</div>