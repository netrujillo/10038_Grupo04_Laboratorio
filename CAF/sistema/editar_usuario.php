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

			include "../conexion.php";

			$idUsuario = $_POST['id'];
			$nombre = $_POST['nombre'];
			$telefono = $_POST['telefono'];
			$user = $_POST['usuario'];
			$clave = md5($_POST['clave']);
			$rol = $_POST['rol'];


			$query = mysqli_query($conection, "SELECT * FROM usuario WHERE (usuario = '$user' AND idusuario != $idUsuario) OR (telefono = '$telefono' AND idusuario != $idUsuario)");

			$result = mysqli_fetch_array($query);
			

			if($result > 0){
				$alert = '<div class="alert alert-danger msg_error" role="alert">El teléfono o el usuario ya existe.</div>';
			}else{
				if(empty($_POST['clave'])){
					$sql_update = mysqli_query($conection, "UPDATE usuario SET nombre = '$nombre', telefono='$telefono', usuario='$user', rol='$rol' WHERE idusuario=$idUsuario ");
				}else{
					$sql_update = mysqli_query($conection, "UPDATE usuario SET nombre = '$nombre', telefono='$telefono', usuario='$user', clave='$clave', rol='$rol' WHERE idusuario=$idUsuario ");
				}

				if($sql_update){
					$alert = '<div class="alert alert-success msg_save" role="alert">Usuario actualizado exitosamente</div>';
				}else{
					$alert = '<div class="alert alert-danger msg_error" role="alert">Error al actualizar usuario.</div>';
				}
			}
		}

	}

//mostrar datos
if(empty($_REQUEST['id'])){
	header('Location: lista_usuarios.php');
	mysqli_close($conection);
}
$iduser = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.telefono, u.usuario, (u.rol) as idrol, (r.rol) as rol FROM usuario u INNER JOIN rol r on u.rol = r.idrol WHERE idusuario = $iduser AND estatus=1");

$result_sql = mysqli_num_rows($sql);

if($result_sql == 0){
	header('Location: lista_usuarios.php');
}else{
	$option = '';
	while ($data = mysqli_fetch_array($sql)){
		$iduser = $data['idusuario'];
		$nombre = $data['nombre'];
		$telefono = $data['telefono'];
		$usuario = $data['usuario'];
		$idrol = $data['idrol'];
		$rol = $data['rol'];

		if($idrol == 1){
			$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
		}else if($idrol == 2){
			$option = '<option value="'.$idrol.'" select>'.$rol.'</option>';
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
              	<input type="hidden" name="id" value="<?php echo $iduser; ?>">
                <div class="form-group">
                  <label class="control-label">Nombre:</label>
                  <input class="form-control" type="text" name="nombre" placeholder="Nombre completo" onkeyup="this.value=Letras(this.value)" value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Teléfono:</label>
                  <input class="form-control" type="text" name="telefono" placeholder="Número de teléfono celular" maxlength="10" minlength="7" onkeyup="this.value=Numeros(this.value)" value="<?php echo $telefono; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Usuario:</label>
                  <input class="form-control" type="text" name="usuario" placeholder="Ejm: admin123" onkeyup="this.value=Caracteres(this.value)" value="<?php echo $usuario; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Contraseña:</label>
                  <input class="form-control" name="clave" type="password">
                </div>
                <label for="rol">Tipo Usuario:</label>

                <?php
                	include "../conexion.php";
					$query_rol = mysqli_query($conection, "SELECT * FROM rol");
					mysqli_close($conection);
					$result_rol = mysqli_num_rows($query_rol);
                ?>

				<select name="rol" id="rol" class="form-select notItemOne" aria-label="Default select example">
					<?php
						echo $option;
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
	              	<button class="btn btn-primary registrar" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>
            	</div>
              </form>
            </div>
            
          </div>

</body>
</html>