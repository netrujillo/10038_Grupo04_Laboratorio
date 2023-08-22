<?php
	session_start();
	if($_SESSION['rol'] != 1){
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST)){

		if(empty($_POST['idprovincia'])){
				header("location: lista_provincias.php");
				mysqli_close($conection);
				exit;
		}

		$idprovincia = $_POST['idprovincia'];
		// $query_delete = mysqli_query($conection, "DELETE FROM usuario WHERE idusuario=$idusuario ");
		$query_delete = mysqli_query($conection, "UPDATE provincia SET estatus=0 WHERE idprovincia=$idprovincia");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_provincias.php");
		}else{
			echo "Error al eliminar";
		}
	}

	if(empty($_REQUEST['id'])){
		header("location: lista_provincias.php");
		mysqli_close($conection);
	}else{
		$idprovincia = $_REQUEST['id'];
		$query = mysqli_query($conection, "SELECT u.idprovincia, u.nombre_provincia, r.nombrepais FROM provincia u INNER JOIN pais r ON u.pais_id = r.idpais WHERE idprovincia = $idprovincia");
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)){
				$nombre = $data['nombre_provincia'];
				$pais = $data['nombrepais'];
			}
		}else{
			header("location: lista_provincias.php");
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Eliminar provincia</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
		<div class="data_delete">
			<i class="fa-solid fa-triangle-exclamation fa-7x ico_delete"></i>
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>Nombre: <span><?php echo $nombre; ?></span></p>
			<p>País que pertenece: <span><?php echo $pais; ?></span></p>
				
				<a href="lista_provincias.php" class="btn_cancel"><i class="fa-solid fa-ban"></i> Cancelar</a>
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
        La provincia se eliminará definitivamente del servidor.
      </div>
      <form method="post" action="">
      	<input type="hidden" name="idprovincia" value="<?php echo $idprovincia; ?>">
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