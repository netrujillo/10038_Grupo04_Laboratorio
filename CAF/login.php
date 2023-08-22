<?php
$alert = "";
session_start();

if(!empty($_SESSION['active'])){
		header('location: sistema/');
}else{
	if(!empty($_POST))
	{
		if(empty($_POST['usuario']) || empty($_POST['clave']))
		{
			$alert = "Ingrese su usuario y su contraseña";
		}else{
            require_once(__DIR__ . "/conexion.php");
            global $conection;

			$user = mysqli_real_escape_string($conection, $_POST['usuario']);
			$pass = mysqli_real_escape_string($conection, $_POST['clave']);

			$query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$pass'");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);

			if($result > 0){
				$data = mysqli_fetch_array($query);
				$_SESSION['active'] = true;
				$_SESSION['idUser'] = $data['idusuario'];
				$_SESSION['nombre'] = $data['nombre'];
				$_SESSION['telefono'] = $data['telefono'];
				$_SESSION['user'] = $data['usuario'];
				$_SESSION['rol'] = $data['rol'];

				header('location: sistema/');
			}else{
				$alert = "El usuario o contraseña son incorrectos";
				session_destroy();
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
	<script type="text/javascript" src="js/fo.js"></script>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<title>Login - CAF</title>
</head>
<body>
	<div class="padre">
		<img src="assets/img/fondo.jpg" alt="fondo 1" id="fondo">
		<div class="hijo">
			<div class="nieto">
				<form class="login" action="" method="post">
		        <h2 id="title">INICIAR SESIÓN</h2>
		        <img src="assets/img/africa.png" id="usuario">
		        <div class="input-container">
		        	<i class="fa-solid fa-user input-icon"></i>
			        <input type="text" id="user" name="usuario" placeholder="Usuario">
			    </div>
		    	<div class="input-container">
		    		<i class="fa-solid fa-lock input-icon"></i>
		        	<input type="password" id="password" name="clave" placeholder="Contraseña">
		        </div>
		        <label class="alert" id="alerta"><?php echo isset($alert) ? $alert : '';  ?></label>
		        <input type="submit" value="INGRESAR" id="ingresar">
	    	</form>
			</div>
		</div>
	</div>
</body>
</html>