<?php session_start(); 
    require '../conexion.php';
    $caracteres_validos = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    $valido = false;
    
    $id_usuario = $_SESSION['id_usuario'];
    $es_profesor = $_SESSION['es_profesor'];
    $profesor = 0;
    $clase = 0;
    $clases = array();
    $codigos = array();
    $sql = "SELECT * FROM clases WHERE id_profesor = '$id_usuario'";
    $datos = mysqli_query($con, $sql);
    while($row = mysqli_fetch_assoc($datos)){
        $clases[] = $row;
    }
    foreach($clases as $i => $clave){
        $codigos[] = $clave['codigo'];
    }
    while(!$valido){
        $nueva_clase = substr(str_shuffle($caracteres_validos), 0, 10);
        $valido = !in_array($nueva_clase, $codigos);
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
            <h1>Simulaciones</h1>
            <article id="encabezados">
                <h3> </h3>
                <h3>Id de la clase</h3>
                <h3>Clave de la clase</h3>
            </article>
                <?php foreach($clases as $iteracion => $fila): ?>
                    <article class="clases_d">
                    <a href="../ver_alumnos/?clase=<?php echo $fila['id_clase']; ?>" class = "n_button" name = "clase" style="text-decoration:none;">
                        <article style="width: 64%;">
                            <p class = "icono_a"><img src="../img/Icono_de_clase.png" alt="Imagen clase"></p>
                            <p><?php echo $fila['id_clase']; ?></p>
                        </article>
                    </a>
                    <button type="button" onclick="copiar_codigo('<?php echo $fila['codigo']?>')" class = "n_button" style="width: 16.6666%"><?php echo $fila['codigo']; ?><img src="../img/Icono_copiar.png" alt="Copiar" style="width:20%"></button>
                    </article>
                <?php endforeach; ?>
            <form action="" method="POST" class = "n_form">
                <button type="submit" value = "<?php echo $nueva_clase; ?>" class = "n_button" name = "nueva_clase" id = "nueva_simulacion">
                    Crear nueva clase
                </button>
            </form>
        </section>
    </main>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/comportamiento.js"></script>
    <?php
        if(!isset($_SESSION['id_usuario']) || !$es_profesor){
            echo "<script> no_deberias_estar_aqui(); </script>";
        }
        if(isset($_POST['nueva_clase'])){
            $nueva = $_POST['nueva_clase'];
            $sql = "INSERT INTO clases (id_profesor, codigo) VALUES ('$id_usuario','$nueva_clase')";
            $datos = mysqli_query($con, $sql);
            echo "<script> clase_creada('$nueva_clase'); </script>";
        }
        if(isset($_POST['clase_ver'])){
            header("Location: ../ver_alumnos/?clase=".$_POST['clase_ver'], TRUE, 301);
            die();
        }
    ?>
</body>
</html>