var mostrar = false;
function mostrar_esconder_alumno(){
    let formulario = document.getElementById('f_alumno');
    let rol = document.getElementById('rol').value;
    let clase = document.getElementById('clase');
    if(rol == "2"){
        formulario.style = "display: flex";
        clase.required = true;
    }else{
        formulario.style = "display: none";
        clase.required = false;
    }
}
function registro_exitoso(){
    Swal.fire({
        title: '¡Listo!',
        text: '¡Registro exitoso!. Ahora solo haz log-in',
        icon: 'success',
        confirmButtonText: 'Aceptar'
      }).then(
        () => {
            window.location.href = "../";
        }
      );
}
function error_clase(){
    Swal.fire({
        title: 'Error :(',
        text: 'La clase que ingresaste no existe, intenta con otra.',
        icon: 'error',
        confirmButtonText: 'Aceptar'
      });
}
function usuario_inexistente(){
    Swal.fire({
        title: 'Revisa de nuevo.',
        text: 'El usuario ingresado no existe, tal vez te equivocaste con alguna letra',
        icon: 'error',
        confirmButtonText: 'Aceptar'
      });
}
function contrasenia_incorrecta(){
    Swal.fire({
        title: 'Intenta recordar.',
        text: 'La contraseña ingresada no es correcta, intenta de nuevo.',
        icon: 'error',
        confirmButtonText: 'Aceptar'
      });
}
function login_exitoso(){
    Swal.fire({
        title: '¡Listo!',
        text: '¡Todo correcto!',
        icon: 'success',
      }).then(() => {
        window.location.href = "simulaciones/";
      });
}
function salir(){
    Swal.fire({
        title: '¿Seguro que quieres salir?',
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: 'Quedarme',
        denyButtonText:'Salir',
        icon: 'warning',
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isDenied) {
          Swal.fire('¡Te esperamos pronto!', 'Esperamos que vuelvas', 'success').then(() => {
            window.location.href = "../logout.php";
          })
        }
      })
}
function no_deberias_estar_aqui(){
  Swal.fire({
      title: '¿Qué?',
      text: 'No deberías estar aquí',
      icon: 'error',
      confirmButtonText: 'Aceptar'
    }).then(
      () => {
          window.location.href = "../";
      }
    );
}
function clase_creada(codigo){
  Swal.fire({
    title: '¡Creada!',
    text: 'La clase tiene el código: ' + codigo + ', cómpartala con sus alumnos.',
    icon: 'success',
  }).then(() => {
    window.location.href = "../clases/";
  });
}
function contrasenia_dispareja(){
  Swal.fire({
    title: 'Las contraseñas deben ser iguales.',
    text: 'Esto es para que no las olvides.',
    icon: 'error',
    confirmButtonText: 'Aceptar'
  })
}
function rol_incorrecto(){
  Swal.fire({
    title: 'No has seleccionado ningún rol.',
    text: 'Inténtalo de nuevo ;)',
    icon: 'error',
    confirmButtonText: 'Aceptar'
  })
}
function crear(cerrar){
  let panel = document.getElementById('nueva_simulaion_d');
  if(cerrar){
    panel.style = ' display: none;';
  }else{
    panel.style = ' display: flex;';
  }
}
function creado_correctamente(nombre){
  Swal.fire({
    title: '¡Creada!',
    text: 'La simulacion ' + nombre + ' ha sido creada con éxito',
    icon: 'success',
  }).then(() => {
    window.location.href = "../simulaciones/";
  });
}
function guardado_con_exito(id_simulacion){
  Swal.fire({
    title: '¡Guardada!',
    text: 'La simulacion ha sido guardada con éxito',
    icon: 'success',
  }).then(() => {
    window.location.href = "../simulador_code/?id_simulacion=" + id_simulacion;
  });
}
function no_es_tuya(){
  Swal.fire({
    title: 'Esta simulación no es tuya :(.',
    text: '¿Porqué alguien querría cambiar una simulación que no es suya? 👀',
    icon: 'error',
    confirmButtonText: 'Aceptar'
  })
}
function copiar_codigo(enlace){
    var inputFalso = document.createElement("input");
    inputFalso.setAttribute("value", enlace);
    document.body.appendChild(inputFalso);
    inputFalso.select();
    document.execCommand("copy");
    document.body.removeChild(inputFalso);
    Swal.fire({
      title: '¡Copiada!',
      text: '¡El código de clase ha sido copiado correctamente!',
      icon: 'success',
    });
}