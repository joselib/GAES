<!-- Main content area -->
    <div class="col main-content">
      <div class="container-fluid h-100 d-flex flex-column justify-content-start align-items-center py-3">
        <h1 class="display-4 text-center mb-4">Home</h1>
        <div class="row justify-content-center">
          <div class="col-auto">
            <figure class="figure">
              <?php 
              if(is_file("./app/views/photos/".$_SESSION['photo'])){
                echo '<img src="'.APP_URL.'app/views/photos/'.$_SESSION['photo'].'" class="figure-img img-fluid rounded-circle" style="width: 128px; height: 128px; object-fit: cover;" alt="User profile picture">';
              } else {
                echo '<img src="'.APP_URL.'app/views/photos/photo_default_user.svg" class="figure-img img-fluid rounded-circle" style="width: 128px; height: 128px; object-fit: cover;" alt="Default profile picture">';
              }
              ?>
            </figure>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-auto">
            <h2 class="h3 text-center">¡Bienvenido <?php echo htmlspecialchars($_SESSION['name']." ".$_SESSION['lastname'], ENT_QUOTES, 'UTF-8'); ?>!</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>