<div class="container-fluid mb-6 text-center">
    <h1 class="display-4">Usuarios</h1>
    <h2 class="h4">Lista de usuario</h2>
</div>
<div class="container py-6 text-center">
    <div class="form-rest mb-6 mt-6"></div>

    <?php
        use app\controllers\userController;

        $insUser = new userController();

        echo $insUser->listUserController($url[1], 15, $url[0], "");
    ?>
</div>
