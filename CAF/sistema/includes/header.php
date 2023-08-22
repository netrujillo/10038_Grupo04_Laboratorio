<?php
    require_once(__DIR__ . '/functions.php');

    if (!isset($_SESSION)) {
        session_start();
    }

	if(empty($_SESSION['active'])){
		header('location: ../');
	}

?>

<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="./css/header.css">
<script type="text/javascript" src="./js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="./js/fo.js"></script>
<script type="text/javascript" src="./js/jquery.min.js"></script>
<script type="text/javascript" src="./js/validaciones.js"></script>
<script type="text/javascript" src="./js/functions.js"></script>


<header class="d-flex flex-wrap justify-content-center py-3 mb-0 border-bottom cabezera">
      <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto">
        <svg class="bi me-2" width="50" height="32"></svg>
        <span class="fs-4">PAÍSES - CAF</span>
      </div>

      <ul class="nav nav-pills">
        <li class="nav-item nav-link contenido">Ecuador, <?php echo fechaC(); ?></li>
        <li class="nav-item nav-link contenido"><?php echo $_SESSION['user'].' - '.$_SESSION['rol']; ?></li>
        <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#miModal"><img class="close" src="img/salir.png"></a></li>
      </ul>
</header>
<?php include "nav.php"; ?>

<div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">¿Estás seguro de salir?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        La sesión se cerrará
      </div>
      <form method="post" action="./salir.php">
          <div class="modal-footer">
            <button type="button" class="btn btn-success cancelar" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i> Cancelar</button>
            <button type="submit" class="btn btn-danger salir"><i class="fa-solid fa-right-from-bracket"></i> Salir</button>
          </div>
      </form>
    </div>
  </div>
</div>
