<?php 
    session_start();
    require '../conexion.php';
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Registrarse</title>
</head>
<body style = "font-family: 'Open Sans', sans-serif;">
    <main>
        <form action="" method = "POST" name = "login">
            <div class="arriba">
                <img src="../img/Icono_Usuario.svg" alt="Icono">
                <div class="t">
                    <h2>Registrarse</h2>
                    <a href="../">Regresar</a>
                </div>
            </div>
            <div class="entrada">
                <label for="rol" class = "png"><img src="../img/Icono_libro.png" alt="rol"></label>
                <select name="rol" id="rol" required onclick="mostrar_esconder_alumno()">
                    <option value="0">Selecciona tu rol</option>
                    <option value="1">Profesor</option>
                    <option value="2">Alumno</option>
                </select>
            </div>
            <div class="entrada">
                <label for="usuario"><img src="../img/Icono_user.svg   " alt="usuario"></label>
                <input type="text" name="usuario" id="usuario" placeholder="Ingresa tu usuario" required>
            </div>
            <div class="entrada">
                <label for="password"><img src="../img/Icono_password.svg" alt="pass"></label>
                <input type="password" name="password" id="password" placeholder="Ingresa tu contraseña" required>
            </div>
            <div class="entrada">
                <label for="r_password" class = "verificar_c"><img src="../img/Verificar_contrasena.png" alt="pass"></label>
                <input type="password" name="r_password" id="r_password" placeholder="Vuelve a ingresar tu contraseña" required>
            </div>
            <div class="entrada" id = "f_alumno">
                <label for="clase" class = "png"><img src="../img/Icono_c_clase.png" alt="pass"></label>
                <input type="text" name="clase" id="clase" placeholder="Ingresa el código de tu clase">
            </div>
            <input type="submit" name = "enviado" value = "Registrarse">
        </form>
    </main>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/comportamiento.js"></script>
    <?php 
        if(isset($_POST['enviado'])){
            $uno = 1;
            $cero = 0;
            $user = $_POST['usuario'];
            $pass = $_POST['password'];
            $rol = $_POST['rol'];
            $cod = $_POST['clase'];
            if($rol == 0){
                echo "<script>  rol_incorrecto(); </script>";
            }else{
                if($pass != $_POST['r_password']){
                    echo "<script> contrasenia_dispareja(); </script>";
                }else{
                    if($rol == 2){
                        $sql = "SELECT * FROM clases WHERE codigo = '$cod'";
                        $datos = mysqli_query($con, $sql);
                        $clase = NULL;
                        while($row = mysqli_fetch_assoc($datos)){
                            $clase = $row;
                        }
                        if($clase != NULL){
                            $sql = "INSERT INTO usuarios (usuario, password, es_profesor) VALUES ('$user','$pass', '$cero')";
                            $datos = mysqli_query($con, $sql);
                            $sql = "SELECT * FROM usuarios";
                            $datos = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($datos)){
                                $usuario = $row;
                            }
                            $id_usuario = $usuario['id_usuario'];
                            $sql = "SELECT * FROM clases";
                            $datos = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($datos)){
                                $clase = $row;
                            }
                            $id_clase = $clase['id_clase'];
                            $sql = "INSERT INTO alumnos (id_usuario, id_clase) VALUES ('$id_usuario', '$id_clase')";
                            $datos = mysqli_query($con, $sql);
                            echo "<script> registro_exitoso(); </script>";
                        }else{
                            echo "<script> error_clase(); </script>";
                        }
                    }else{
                        $sql = "INSERT INTO usuarios (usuario, password, es_profesor) VALUES ('$user','$pass', '$uno')";
                        $datos = mysqli_query($con, $sql);
                        echo "<script> registro_exitoso(); </script>";
                    }
                }
            }
        }   
    ?>
</body>
</html>