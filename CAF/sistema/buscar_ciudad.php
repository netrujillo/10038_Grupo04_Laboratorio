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
	<title>Lista Ciudades</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<h2 class="titulos">Lista de ciudades</h2>

	<?php
		$busqueda = strtolower($_REQUEST['busqueda']);
		if(empty($busqueda)){
				header('location: lista_ciudades.php');
				mysqli_close($conection);
		}
	?>

	<form action="buscar_ciudad.php" method="get" class="form_search">
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
		        <th scope="col">Código postal</th>
		        <th scope="col">Provincia perteneciente</th>
		        <th scope="col">Acciones</th>
	    	</tr>
	    </thead>
	    <?php

			//paginador

			$sql_registre = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM ciudad WHERE (idciudad LIKE '%busqueda%' OR nombre_ciudad LIKE '%busqueda%' OR postal LIKE '%busqueda%' OR provincia_id LIKE '%busqueda%') AND estatus = 1 ");
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

			$query = mysqli_query($conection, "SELECT u.idciudad, u.nombre_ciudad, u.postal, r.nombre_provincia FROM ciudad u INNER JOIN provincia r ON u.provincia_id = r.idprovincia 
								WHERE 
								(u.idciudad LIKE '%$busqueda%' OR 
								u.nombre_ciudad LIKE '%$busqueda%' OR 
								u.postal LIKE '%$busqueda%' OR 
								r.nombre_provincia LIKE '%$busqueda%') 
								AND 
								u.estatus = 1 ORDER BY u.idciudad ASC LIMIT $desde, $por_pagina");

			$result = mysqli_num_rows($query);
			if($result>0){
			while ($data = mysqli_fetch_array($query)){
		?>
	  <tbody>
	        <tr>
				<td><?php echo $data['idciudad']; ?></td>
				<td><?php echo $data['nombre_ciudad']; ?></td>
				<td><?php echo $data['postal']; ?></td>
				<td><?php echo $data['nombre_provincia']; ?></td>
				<td>
					<a class="link_edit" href="editar_ciudad.php?id=<?php echo $data['idciudad']; ?>"><i class="fa-solid fa-pen-to-square"></i> Editar</a>

					<a class="link_delete" href="eliminar_confirmar_ciudad.php?id=<?php echo $data['idciudad']; ?>"><i class="fa-solid fa-trash"></i> Eliminar</a>

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