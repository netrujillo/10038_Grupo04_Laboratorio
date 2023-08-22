<?php
    include "../conexion.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Argelia</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script type="text/javascript" src="js/fo.js"></script>
 
</head>

<body>
    <!-- Navbar Start -->
    <div class="container-fluid bg-light position-relative shadow">
        <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0 px-lg-5">
            <a href="" class="navbar-brand font-weight-bold text-secondary" style="font-size: 50px;">
                <i class="fa-solid fa-earth-africa"></i>
        <?php

            $query_name = mysqli_query($conection, "SELECT nombrepais, capital, moneda, plato, foto FROM pais WHERE idpais=3");

            $result = mysqli_num_rows($query_name);

            if($result>0){
                while ($data = mysqli_fetch_array($query_name)){
                    if($data['foto'] != "img_producto.png"){
                        $foto = '../sistema/img/uploads/'.$data['foto'];
                    }else{
                        $foto = 'img/'.$data['foto'];
                    }
        ?>
                <span class="text-primary"><td><?php echo $data['nombrepais']; ?></span>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav font-weight-bold mx-auto py-0">
                    <a href="index.html" class="nav-item nav-link active">Home</a>
                </div>
            </div>
        </nav>
    </div>
    <!-- Header Start -->
    <div class="container-fluid bg-primary px-0 px-md-5 mb-5">
        <div class="row align-items-center px-3">
            <div class="col-lg-6 text-center text-lg-left">
                <h4 class="text-white mb-4 mt-5 mt-lg-0">Toda la información del país aquí ;)</h4>
                <h1 class="display-3 font-weight-bold text-white" style="text-transform: uppercase;"><?php echo $data['nombrepais']; ?></h1>
                <p class="text-white mb-4">Argelia es un país de África del Norte con una costa en el Mediterráneo y un interior en el desierto del Sahara. Muchos imperios dejaron su legado aquí, como las antiguas ruinas romanas en Tipasa, junto al mar.</p>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <img src="<?php echo $foto; ?>" alt="<?php echo $data['nombrepais']; ?>" style="clip-path: ellipse(45% 37% at 50% 50%); width: 30rem; height: 30rem;">
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- Facilities Start -->
    <div class="container-fluid pt-5">
        <div class="container pb-3">
            <div class="row">
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px;">
                        <i class="fa-solid fa-location-dot h1 text-primary mb-3"></i>
                        <div class="pl-4">
                            <h4>Capital:</h4>
                            <p class="m-0"><?php echo $data['capital']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px;">
                        <i class="fa-solid fa-coins h1 text-primary mb-3"></i>
                        <div class="pl-4">
                            <h4>Moneda:</h4>
                            <p class="m-0"><?php echo $data['moneda']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 pb-1">
                    <div class="d-flex bg-light shadow-sm border-top rounded mb-4" style="padding: 30px;">
                        <i class="fa-solid fa-utensils h1 text-primary mb-3"></i>
                        <div class="pl-4">
                            <h4>Plato típico:</h4>
                            <p class="m-0"><?php echo $data['plato']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    }
    ?>

    <h2 style="text-align: center;">PROVINCIAS</h2>

    <table class="table table-striped table-hover" style="width: 30rem; margin: 0 auto; text-align: center; margin-bottom: 10rem;">
        <thead class="table-info">
            <tr>
                <th scope="col">Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php
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

            $query_provincias = mysqli_query($conection, "SELECT idprovincia, nombre_provincia FROM provincia WHERE pais_id=3 AND estatus = 1 ORDER BY idprovincia ASC LIMIT $desde,$por_pagina");

            $result_provincias = mysqli_num_rows($query_provincias);
            if($result_provincias>0){
                while ($data_provincias = mysqli_fetch_array($query_provincias)){

            ?>
        <tr>
            <td><?php echo $data_provincias['nombre_provincia']; ?></td>
        </tr>
      </tbody>
          <?php
        }
    }
    ?>
    </table>

    <h2 style="text-align: center;">CIUDADES</h2>

    <table class="table table-striped table-hover" style="width: 30rem; margin: 0 auto; text-align: center; margin-bottom: 5rem;">
        <thead class="table-info">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Postal</th>
                <th scope="col">Provincia a la que pertenece</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql_registre = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM ciudad WHERE estatus = 1 ");
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

            $query_ciudades = mysqli_query($conection, "SELECT u.idciudad, u.nombre_ciudad, u.postal, r.nombre_provincia, r.pais_id FROM ciudad u INNER JOIN provincia r ON u.provincia_id = r.idprovincia AND r.pais_id=3 WHERE u.estatus = 1 ORDER BY idciudad ASC LIMIT $desde,$por_pagina");;

            mysqli_close($conection);
            $result_ciudades = mysqli_num_rows($query_ciudades);
            if($result_ciudades>0){
                while ($data_ciudades = mysqli_fetch_array($query_ciudades)){

            ?>
        <tr>
            <td><?php echo $data_ciudades['nombre_ciudad']; ?></td>
            <td><?php echo $data_ciudades['postal']; ?></td>
            <td><?php echo $data_ciudades['nombre_provincia']; ?></td>
        </tr>
      </tbody>
          <?php
        }
    }
    ?>
    </table>

    
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary p-3 back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->

    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    
</body>

</html>