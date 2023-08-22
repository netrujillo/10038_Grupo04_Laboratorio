<?php
	
	session_start();
	if($_SESSION['rol'] != 1){
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST)){

		$alert = '';

		if(empty($_POST['nombre']) || empty($_POST['capital']) || empty($_POST['moneda']) || empty($_POST['plato'])){
			$alert = '<div class="alert alert-danger msg_error" role="alert">Todos los campos son obligatorios.</div>';
		}else{

			$nombre = $_POST['nombre'];
			$capital = $_POST['capital'];
			$moneda = $_POST['moneda'];
			$plato = $_POST['plato'];
			$usuario_id = $_SESSION['idUser'];

			$foto = $_FILES['foto'];
			$nombre_foto = $foto['name'];
			$type = $foto['type'];
			$url_temp = $foto['tmp_name'];

			$imgProducto = 'img_producto.png';

			if($nombre_foto != ''){
				$destino = 'img/uploads/';
				$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
				$imgProducto = $img_nombre.'.jpg';
				$src = $destino.$imgProducto;
			}

			$query_insert = mysqli_query($conection, "INSERT INTO pais(nombrepais,capital,moneda,plato,usuario_id,foto) VALUES('$nombre', '$capital', '$moneda','$plato','$usuario_id', '$imgProducto')");

			if($query_insert){
				if($nombre_foto != ''){
					move_uploaded_file($url_temp,$src);
				}
				$alert = '<div class="alert alert-success msg_save" role="alert">País guardado exitosamente</div>';
			}else{
				$alert = '<div class="alert alert-danger msg_error" role="alert">Error al guardar país</div>';
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
	<title>Registro de países</title>
</head>

<body>
	<?php include "includes/header.php"; ?>
	<div class="tile formularios">
        <h3 class="tile-title">Registrar País</h3>
        <hr>
        <div class="alerta"><?php echo isset($alert) ? $alert : ''; ?></div>
            <div class="tile-body">
              	<form method="post" action="" enctype="multipart/form-data">
                	<div class="form-group">
                  		<label class="control-label">Nombre:</label>
                  		<input class="form-control" type="text" name="nombre" placeholder="Nombre del país" onkeyup="this.value=Letras(this.value)">
                	</div>
                	<div class="form-group">
                  		<label class="control-label">Capital:</label>
                  		<input class="form-control" type="text" name="capital" placeholder="Capital del país" onkeyup="this.value=Letras(this.value)">
                	</div>
                	<div class="form-group">
                  		<label class="control-label">Moneda:</label>
                  		<input class="form-control" type="text" name="moneda" placeholder="Moneda oficial" onkeyup="this.value=Letras(this.value)">
                	</div>
                	<div class="form-group">
                  		<label class="control-label">Plato:</label>
                  		<input class="form-control" type="text" name="plato" placeholder="Plato típico" onkeyup="this.value=Letras(this.value)">
                	</div>
                	
		            <div class="photo">
						<label for="foto">Bandera:</label>
					    <div class="prevPhoto">
					        <span class="delPhoto notBlock">X</span>
					        <label for="foto"></label>
					    </div>
					    <div class="upimg">
					        <input type="file" name="foto" id="foto" accept="image/png, .jpeg, .jpg, image/gif">
					    </div>
					    <div id="form_alert"></div>
					</div>
					 

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