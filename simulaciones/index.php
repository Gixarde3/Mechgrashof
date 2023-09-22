<?php session_start(); 
    require '../conexion.php';
    $id_usuario = $_SESSION['id_usuario'];
    $es_profesor = $_SESSION['es_profesor'];
    if(isset($_GET['id_alumno'])){
        $id_usuario = $_GET['id_alumno'];
        $es_profesor = false;
    }
    $profesor = 0;
    $clase = 0;
    $clases_p = array();
    $simulaciones = array();
    if($es_profesor){
        $sql = "SELECT * FROM clases WHERE id_profesor = '$id_usuario'";
        $datos = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($datos)){
            $clase_act = $row['id_clase'];
            $clases_p[] = $row;
            $sql = "SELECT * FROM simulaciones WHERE id_clase = '$clase_act'";
            $resultado = mysqli_query($con, $sql);
            while($fila = mysqli_fetch_assoc($resultado)){
                $simulaciones[] = $fila;
            }
        }
    }else{
        $profesor = $_SESSION['profesor'];
        $clase = $_SESSION['clase'];
        $sql = "SELECT * FROM simulaciones WHERE id_creador = '$id_usuario' OR (id_creador = '$profesor' AND id_clase = '$clase');";
        $datos = mysqli_query($con, $sql);
        while($row = mysqli_fetch_assoc($datos)){
            $simulaciones[] = $row;
        }
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
    
    <title>Simulaciones de <?php echo $_SESSION['usuario']; ?></title>
</head>
<body style = "font-family: 'Open Sans', sans-serif;">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../js/comportamiento.js"></script>
    <main>
        <header>
            <p style = "width:40%;"><?php echo $_SESSION['usuario'] . (!$es_profesor && !isset($_GET['id_alumno'])? " - " . $_SESSION['clave_clase']: "");?> </p>
            <?php if($es_profesor || isset($_GET['id_alumno'])): ?>
                <a href="../clases" style = "color: #000">Mis clases</a>
            <?php endif; ?>
            <button type="button" onclick="salir()" id = "log_out"><img src="../img/Icono_salir.png" alt="Salir"></button>   
        </header>
        <section>
            <h1>Simulaciones</h1>
            <article id="encabezados">
                <h3> </h3>
                <h3>Nombre</h3>
                <h3>Fecha de creación</h3>
                <h3>Clase</h3>
                <h3>Intentos fallidos</h3>
                <h3>Creada por</h3>
            </article>
            <form action="../simulador/" method="get" class = "n_form">
                <?php foreach($simulaciones as $iteracion => $fila): ?>
                    <button type="submit" value = "<?php echo $fila['id_simulacion']; ?>" class = "n_button" name = "id_simulacion">
                        <article>
                            <p class = "icono_a"><img src="../img/Icono_archivo.png" alt="Imagen archivo"></p>
                            <p><?php echo $fila['nombre']; ?></p>
                            <p><?php echo $fila['fecha_subida']; ?></p>
                            <?php 
                                $clase_id = $fila['id_clase'];
                                $sql = "SELECT * FROM clases WHERE id_clase = '$clase_id'";
                                $datos_c = mysqli_query($con, $sql);
                                while($fila_c = mysqli_fetch_assoc($datos_c)){
                                    $clases = $fila_c;
                                }
                            ?>
                            <p><?php echo $clases['codigo']; ?></p>
                            <?php 
                                $clase_id = $fila['id_creador'];
                                $sql = "SELECT * FROM usuarios WHERE id_usuario = '$clase_id'";
                                $datos_c = mysqli_query($con, $sql);
                                while($fila_c = mysqli_fetch_assoc($datos_c)){
                                    $clases = $fila_c;
                                }
                            ?>
                            <p><?php echo $fila['intentos']?></p>
                            <p id= "creada_por"><?php echo $clases['usuario'] . ($clases['es_profesor'] ? '<img src="../img/Icono_de_profesor.png" alt="Es profesor" id="es_profesor">' : '' ); ?></p>
                        </article>
                    </button>
                <?php endforeach; ?>
                <button type="button" class = "n_button" id = "nueva_simulacion" onclick="crear(false)">Crear nueva simulación</button>
            </form>
        </section>
    </main>
    <div id="nueva_simulaion_d" style = "display:none;">
        <form action="" method="POST">
            <div class="arriba">
                <img src="../img/Icono_aniadir.png" alt="Icono">
                <div class="t">
                    <h2>Crear simulación</h2>
                </div>
            </div>
            <div class="entrada">
                <label for="nombre" class = "png"><img src="../img/Icono_nombre.png" alt="Nuevo nombre"></label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre de la simulación">
            </div>
            <?php if($es_profesor): ?>
            <div class="entrada">
                <label for="clase" class = "png"><img src="../img/Icono_c_clase.png" alt="clase"></label>
                <select name="clase_op" id="clase" required>
                    <?php foreach($clases_p as $i => $clase_cod): ?>
                        <option value="<?php echo $clase_cod['id_clase']; ?>"><?php echo $clase_cod['codigo']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php endif; ?>
            <input type="submit" name = "enviado" value = "Crear nueva simulación">
            <button type="button" id = "cerrar" onclick="crear(true)"><img src="../img/Icono_cerrar.png" alt="Cerrar"></button>
        </form>
    </div>
    <?php
        if(!isset($_SESSION['id_usuario'])){
            echo "<script> no_deberias_estar_aqui(); </script>";
        }
        if(isset($_POST['enviado'])){
            $nombre_env = $_POST['nombre'];
            if($es_profesor){
                $clase_enviar = $_POST['clase_op'];
            }else{
                $clase_enviar = $_SESSION['clase'];
            }
            $sql = "INSERT INTO simulaciones (id_creador, id_clase, nombre) VALUES ('$id_usuario','$clase_enviar','$nombre_env')";
            $datos = mysqli_query($con, $sql);
            echo "<script> creado_correctamente('$nombre_env') </script>";
        }
    ?>
</body>
</html>