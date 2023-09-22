<?php 
    session_start();
    require 'conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Simulador de 4 barras de longitud modificable - Login</title>
</head>
<body style = "font-family: 'Open Sans', sans-serif;">
    <main>
        <form action="" method = "POST" name = "login">
            <div class="arriba">
                <img src="img/Icono_Usuario.svg" alt="Icono">
                <div class="t">
                    <h2>Iniciar Sesión</h2>
                    <a href="registrar/">Registrarse</a>
                </div>
            </div>
            <div class="entrada">
                <label for="usuario"><img src="img/Icono_user.svg   " alt="usuario"></label>
                <input type="text" name="usuario" id="usuario" placeholder="Ingresa tu usuario">
            </div>
            <div class="entrada">
                <label for="password"><img src="img/Icono_password.svg" alt="pass"></label>
                <input type="password" name="password" id="password" placeholder="Ingresa tu contraseña">
            </div>
            <input type="submit" name = "enviado" value = "Ingresar">
        </form>
    </main>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/comportamiento.js"></script>
    <?php 
    if(isset($_POST['enviado'])){
        $user = $_POST['usuario'];
        $pass = $_POST['password'];
        $sql = "SELECT * FROM usuarios WHERE usuario = '$user'";
        $datos = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($datos)){
            $usuario = $row;
        }
        $id = $usuario['id_usuario'];
        if(isset($usuario)){
            if($usuario['password'] == $pass){
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['usuario'] = $usuario['usuario'];
                $_SESSION['es_profesor'] = $usuario['es_profesor'];
                if(!$_SESSION['es_profesor']){
                    $sql = "SELECT * FROM alumnos WHERE id_usuario = '$id'";
                    $datos = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($datos)){
                        $clase = $row;
                    }
                    $_SESSION['clase'] = $clase['id_clase'];
                    $id_clase = $_SESSION['clase'];
                    $sql = "SELECT * FROM clases WHERE id_clase = '$id_clase'";
                    $datos = mysqli_query($con, $sql);
                    while($row = mysqli_fetch_assoc($datos)){
                        $clase = $row;
                    }
                    $_SESSION['profesor'] = $clase['id_profesor'];
                    $_SESSION['clave_clase'] = $clase['codigo'];
                }
                echo "<script> login_exitoso(); </script>";
            }else{
                echo "<script> contrasenia_incorrecta(); </script>";
            }
        }else{
            echo "<script> usuario_inexistente(); </script>";
        }
    }
    ?>
</body>
</html>