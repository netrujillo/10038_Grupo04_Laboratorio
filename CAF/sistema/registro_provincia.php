<?php
	
	session_start();
	if($_SESSION['rol'] != 1){
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST)){

		$alert = '';

		if(empty($_POST['nombre']) || empty($_POST['pais'])){
			$alert = '<div class="alert alert-danger msg_error" role="alert">Todos los campos son obligatorios.</div>';
		}else{

			$nombre = $_POST['nombre'];
			$pais = $_POST['pais'];
			$usuario_id = $_SESSION['idUser'];

			$query_insert = mysqli_query($conection, "INSERT INTO provincia(nombre_provincia,pais_id,usuario_id) VALUES('$nombre','$pais','$usuario_id') ");

			if($query_insert){
				$alert = '<div class="alert alert-success msg_save" role="alert">Provincia guardada exitosamente</div>';
			}else{
				$alert = '<div class="alert alert-danger msg_error" role="alert">Error al guardar provincia</div>';
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
	<title>Registrar Provincia</title>
</head>
<body>
	<?php include "includes/header.php"; ?>

	<div class="tile formularios">
            <h3 class="tile-title">Registrar Provincia</h3>
            <hr>
            <div class="alerta"><?php echo isset($alert) ? $alert : ''; ?></div>
            <div class="tile-body">
              <form method="post" action="">
                <div class="form-group">
                  <label class="control-label">Nombre:</label>
                  <input class="form-control" type="text" name="nombre" placeholder="Nombre de la provincia" onkeyup="this.value=Letras(this.value)">
                </div>
                <label for="pais">País:</label>

								<select name="pais" id="pais" class="form-select" aria-label="Default select example">

								<?php

								$query_pais = mysqli_query($conection, "SELECT idpais, nombrepais FROM pais WHERE estatus = 1");
					
								$result_pais = mysqli_num_rows($query_pais);
								mysqli_close($conection);

								?>
								<?php
									if($result_pais>0){
										while($pais = mysqli_fetch_array($query_pais)){
								?>
										<option value="<?php echo $pais["idpais"]; ?>"><?php echo $pais["nombrepais"] ?></option>
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