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

			$idciudad = $_POST['id'];
			$nombre = $_POST['nombre'];
			$postal = $_POST['postal'];
			$provincia = $_POST['provincia'];

				$sql_update = mysqli_query($conection, "UPDATE ciudad SET nombre_ciudad = '$nombre',provincia_id = '$provincia', postal = '$postal' WHERE idciudad = '$idciudad' ");
				
				if($sql_update){
					$alert = '<div class="alert alert-success msg_save" role="alert">Ciudad actualizada exitosamente</div>';
				}else{
					$alert = '<div class="alert alert-danger msg_error" role="alert">Error al actualizar ciudad</div>';
				}
		}
	}

//mostrar datos
if(empty($_REQUEST['id'])){
	header('Location: lista_ciudades.php');
	mysqli_close($conection);
}
$idciudad = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT u.idciudad, u.nombre_ciudad, u.postal, r.nombre_provincia FROM ciudad u INNER JOIN provincia r ON u.provincia_id = r.idprovincia WHERE idciudad = $idciudad AND u.estatus=1");

$result_sql = mysqli_num_rows($sql);


if($result_sql > 0){
	$data_provincia = mysqli_fetch_assoc($sql);
}else{
	$option = '';
	while ($data = mysqli_fetch_array($sql)){
		$idciudad = $data['idciudad'];
		$nombre = $data['nombre_ciudad'];
		$postal = $data['postal'];
		$provincia = $data['nombre_provincia'];
	
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
	<title>Actualizar Ciudad</title>
</head>
<body>
	<?php include "includes/header.php"; ?>

	<div class="tile formularios">
            <h3 class="tile-title">Actualizar Ciudad</h3>
            <hr>
            <div class="alerta"><?php echo isset($alert) ? $alert : ''; ?></div>
            <div class="tile-body">
              <form method="post" action="">
              	<input type="hidden" name="id" value="<?php echo $idciudad; ?>">
                <div class="form-group">
                  <label class="control-label">Nombre:</label>
                  <input class="form-control" type="text" name="nombre" placeholder="Nombre de la ciudad" onkeyup="this.value=Letras(this.value)" value="<?php echo $data_provincia["nombre_ciudad"]; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Código postal:</label>
                  <input class="form-control" type="text" name="postal" placeholder="Código postal de la ciudad" value="<?php echo $data_provincia["postal"]; ?>">
                </div>
                <label for="provincia">Provincia:</label>

				<?php
				include "../conexion.php";
				$query_provincia = mysqli_query($conection, "SELECT * FROM provincia WHERE estatus = 1");
				mysqli_close($conection);
				$result_provincia = mysqli_num_rows($query_provincia);
				

				?>
				<select name="provincia" id="provincia" class="form-select notItemOne" aria-label="Default select example" >

				<option value="<?php echo $data_provincia["idprovincia"]; ?>" selected>
					<?php echo $data_provincia["nombre_provincia"]; ?>
				</option>
				<?php

					if($result_provincia>0){
						while($provincia = mysqli_fetch_array($query_provincia)){
				?>
						<option value="<?php echo $provincia["idprovincia"]; ?>">
							<?php echo $provincia["nombre_provincia"] ?></option>
				<?php
						}
					}

				?>
				</select>
				
				<div class="tile-footer">
	              	<button type="hidden" class="btn btn-secondary"> 
	              	<a class="cancelar" href="lista_ciudades.php" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a></button>
	              	<button class="btn btn-primary registrar" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>
            	</div>
              </form>
            </div>
            
          </div>

</body>
</html>