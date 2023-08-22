<?php
$alert = "";
session_start();

if(!empty($_SESSION['active'])){
        header('location: quiz.php');
}else{
    if(!empty($_POST))
    {
        if(empty($_POST['user']) || empty($_POST['contrasena']))
        {
            $alert = "Ingrese su usuario y su contraseña";
        }else{
            require_once(__DIR__ . "/conexion.php");
            global $conection;

            $user = mysqli_real_escape_string($conection, $_POST['user']);
            $pass = mysqli_real_escape_string($conection, $_POST['contrasena']);

            $query = mysqli_query($conection, "SELECT * FROM cliente WHERE usuario = '$user' AND clave = '$pass'");
            mysqli_close($conection);
            $result = mysqli_num_rows($query);

            if($result > 0){
                $data = mysqli_fetch_array($query);
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $data['id_cliente'];
                $_SESSION['user'] = $data['usuario'];

                header('location: quiz.php');
            }else{
                $alert = "El usuario o contraseña son incorrectos";
                session_destroy();
            }
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>CAF</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">CAF</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link" href="../index.html">MUNDO</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">Acerca de</a></li>
                        <li class="nav-item"><a class="nav-link" href="#services">Servicios</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">Países</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">Quiz</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Configuración</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">

                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold">Confederación Africana de Fútbol</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-white-75 mb-5">La Confederación Africana de Fútbol: Guiando el Rumbo del Fútbol Africano. Desde emocionantes torneos hasta el desarrollo de jóvenes talentos, nuestra misión es impulsar la grandeza del fútbol en África y trascender las fronteras del deporte hacia la unidad y la cultura compartida en todo el continente.</p>
                        <a class="btn btn-primary btn-xl" href="#about">Averigua mas</a>
                    </div>
                </div>
            </div>
        </header>
        <!-- About-->
        <section class="page-section bg-primary" id="about">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="text-white mt-0">"¡Experimenta la Excelencia del Fútbol Africano!

                        </h2>
                        <hr class="divider divider-light" />
                        <p class="text-white-75 mb-4">El sitio web de la Confederación Africana de Fútbol (CAF) te ofrece una puerta de entrada al mundo de la excelencia del fútbol africano. Explora nuestra diversa gama de temas de código abierto, gratuitos para usar, que te ayudarán a mostrar tu pasión por el hermoso deporte. Eleva tu sitio web con los temas fáciles de usar de la CAF: ¡tu viaje para crear una plataforma de fútbol dinámica comienza aquí!"</p>
                        <a class="btn btn-light btn-xl" href="#services">Ver mas</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container px-4 px-lg-5">
                <h2 class="text-center mt-0">CAF</h2>
                <hr class="divider" />
                <div class="row gx-4 gx-lg-5">
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-gem fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Historia y Logros</h3>
                            <p class="text-muted mb-0">Explora la destacada historia de la CAF y sus logros en competencias internacionales.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-laptop fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Competiciones y Torneos</h3>
                            <p class="text-muted mb-0">Detalla emocionantes torneos como la Copa Africana de Naciones y la Liga de Campeones de la CAF.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-globe fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Desarrollo del Fútbol en África:</h3>
                            <p class="text-muted mb-0">Conoce cómo la CAF promueve el fútbol a través de programas juveniles y mejoras en infraestructura.</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center">
                        <div class="mt-5">
                            <div class="mb-2"><i class="bi-heart fs-1 text-primary"></i></div>
                            <h3 class="h4 mb-2">Impacto Social y Cultural</h3>
                            <p class="text-muted mb-0">Descubre cómo el fútbol africano une a las personas y enriquece la cultura a lo largo del continente.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Portfolio-->
        <div id="portfolio">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-4 col-sm-6">
                        <a href="plantilla/argelia.php" target="_black" title="Project Name">
                            <img class="img-fluid imagenes" src="assets/img/portfolio/thumbnails/1.jpg" alt="..." />         
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="plantilla/egipto.php" target="_black" title="Project Name">
                            <img class="img-fluid imagenes" src="assets/img/portfolio/thumbnails/5.jpg" alt="..." />         
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="plantilla/sudafrica.php" target="_black" title="Project Name">
                            <img class="img-fluid imagenes" src="assets/img/portfolio/thumbnails/3.jpg" alt="..." />
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">¿Deseas realizar un Quizz para probar tu aprendizaje?</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">¡Inicia sesión o regístrate para empezar!</p>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">

                        <form id="contactForm" data-sb-form-api-token="API_TOKEN" action="" method="post">
                            <div class="form-floating mb-3">
                                <input class="form-control" name="user" id="user" type="text" placeholder="Ingresa un usuario" data-sb-validations="required" />
                                <label for="user">Usuario</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">El usuario es requerido.</div>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" name="contrasena" id="contrasena" type="password" data-sb-validations="required" />
                                <label for="contrasena">Contraseña</label>
                                <div class="invalid-feedback" data-sb-feedback="name:required">La contraseña es requerida.</div>
                            </div>

                            <label class="alert" id="alerta"><?php echo isset($alert) ? $alert : '';  ?></label>

                            <div class="d-grid"><button class="btn btn-primary btn-xl" id="submitButton" type="submit">Ingresar</button></div>
                            <br>
                        </form>
                        <div class="d-grid" id="registrar_cliente"><button class="btn btn-dark btn-xl">Registrarse</button></div>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-4 text-center mb-5 mb-lg-0">
                        <i class="bi-phone fs-2 mb-3 text-muted"></i>
                        <div>+1 (555) 123-4567</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">FIFA &copy; 2023 - CAF</div></div>
        </footer>
        <script>
            document.getElementById("registrar_cliente").addEventListener("click", function() {
              window.open("registro_cliente.php", "_blank");
            });
        </script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
