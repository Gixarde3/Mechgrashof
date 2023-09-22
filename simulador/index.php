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
            <a href="../simulaciones" style = "color: #000">Mis simulaciones</a>
            <button type="button" onclick="salir()" id = "log_out"><img src="../img/Icono_salir.png" alt="Salir"></button>   
        </header>
        <iframe src="simulador_code/?id_simulacion=<?php echo $_GET['id_simulacion']?>" style="border:0px #ffffff none;" name="myiFrame" scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" height="700px" width="1024px" allowfullscreen></iframe>
    </main>
    <?php 
        if(isset($_GET['id_simulacion'])){
          $id_simulacion = $_GET['id_simulacion'];
          $sql = "SELECT * FROM simulaciones WHERE id_simulacion = '$id_simulacion'";
          $datos = mysqli_query($con, $sql);
          $datos_simulacion;
          while($row = mysqli_fetch_assoc($datos)){
              $datos_simulacion = $row;
          }
          $datos_iniciales = $datos_simulacion['datos_iniciales'];
        }else{
          echo "<script> no_deberias_estar_aqui(); </script>";
        }
      ?>
</body>
</html>