<?php
    session_start();
    include "conexion.php";

    if(!empty($_POST)){

        $alert = '';

        if(empty($_POST['user_cliente']) || empty($_POST['clave_cliente']) ){
            $alert = '<div class="alert alert-danger msg_error" role="alert">Todos los campos son obligatorios.</div>';
        }else{

            $user_cliente = $_POST['user_cliente'];
            $clave_cliente = $_POST['clave_cliente'];

            $query = mysqli_query($conection, "SELECT * FROM cliente WHERE usuario = '$user_cliente' ");
            $result = mysqli_fetch_array($query);

            if($result > 0){
                $alert = '<div class="alert alert-danger msg_error" role="alert">El usuario ya existe.</div>';
            }else{
                $query_insert = mysqli_query($conection, "INSERT INTO cliente(usuario,clave) VALUES('$user_cliente','$clave_cliente')");

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
    <link rel="stylesheet" type="text/css" href="sistema/css/bootstrap.min.css">
    <script type="text/javascript" src="sistema/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="sistema/js/jquery.min.js"></script>
    <script type="text/javascript" src="js/fo.js"></script>
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <title>Login - QUIZ</title>
</head>
<body>
    <div class="padre">
        <img src="assets/img/fondo2.jpg" alt="fondo 1" id="fondo">
        <div class="hijo">
            <div class="nieto">
                <form class="login" action="" method="post">
                <h2 id="title">REGISTRARSE</h2>
                <div class="alerta"><?php echo isset($alert) ? $alert : ''; ?></div>
                <img src="assets/img/africa.png" id="usuario">
                <div class="input-container">
                    <i class="fa-solid fa-user input-icon"></i>
                    <input type="text" id="user" name="user_cliente" placeholder="Ingrese un usuario" required>
                </div>
                <div class="input-container">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input type="password" id="password" name="clave_cliente" placeholder="Ingrese una clave" required>
                </div>
                <input type="submit" value="Registrarse" id="ingresar">
            </form>
            </div>
        </div>
    </div>
</body>
</html>