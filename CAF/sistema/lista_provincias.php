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
	<title>Lista Provincias</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<h2 class="titulos">Lista de provincias</h2>
	<form action="buscar_provincia.php" method="get" class="form_search">
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
		        <th scope="col">País</th>
		        <th scope="col">Acciones</th>
	    	</tr>
	    </thead>
	    <?php

			//paginador
			$sql_registre = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM provincia WHERE estatus = 1 ");
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

			$query = mysqli_query($conection, "SELECT u.idprovincia, u.nombre_provincia, r.nombrepais FROM provincia u INNER JOIN pais r ON u.pais_id = r.idpais WHERE u.estatus = 1 ORDER BY idprovincia ASC LIMIT $desde,$por_pagina");

			mysqli_close($conection);
			$result = mysqli_num_rows($query);
			if($result>0){
				while ($data = mysqli_fetch_array($query)){
		?>
	  <tbody>
	    <tr>
				<td><?php echo $data['idprovincia']; ?></td>
				<td><?php echo $data['nombre_provincia']; ?></td>
				<td><?php echo $data['nombrepais']; ?></td>
				<td>
					<a class="link_edit" href="editar_provincia.php?id=<?php echo $data['idprovincia']; ?>"><i class="fa-solid fa-pen-to-square"></i> Editar</a>

					<a class="link_delete" href="eliminar_confirmar_provincia.php?id=<?php echo $data['idprovincia']; ?>"><i class="fa-solid fa-trash"></i> Eliminar</a>

				</td>
			</tr>
	  </tbody>
	  	<?php
				}
			}
		?>
	</table>

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

</body>
</html>