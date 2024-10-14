<div class="container-fluid mb-6 text-center">
    <h1 class="display-4">Usuarios</h1>
    <h2 class="h4">Nuevo usuario</h2>
</div>

<div class="container py-6 d-flex justify-content-center">

    <form class="FormAjax" action="<?php echo APP_URL; ?>app/ajax/usersAjax.php" method="POST" autocomplete="off" enctype="multipart/form-data" style="max-width: 600px; width: 100%;">

        <input type="hidden" name="module_user" value="registre">

        <div class="row mb-3">
            <div class="col">
                <div class="mb-3">
                    <label for="user_name" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="user_lastname" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="user_lastname" name="user_lastname" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <div class="mb-3">
                    <label for="user_user" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="user_user" name="user_user" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="user_email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="user_email" name="user_email" maxlength="70">
                </div>
            </div>
        </div>
                <div class="row mb-3">
                     <div class="col">
                         <div class="mb-3">
                    <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                     </div>
                </div>


                </div>
        <div class="row mb-3">
            <div class="col">
                <div class="mb-3">
                    <label for="user_password_1" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="user_password_1" name="user_password_1" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="user_password_2" class="form-label">Repetir Contraseña</label>
                    <input type="password" class="form-control" id="user_password_2" name="user_password_2" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <div class="mb-3">
                    <label for="user_photo" class="form-label">Seleccione una foto</label>
                    <input class="form-control" type="file" id="user_photo" name="user_photo" accept=".jpg, .png, .jpeg">
                    <div class="form-text">JPG, JPEG, PNG. (MAX 5MB)</div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="reset" class="btn btn-outline-primary rounded-pill">Limpiar</button>
            <button type="submit" class="btn btn-primary rounded-pill">Guardar</button>
        </div>
    </form>
</div>
