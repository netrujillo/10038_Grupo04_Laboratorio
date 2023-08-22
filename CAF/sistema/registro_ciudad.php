<?php
	
	session_start();
	if($_SESSION['rol'] != 1){
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST)){

		$alert = '';

		if(empty($_POST['nombre']) || empty($_POST['provincia']) || empty($_POST['postal'])){
			$alert = '<div class="alert alert-danger msg_error" role="alert">Todos los campos son obligatorios.</div>';
		}else{

			$nombre = $_POST['nombre'];
			$postal = $_POST['postal'];
			$provincia = $_POST['provincia'];
			$usuario_id = $_SESSION['idUser'];

			$query_insert = mysqli_query($conection, "INSERT INTO ciudad(nombre_ciudad,provincia_id,postal,usuario_id) VALUES('$nombre','$provincia', '$postal', '$usuario_id') ");

			if($query_insert){
				$alert = '<div class="alert alert-success msg_save" role="alert">Ciudad guardada exitosamente</div>';
			}else{
				$alert = '<div class="alert alert-danger msg_error" role="alert">Error al guardar ciudad</div>';
			}
		}	
	}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/validaciones.js"></script>
	<title>Registrar Ciudad</title>
</head>
<body>
	<?php include "includes/header.php"; ?>

	<div class="tile formularios">
            <h3 class="tile-title">Registrar Ciudad</h3>
            <hr>
            <div class="alerta"><?php echo isset($alert) ? $alert : ''; ?></div>
            <div class="tile-body">
              <form method="post" action="">
                <div class="form-group">
                  <label class="control-label">Nombre:</label>
                  <input class="form-control" type="text" name="nombre" placeholder="Nombre de la ciudad" onkeyup="this.value=Letras(this.value)">
                </div>
                <div class="form-group">
                  <label class="control-label">Código postal:</label>
                  <input class="form-control" type="text" name="postal" placeholder="Código postal de la ciudad">
                </div>
                <label for="provincia">Provincia:</label>

								<select name="provincia" id="provincia" class="form-select" aria-label="Default select example">

								<?php

								$query_provincia = mysqli_query($conection, "SELECT idprovincia, nombre_provincia FROM provincia WHERE estatus = 1");
					
								$result_provincia = mysqli_num_rows($query_provincia);
								mysqli_close($conection);

								?>
								<?php
									if($result_provincia>0){
										while($provincia = mysqli_fetch_array($query_provincia)){
								?>
										<option value="<?php echo $provincia["idprovincia"]; ?>"><?php echo $provincia["nombre_provincia"] ?></option>
								<?php
										}
									}

								?>
							</select>
				
				<div class="tile-footer">
	              	<button type="hidden" class="btn btn-secondary"> 
	              	<a class="cancelar" href="index.php" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a></button>
	              	<button class="btn btn-primary registrar" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>
            	</div>
              </form>
            </div>
            
          </div>

</body>
</html>