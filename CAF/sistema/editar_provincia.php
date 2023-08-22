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

			$idprovincia = $_POST['id'];
			$nombre = $_POST['nombre'];
			$pais = $_POST['pais'];


				$sql_update = mysqli_query($conection, "UPDATE provincia SET nombre_provincia = '$nombre',pais_id = '$pais' WHERE idprovincia= '$idprovincia' ");
				
				if($sql_update){
					$alert = '<div class="alert alert-success msg_save" role="alert">Provincia actualizada exitosamente</div>';
				}else{
					$alert = '<div class="alert alert-danger msg_error" role="alert">Error al actualizar provincia</div>';
				}
		}
	}

//mostrar datos
if(empty($_REQUEST['id'])){
	header('Location: lista_provincias.php');
	mysqli_close($conection);
}
$idprovincia = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT u.idprovincia, u.nombre_provincia, r.nombrepais FROM provincia u INNER JOIN pais r ON u.pais_id = r.idpais WHERE idprovincia = $idprovincia AND u.estatus=1");

$result_sql = mysqli_num_rows($sql);


if($result_sql > 0){
	$data_provincia = mysqli_fetch_assoc($sql);
}else{
	header("location: lista_provincias.php");
}

if($result_sql == 0){
	header("location: lista_provincias.php");
}else{
	$option = '';
	while ($data = mysqli_fetch_array($sql)){
		$idprovincia = $data['idprovincia'];
		$nombre = $data['nombre_provincia'];
		$pais = $data['nombrepais'];

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
	<title>Actualizar Provincia</title>
</head>
<body>
	<?php include "includes/header.php"; ?>

	<div class="tile formularios">
            <h3 class="tile-title">Actualizar Provincia</h3>
            <hr>
            <div class="alerta"><?php echo isset($alert) ? $alert : ''; ?></div>
            <div class="tile-body">
              <form method="post" action="">
              	<input type="hidden" name="id" value="<?php echo $idprovincia; ?>">
                <div class="form-group">
                  <label class="control-label">Nombre:</label>
                  <input class="form-control" type="text" name="nombre" placeholder="Nombre de la provincia" value="<?php echo $data_provincia['nombre_provincia']; ?>" onkeyup="this.value=Letras(this.value)">
                </div>
                <label for="pais">País:</label>

								<?php
								include "../conexion.php";
								$query_pais = mysqli_query($conection, "SELECT idpais, nombrepais FROM pais WHERE estatus = 1");
								mysqli_close($conection);
								$result_pais = mysqli_num_rows($query_pais);

								?>
								<select name="pais" id="pais" class="form-select notItemOne" aria-label="Default select example" >

								<option value="<?php echo $data_provincia["idpais"]; ?>" selected>
									<?php echo $data_provincia["nombrepais"]; ?>
								</option>
								<?php

									if($result_pais>0){
										while($pais = mysqli_fetch_array($query_pais)){
								?>
										<option value="<?php echo $pais["idpais"]; ?>">
											<?php echo $pais["nombrepais"] ?></option>
								<?php
										}
									}

								?>
							</select>
				
				<div class="tile-footer">
	              	<button type="hidden" class="btn btn-secondary"> 
	              	<a class="cancelar" href="lista_provincias.php" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a></button>
	              	<button class="btn btn-primary registrar" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>
            	</div>
              </form>
            </div>
            
          </div>

</body>
</html>