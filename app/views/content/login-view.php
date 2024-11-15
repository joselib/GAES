<div class="bg-light">
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">
        <div class="row g-0 bg-white shadow rounded-3 overflow-hidden" style="max-width: 900px;">
            <div class="col-md-6 p-4 p-md-5">
                <h2 class="text-center mb-4 fw-bold text-primary">Bienvenido</h2>
                <form action="<?php echo APP_URL; ?>login/" method="POST" autocomplete="off">
                    <div class="mb-3">
                        <label for="login_user" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="login_user" name="login_user" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
                    </div>
                    <div class="mb-3">
                        <label for="login_password" class="form-label">Clave</label>
                        <input type="password" class="form-control" id="login_password" name="login_password" pattern="[a-zA-Z0-9$@.-]{7,100}" maxlength="100" required>
                    </div>
                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 d-none d-md-block gradient-custom">
                <div class="h-100 d-flex flex-column justify-content-center align-items-center text-white p-5">
                    <h3 class="fw-bold mb-4 text-center">El éxito es la suma de pequeños esfuerzos repetidos día tras día.</h3>
                    <p class="text-center mb-0">- Robert Collier</p>
                </div>
            </div>
        </div>
    </div>
</div>



<?php 
	if(isset($_POST['login_user']) && isset($_POST['login_password'])){
		$insLogin->initSessionController();
	}
?>