<?php session_start();
  require '../../conexion.php';
?>
<!DOCTYPE html>
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Simulador Web de 4 barras de longitud modificable</title>
    <link rel="shortcut icon" href="TemplateData/favicon.ico">
    <link rel="stylesheet" href="TemplateData/style.css">
  </head>
  <body style = "font-family: 'Open Sans', sans-serif;">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../js/comportamiento.js"></script>
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
        if(isset($_POST['tams'])){
          $intentos = $_POST['intentos'];
          if($_SESSION['id_usuario'] == $datos_simulacion['id_creador'] || $_SESSION['es_profesor']){
            $tams = $_POST['tams'];
            $id_simulacion_p = $_POST['id_simulacion_p'];
            $sql = "UPDATE simulaciones SET datos_iniciales = '$tams' WHERE id_simulacion = '$id_simulacion_p';";
            $datos = mysqli_query($con, $sql);
            $sql = "UPDATE simulaciones SET intentos = '$intentos' WHERE id_simulacion = '$id_simulacion_p';";
            $datos = mysqli_query($con, $sql);
            echo "<script> guardado_con_exito('$id_simulacion'); </script>";
          }else{
            echo "<script> no_es_tuya(); </script>";
          }
        }
      ?>
    <div id="unity-container" class="unity-desktop">
      <canvas id="unity-canvas" width=1024 height=576></canvas>
      <div id="unity-loading-bar">
        <div id="unity-logo"></div>
        <div id="unity-progress-bar-empty">
          <div id="unity-progress-bar-full"></div>
        </div>
      </div>
      <div id="unity-warning"> </div>
      <div id="unity-footer">
        <div id="unity-webgl-logo"></div>
        <div id="unity-fullscreen-button"></div>
        <div id="unity-build-title">Simulador Web de 4 barras de longitud modificable</div>
      </div>
    </div>
    <form action="" method="post" name = "datos" style = "display: none">
      <input type="hidden" name="tams" id="tams">
      <input type="hidden" name="id_simulacion_p" id="id_simulacion_p" value = "<?php echo $id_simulacion; ?>">
      <input type="hidden" name="intentos" value = "<?php echo $datos_simulacion['intentos']?>" id = "intentos">
    </form>
    <script>
      var container = document.querySelector("#unity-container");
      var canvas = document.querySelector("#unity-canvas");
      var loadingBar = document.querySelector("#unity-loading-bar");
      var progressBarFull = document.querySelector("#unity-progress-bar-full");
      var fullscreenButton = document.querySelector("#unity-fullscreen-button");
      var warningBanner = document.querySelector("#unity-warning");

      // Shows a temporary message banner/ribbon for a few seconds, or
      // a permanent error message on top of the canvas if type=='error'.
      // If type=='warning', a yellow highlight color is used.
      // Modify or remove this function to customize the visually presented
      // way that non-critical warnings and error messages are presented to the
      // user.
      function unityShowBanner(msg, type) {
        function updateBannerVisibility() {
          warningBanner.style.display = warningBanner.children.length ? 'block' : 'none';
        }
        var div = document.createElement('div');
        div.innerHTML = msg;
        warningBanner.appendChild(div);
        if (type == 'error') div.style = 'background: red; padding: 10px;';
        else {
          if (type == 'warning') div.style = 'background: yellow; padding: 10px;';
          setTimeout(function() {
            warningBanner.removeChild(div);
            updateBannerVisibility();
          }, 5000);
        }
        updateBannerVisibility();
      }

      var buildUrl = "Build";
      var loaderUrl = buildUrl + "/simulador_code.loader.js";
      var config = {
        dataUrl: buildUrl + "/simulador_code.data",
        frameworkUrl: buildUrl + "/simulador_code.framework.js",
        codeUrl: buildUrl + "/simulador_code.wasm",
        streamingAssetsUrl: "StreamingAssets",
        companyName: "Universidad Politécnica del Estado de Morelos",
        productName: "Simulador Web de 4 barras de longitud modificable",
        productVersion: "1.0",
        showBanner: unityShowBanner,
      };

      // By default Unity keeps WebGL canvas render target size matched with
      // the DOM size of the canvas element (scaled by window.devicePixelRatio)
      // Set this to false if you want to decouple this synchronization from
      // happening inside the engine, and you would instead like to size up
      // the canvas DOM size and WebGL render target sizes yourself.
      // config.matchWebGLToCanvasSize = false;

      if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
        // Mobile device style: fill the whole browser client area with the game canvas:

        var meta = document.createElement('meta');
        meta.name = 'viewport';
        meta.content = 'width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, shrink-to-fit=yes';
        document.getElementsByTagName('head')[0].appendChild(meta);
        container.className = "unity-mobile";
        canvas.className = "unity-mobile";

        // To lower canvas resolution on mobile devices to gain some
        // performance, uncomment the following line:
        // config.devicePixelRatio = 1;

        unityShowBanner('WebGL builds are not supported on mobile devices.');
      } else {
        // Desktop style: Render the game canvas in a window that can be maximized to fullscreen:

        canvas.style.width = "1024px";
        canvas.style.height = "576px";
      }

      loadingBar.style.display = "block";

      var script = document.createElement("script");
      script.src = loaderUrl;
      script.onload = () => {
        createUnityInstance(canvas, config, (progress) => {
          progressBarFull.style.width = 100 * progress + "%";
        }).then((unityInstance) => {
          loadingBar.style.display = "none";
          unityInstance.SendMessage('Acciones', 'iniciar', '<?php echo $datos_iniciales; ?>');
          fullscreenButton.onclick = () => {
            unityInstance.SetFullscreen(1);
          };
        }).catch((message) => {
          alert(message);
        });
      };
      document.body.appendChild(script);
      var datos = [];
      function guardar_datos_php(datos_iniciales){
        var campo = document.getElementById('tams');
        campo.value = datos_iniciales;
        document.datos.submit();
      }
      function guardar_arreglo(dato){
        datos.push(dato);
      }
      function aumentar_intento(){
        var campo = document.getElementById('intentos');
        var intentos = campo.value;
        intentos++;
        campo.value = intentos;
      }
    </script>
  </body>
</html>
