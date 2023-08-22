<?php
	session_start();
	if($_SESSION['rol'] != 1){
		header("location: ./");
	}
	include "../conexion.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Lista Usuarios</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<h2 class="titulos">Lista de usuarios</h2>

	<?php
		$busqueda = strtolower($_REQUEST['busqueda']);
		if(empty($busqueda)){
				header('location: lista_usuarios.php');
				mysqli_close($conection);
		}
	?>

	<form action="buscar_usuario.php" method="get" class="form_search">
		<div class="form-group">
			<input class="form-control" type="text" name="busqueda" id="busqueda" placeholder="Buscar">
		</div>
		<button type="submit" class="btn_search"><i class="fa-solid fa-magnifying-glass"></i></button>
	</form>
	
	<table class="table table-striped table-hover">
	    <thead class="table-info">
	    	<tr>
		      	<th scope="col">ID</th>
		        <th scope="col">Nombre</th>
		        <th scope="col">Teléfono</th>
		        <th scope="col">Usuario</th>
		        <th scope="col">Rol</th>
		        <th scope="col">Acciones</th>
	    	</tr>
	    </thead>
	    <?php

			//paginador

			$rol = '';
			if($busqueda == 'administrador'){
				$rol = "OR rol LIKE '%1%'";
			}else if($busqueda == 'cliente'){
				$rol = "OR rol LIKE '%2%'";
			}

			$sql_registre = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM usuario WHERE (idusuario LIKE '%busqueda%' OR nombre LIKE '%busqueda%' OR telefono LIKE '%busqueda%' OR usuario LIKE '%busqueda%' $rol) AND estatus = 1 ");
			$result_registre = mysqli_fetch_array($sql_registre);
			$total_registro = $result_registre['total_registro'];

			$por_pagina = 4;

			if(empty($_GET['pagina'])){
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde= ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.telefono, u.usuario, r.rol FROM usuario u INNER JOIN rol r ON u.rol = r.idrol 
								WHERE 
								(u.idusuario LIKE '%$busqueda%' OR 
								u.nombre LIKE '%$busqueda%' OR 
								u.telefono LIKE '%$busqueda%' OR 
								u.usuario LIKE '%$busqueda%' OR
								r.rol LIKE '%$busqueda%') 
								AND 
								estatus = 1 ORDER BY u.usuario ASC LIMIT $desde, $por_pagina");

			$result = mysqli_num_rows($query);
			if($result>0){
				while ($data = mysqli_fetch_array($query)){
		?>
	  <tbody>
	        <tr>
				<td><?php echo $data['idusuario']; ?></td>
				<td><?php echo $data['nombre']; ?></td>
				<td><?php echo $data['telefono']; ?></td>
				<td><?php echo $data['usuario']; ?></td>
				<td><?php echo $data['rol']; ?></td>
				<td>
					<a class="link_edit" href="editar_usuario.php?id=<?php echo $data['idusuario']; ?>"><i class="fa-solid fa-pen-to-square"></i> Editar</a>

					<?php if($data["idusuario"] != 1){ ?>
					<a class="link_delete" href="eliminar_confirmar_usuario.php?id=<?php echo $data['idusuario']; ?>"><i class="fa-solid fa-trash"></i> Eliminar</a>
				<?php } ?>
				</td>
			</tr>
	  </tbody>
	  	<?php
				}
			}
		?>
	</table>

	<?php
		if($total_registro != 0){
	?>

	<div class="paginador">
			<ul>
				<?php
					if($pagina != 1){
				?>
					<li><a href="?pagina=<?php echo 1; ?>"><i class="fa-solid fa-backward-step"></i></a></li>
					<li><a href="?pagina=<?php echo $pagina-1; ?>"><i class="fa-solid fa-backward"></i></a></li>
				<?php
					}
					for ($i=1; $i <= $total_paginas; $i++){
						if($i==$pagina){
							echo '<li class="pageSelected">'.$i.'</li>';
						}else{
							echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
						}
					}

					if($pagina != $total_paginas){
				?>	
					<li><a href="?pagina=<?php echo $pagina + 1; ?>"><i class="fa-solid fa-forward"></i></a></li>
					<li><a href="?pagina=<?php echo $total_paginas; ?> "><i class="fa-solid fa-forward-step"></i></a></li>
				<?php } ?>
			</ul>
		</div>
	<?php } ?>

</body>
</html>