<div class="container-fluid mb-6 text-center">
    <?php 
        $id = $insLogin->cleanChain($url[1]);
        $isCurrentUser = ($id == $_SESSION['id']);
    ?>
    <h1 class="display-4"><?php echo $isCurrentUser ? 'Mi cuenta' : 'Usuarios'; ?></h1>
    <h2 class="h4"><?php echo $isCurrentUser ? 'Actualizar cuenta' : 'Actualizar usuario'; ?></h2>
</div>

<div class="container py-6 d-flex justify-content-center">
    <?php
        $data = $insLogin->selectData("Only","users","user_id",$id);
        if($data->rowCount() == 1){
            $data = $data->fetch();
    ?>
    <form class="FormAjax" action="<?php echo APP_URL; ?>app/ajax/usersAjax.php" method="POST" autocomplete="off" style="max-width: 600px; width: 100%;">
        <input type="hidden" name="module_user" value="update">
        <input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">

        <div class="row mb-3">
            <div class="col">
                <div class="mb-3">
                    <label for="user_name" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" value="<?php echo $data['user_name']; ?>" required>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="user_lastname" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="user_lastname" name="user_lastname" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" value="<?php echo $data['user_lastname']; ?>" required>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <div class="mb-3">
                    <label for="user_user" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="user_user" name="user_user" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" value="<?php echo $data['user_user']; ?>" required>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="user_email" name="user_email" maxlength="70" value="<?php echo $data['user_email']; ?>">
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <div class="mb-3">
                    <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" value="<?php echo $data['birthdate']; ?>" required>
                </div>
            </div>
        </div>

        <div class="alert alert-info text-center my-4">
            Si desea actualizar la contraseña de este usuario, por favor llene los 2 campos. Si no desea actualizar la contraseña, deje los campos vacíos.
        </div>

        <div class="row mb-3">
            <div class="col">
                <div class="mb-3">
                    <label for="user_password_1" class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control" id="user_password_1" name="user_password_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="user_password_2" class="form-label">Repetir nueva Contraseña</label>
                    <input type="password" class="form-control" id="user_password_2" name="user_password_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100">
                </div>
            </div>
        </div>

        <div class="alert alert-warning text-center my-4">
            Para poder actualizar los datos de este usuario, por favor ingrese su usuario y contraseña con la que ha iniciado sesión.
        </div>

        <div class="row mb-3">
            <div class="col">
                <div class="mb-3">
                    <label for="admin_user" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="admin_user" name="admin_user" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="admin_password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="admin_password" name="admin_password" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="<?php echo APP_URL; ?>userList/" class="btn btn-secondary rounded-pill me-2">Regresar</a>
            <button type="submit" class="btn btn-primary rounded-pill">Actualizar</button>
        </div>
    </form>
    <?php
        } else {
            include "./app/views/inc/error_alert.php";
        }
    ?>
</div>

