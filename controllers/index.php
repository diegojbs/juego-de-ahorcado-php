<?php

session_start();

define('ERRORES', 7);

require "../controllers/funciones.php";


$servidor = "localhost";
$nombre = "root";
$clave = "";
$base_datos = "ahorcado";

$conn = new mysqli( $servidor , $nombre , $clave , $base_datos );



if(isset($_POST['iniciar_juego'])){
    $_SESSION['errores_usuario'] = 0;
    $_SESSION['palabra_sistema'] = obtenerPalablaDesdeBD($conn);
    $_SESSION['palabra_usuario'] = iniciarPalabraUsuario($_SESSION['palabra_sistema']);
    $_SESSION['imagen_actual'] = '../img/aorcado2.png';
    $_SESSION['juego_terminado'] = false;
    $_SESSION['mensaje'] = 'Ingrese una letra';

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

if(isset( $_POST['letra'])){
    
    $letraUsuario = strtolower($_POST['letra']);
    if($_SESSION['juego_terminado'] == false){
        
        if(validarSiExisteLaLetra($_SESSION['palabra_sistema'], $letraUsuario)){
            //Si existe
            // var_dump('existe');exit;
            $_SESSION['palabra_usuario'] = llenarLetraEnPalabraUsuario($_SESSION['palabra_sistema'], $_SESSION['palabra_usuario'], $letraUsuario);
            $_SESSION['mensaje'] = 'BIEN! Ingrese una letra.';
        }else{
            //incrementar numero de errores
            $_SESSION['errores_usuario']++;
            $_SESSION['imagen_actual'] = actualizarImagen($_SESSION['errores_usuario']);
            $_SESSION['mensaje'] = 'ERROR! Ingrese una letra.';
        }
    
    
        //Verificar si el juego a terminado en cada intento
         $_SESSION['juego_terminado'] = validarJuego($_SESSION['palabra_sistema'], $_SESSION['palabra_usuario'], $_SESSION['errores_usuario'], ERRORES);
        
         if($_SESSION['juego_terminado']){
            $_SESSION['mensaje'] = 'Juego Terminado';
         }
    
        }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}






// var_dump($conn);









