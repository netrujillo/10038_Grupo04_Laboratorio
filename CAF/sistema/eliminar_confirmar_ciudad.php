<?php
	session_start();
	if($_SESSION['rol'] != 1){
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST)){

		if(empty($_POST['idciudad'])){
				header("location: lista_ciudades.php");
				mysqli_close($conection);
				exit;
		}

		$idciudad = $_POST['idciudad'];
		// $query_delete = mysqli_query($conection, "DELETE FROM usuario WHERE idusuario=$idusuario ");
		$query_delete = mysqli_query($conection, "UPDATE ciudad SET estatus=0 WHERE idciudad=$idciudad");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_ciudades.php");
		}else{
			echo "Error al eliminar";
		}
	}

	if(empty($_REQUEST['id'])){
		header("location: lista_ciudades.php");
		mysqli_close($conection);
	}else{
		$idciudad = $_REQUEST['id'];
		$query = mysqli_query($conection, "SELECT u.idciudad, u.nombre_ciudad, u.postal, r.nombre_provincia FROM ciudad u INNER JOIN provincia r ON u.provincia_id = r.idprovincia WHERE idciudad = $idciudad");
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)){
				$nombre = $data['nombre_ciudad'];
				$provincia = $data['nombre_provincia'];
				$postal = $data['postal'];
			}
		}else{
			header("location: lista_ciudades.php");
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Eliminar ciudad</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
		<div class="data_delete">
			<i class="fa-solid fa-triangle-exclamation fa-7x ico_delete"></i>
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>Nombre: <span><?php echo $nombre; ?></span></p>
			<p>Postal: <span><?php echo $postal; ?></span></p>
			<p>Provincia a la que pertenece: <span><?php echo $provincia; ?></span></p>
				
				<a href="lista_ciudades.php" class="btn_cancel"><i class="fa-solid fa-ban"></i> Cancelar</a>
				<!-- <input type="submit" value="Aceptar" class="btn_ok"> -->
				<button type="button" class="btn_ok" data-bs-toggle="modal" data-bs-target="#miModal2"><i class="fa-solid fa-trash-can"></i> Eliminar</button>

		</div>

<div class="modal fade" id="miModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">¿Estás seguro de eliminar?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        La ciudad se eliminará definitivamente del servidor.
      </div>
      <form method="post" action="">
      	<input type="hidden" name="idciudad" value="<?php echo $idciudad; ?>">
          <div class="modal-footer">
            <button type="button" class="btn btn-success cancelar btn_ok" data-bs-dismiss="modal"><i class="fa-solid fa-ban"></i> No, cancelar</button>
            <button type="submit" class="btn btn-danger salir"><i class="fa-solid fa-trash-can"></i> Sí, eliminar</button>
          </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>