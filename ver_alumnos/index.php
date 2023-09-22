<?php session_start(); 
    require '../conexion.php';
    $id_usuario = $_SESSION['id_usuario'];
    $es_profesor = $_SESSION['es_profesor'];
    $clase_ver  = $_GET['clase'];

    $profesor = 0;
    $clase = 0;
    $alumnos = array();
    $sql = "SELECT * FROM alumnos WHERE id_clase = '$clase_ver'";
    $datos = mysqli_query($con, $sql);
    while($row = mysqli_fetch_assoc($datos)){
        $alumnos[] = $row;
    }
    $sql = "SELECT * FROM clases WHERE id_clase = '$clase_ver'";
    $datos = mysqli_query($con, $sql);
    while($row = mysqli_fetch_assoc($datos)){
        $clase_nombre = $row['codigo'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/clases.css">
    <title>Clases de <?php echo $_SESSION['usuario']; ?></title>
</head>
<body style = "font-family: 'Open Sans', sans-serif;">
    <main>
        <header>
            <p><?php echo $_SESSION['usuario']; ?></p>
            <a href="../simulaciones" style = "color: #000">Mis simulaciones</a>
            <button type="button" onclick="salir()" id = "log_out"><img src="../img/Icono_salir.png" alt="Salir"></button>   
        </header>
        <section>
            <h1>Alumnos de la clase <?php echo $clase_nombre; ?></h1>
            <article id="encabezados">
                <h3> </h3>
                <h3>Nombre del alumno:</h3>
                <h3> </h3>
            </article>
                <form action="../simulaciones/" method = "get" class = "n_form">
                <?php foreach($alumnos as $iteracion => $fila): ?>
                    <?php 
                        $id_usuario_ver = $fila['id_usuario'];
                        $sql = "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario_ver'";
                        $datos = mysqli_query($con, $sql);
                        while($row = mysqli_fetch_assoc($datos)){
                            $nombre_usuario = $row['usuario'];
                        }
                    ?>
                    <article>
                        <p class = "icono_a"><img src="../img/Icono_Usuario.svg" alt="Imagen usuario"></p>
                        <p><?php echo $nombre_usuario; ?></p>
                        <p>
                            <button type="submit" value = "<?php echo $id_usuario_ver; ?>" name = "id_alumno" class = "n_button ver_alumno">Ver simulaciones del alumno</button>
                        </p>
                        <?php
                            $_SESSION['profesor'] = $id_usuario;
                            $_SESSION['clase'] = $clase_ver;
                        ?>
                    </article>
                <?php endforeach; ?>
                </form>
        </section>
    </main>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/comportamiento.js"></script>
    <?php
        if(!isset($_SESSION['id_usuario']) || !$es_profesor){
            echo "<script> no_deberias_estar_aqui(); </script>";
        }
    ?>
</body>
</html>