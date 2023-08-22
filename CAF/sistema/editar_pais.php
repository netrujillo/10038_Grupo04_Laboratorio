<?php
	
	session_start();
	if($_SESSION['rol'] != 1){
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST)){

		$alert = '';

		if(empty($_POST['nombre']) || empty($_POST['capital']) || empty($_POST['moneda']) || empty($_POST['plato']) || empty($_POST['id']) || empty($_POST['foto_actual']) || empty($_POST['foto_remove'])){
			$alert = '<div class="alert alert-danger msg_error" role="alert">Todos los campos son obligatorios.</div>';
		}else{

			$idpais = $_POST['id'];
			$capital = $_POST['capital'];
			$nombre = $_POST['nombre'];
			$moneda = $_POST['moneda'];
			$plato = $_POST['plato'];
			$imgProducto = $_POST['foto_actual'];
			$imgRemove = $_POST['foto_remove'];
			

			$foto = $_FILES['foto'];
			$nombre_foto = $foto['name'];
			$type = $foto['type'];
			$url_temp = $foto['tmp_name'];

			$upd = '';

			if($nombre_foto != ''){
				$destino = 'img/uploads/';
				$img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
				$imgProducto = $img_nombre.'.jpg';
				$src = $destino.$imgProducto;
			}else{
				if($_POST['foto_actual'] != $_POST['foto_remove']){
					$imgProducto = 'img_producto.png';
				}
			}

			$query_insert = mysqli_query($conection, "UPDATE pais SET nombrepais = '$nombre', capital = '$capital', moneda = '$moneda',  plato = '$plato', foto = '$imgProducto' WHERE idpais = '$idpais' ");

			if($query_insert){

				if(($nombre_foto != '' && ($_POST['foto_actual'] != 'img_producto.png')) || ($_POST['foto_actual'] != $_POST['foto_remove'])){
					unlink('img/uploads/'.$_POST['foto_actual']);
				}

				if($nombre_foto != ''){
					move_uploaded_file($url_temp,$src);
				}
				$alert = '<div class="alert alert-success msg_save" role="alert">País actualizado exitosamente</div>';
			}else{
				$alert = '<div class="alert alert-danger msg_error" role="alert">Error al actualizar país</div>';
			}
		}	
	}

	//validar producto
	if(empty($_REQUEST['id'])){
		header("location: lista_paises.php");
	}else{
		$idpais = $_REQUEST['id'];
		if(!is_numeric($idpais)){
			header("location: lista_paises.php");
		}

		$query_producto = mysqli_query($conection, "SELECT idpais, nombrepais, capital, moneda, plato, foto FROM pais WHERE idpais=$idpais AND estatus = 1 ");
		$result_producto = mysqli_num_rows($query_producto);

		$foto = '';
		$classRemove = 'notBlock';

		if($result_producto > 0){
			$data_producto = mysqli_fetch_assoc($query_producto);
			if($data_producto['foto'] != 'img_producto.png'){
				$classRemove = '';
				$foto = '<img id="img" src="img/uploads/'.$data_producto['foto'].'" alt="Producto">';
			}

		}else{
			header("location: lista_paises.php");
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
              	<input type="hidden" name="id" value="<?php echo $data_producto['idpais']; ?>">
				<input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $data_producto['foto']; ?>">
				<input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $data_producto['foto']; ?>">
                	<div class="form-group">
                  		<label class="control-label">Nombre:</label>
                  		<input class="form-control" type="text" name="nombre" placeholder="Nombre del país" onkeyup="this.value=Letras(this.value)" value="<?php echo $data_producto['nombrepais']; ?>">
                	</div>
                	<div class="form-group">
                  		<label class="control-label">Capital:</label>
                  		<input class="form-control" type="text" name="capital" placeholder="Capital del país" onkeyup="this.value=Letras(this.value)" value="<?php echo $data_producto['capital']; ?>">
                	</div>
                	<div class="form-group">
                  		<label class="control-label">Moneda:</label>
                  		<input class="form-control" type="text" name="moneda" placeholder="Moneda oficial" onkeyup="this.value=Letras(this.value)" value="<?php echo $data_producto['moneda']; ?>">
                	</div>
                	<div class="form-group">
                  		<label class="control-label">Plato:</label>
                  		<input class="form-control" type="text" name="plato" placeholder="Plato típico" onkeyup="this.value=Letras(this.value)" value="<?php echo $data_producto['plato']; ?>">
                	</div>
                	
		           <div class="photo">
						<label for="foto">Foto</label>
				        <div class="prevPhoto">
				        <span class="delPhoto <?php echo $$classRemove; ?>">X</span>
				        <label for="foto"></label>
				        <?php echo $foto; ?>
				        </div>
				        <div class="upimg">
				        <input type="file" name="foto" id="foto" accept="image/png, .jpeg, .jpg, image/gif">
				        </div>
				        <div id="form_alert"></div>
					</div>
					 

				<div class="tile-footer">
	              	<button type="hidden" class="btn btn-secondary"> 
	              	<a class="cancelar" href="lista_paises.php" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a></button>
	              	<button class="btn btn-primary registrar" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>
            	</div>
              </form>
            </div>
          </div>

</body>
</html>