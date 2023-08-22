<?php
	
	session_start();
	if($_SESSION['rol'] != 1){
		header("location: ./");
	}

	include "../conexion.php";

	if(!empty($_POST)){

		$alert = '';

		if(empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['usuario']) ||empty($_POST['clave']) || empty($_POST['rol'])){
			$alert = '<div class="alert alert-danger msg_error" role="alert">Todos los campos son obligatorios.</div>';
		}else{

			$nombre = $_POST['nombre'];
			$telefono = $_POST['telefono'];
			$user = $_POST['usuario'];
			$clave = md5($_POST['clave']);
			$rol = $_POST['rol'];


			$query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario = '$user' OR telefono = '$telefono' ");
			$result = mysqli_fetch_array($query);

			if($result > 0){
				$alert = '<div class="alert alert-danger msg_error" role="alert">El teléfono o el usuario ya existe.</div>';
			}else{
				$query_insert = mysqli_query($conection, "INSERT INTO usuario(nombre,telefono,usuario,clave,rol) VALUES('$nombre','$telefono','$user','$clave','$rol')");

				if($query_insert){
					$alert = '<div class="alert alert-success msg_save" role="alert">Usuario creado exitosamente</div>';
				}else{
					$alert = '<div class="alert alert-danger msg_error" role="alert">Error al crear usuario</div>';
				}
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
	<title>Registrar Usuario</title>
</head>
<body>
	<?php include "includes/header.php"; ?>

	<div class="tile formularios">
            <h3 class="tile-title">Registrar Usuario</h3>
            <hr>
            <div class="alerta"><?php echo isset($alert) ? $alert : ''; ?></div>
            <div class="tile-body">
              <form method="post" action="">
                <div class="form-group">
                  <label class="control-label">Nombre:</label>
                  <input class="form-control" type="text" name="nombre" placeholder="Nombre completo" onkeyup="this.value=Letras(this.value)">
                </div>
                <div class="form-group">
                  <label class="control-label">Teléfono:</label>
                  <input class="form-control" type="text" name="telefono" placeholder="Número de teléfono celular" maxlength="10" minlength="7" onkeyup="this.value=Numeros(this.value)">
                </div>
                <div class="form-group">
                  <label class="control-label">Usuario:</label>
                  <input class="form-control" type="text" name="usuario" placeholder="Ejm: admin123" onkeyup="this.value=Caracteres(this.value)">
                </div>
                <div class="form-group">
                  <label class="control-label">Contraseña:</label>
                  <input class="form-control" name="clave" type="password">
                </div>
                <label for="rol">Tipo Usuario:</label>

				<select name="rol" id="rol" class="form-select" aria-label="Default select example">
					<?php
						$query_rol = mysqli_query($conection, "SELECT * FROM rol");
						mysqli_close($conection);
						$result_rol = mysqli_num_rows($query_rol);

						if($result_rol>0){
							while($rol = mysqli_fetch_array($query_rol)){
					?>
							<option value="<?php echo $rol["idrol"]; ?>"><?php echo $rol["rol"] ?></option>
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