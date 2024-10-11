<div class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title text-center text-uppercase mb-4">Login</h5>
                        <form action="" method="POST" autocomplete="off">
                            <div class="mb-3">
                                <label for="login_usuario" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="login_usuario" name="login_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
                            </div>
                            <div class="mb-3">
                                <label for="login_clave" class="form-label">Clave</label>
                                <input type="password" class="form-control" id="login_clave" name="login_clave" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
                            </div>
                            <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /*
	if(isset($_POST['login_usuario']) && isset($_POST['login_clave'])){
		$insLogin->iniciarSesionControlador();
	}
*/?>