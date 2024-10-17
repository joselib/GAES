<div class="container-fluid mb-6 text-center">
    <?php 
        $id = $insLogin->cleanChain($url[1]);
        if($id == $_SESSION['id']){ 
    ?>
    <h1 class="display-4">Mi foto de perfil</h1>
    <h2 class="h5">Actualizar foto de perfil</h2>
    <h2 class="h5">Actualizar foto de perfil</h2>
    <?php } else { ?>
    <h1 class="display-4">Usuarios</h1>
    <h2 class="h5">Actualizar foto de perfil</h2>
    <?php } ?>
</div>
<div class="container py-4">
    <?php
        include "./app/views/inc/btn_back.php";
        $data = $insLogin->selectData("Only","users","user_id",$id);
        if($data->rowCount() == 1){
            $data = $data->fetch();
    ?>
    <h2 class="text-center mb-4"><?php echo $data['user_name'] . " " . $data['user_lastname']; ?></h2>
    <p class="text-center mb-4 pb-6"><?php echo "<strong>Usuario creado:</strong> " . date("d-m-Y  h:i:s A", strtotime($data['user_created'])) . "   <strong>Usuario actualizado:</strong> " . date("d-m-Y  h:i:s A", strtotime($data['user_updated'])); ?></p>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <?php if (is_file("./app/views/photos/" . $data['user_photo'])) { ?>
            <figure class="figure mb-6">
                <img class="rounded-circle" src="<?php echo APP_URL; ?>app/views/photos/<?php echo $data['user_photo']; ?>" alt="Foto de perfil">
            </figure>
            <form class="FormAjax" action="<?php echo APP_URL; ?>app/ajax/usersAjax.php" method="POST" autocomplete="off">
                <input type="hidden" name="module_user" value="deletePhoto">
                <input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">
                <p class="text-center">
                    <button type="submit" class="btn btn-danger rounded-pill">Eliminar foto</button>
                </p>
            </form>
            <?php } else { ?>
            <figure class="figure mb-6">
                <img class="rounded-circle" src="<?php echo APP_URL; ?>app/views/photos/photo_default_user.svg" alt="Foto de perfil por defecto">
            </figure>
            <?php } ?>
        </div>
        <div class="col-md-7">
            <form class="mb-6 text-center FormAjax" action="<?php echo APP_URL; ?>app/ajax/usersAjax.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="module_user" value="upPhoto">
                <input type="hidden" name="user_id" value="<?php echo $data['user_id']; ?>">
                <label for="user_photo">Foto o imagen del usuario</label><br>
                <div class="mb-3">
                    <label for="user_photo" class="form-label">Seleccione una foto</label>
                    <input class="form-control" type="file" id="user_photo" name="user_photo" accept=".jpg, .png, .jpeg">
                    <div class="form-text">JPG, JPEG, PNG. (MAX 5MB)</div>
                </div>
                <p class="text-center">
                    <button type="submit" class="btn btn-success rounded-pill">Actualizar foto</button>
                </p>
            </form>
        </div>
    </div>
    <?php
        } else {
            include "./app/views/inc/error_alert.php";
        }
    ?>
</div>
