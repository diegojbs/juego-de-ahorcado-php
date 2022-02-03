<?php

// echo obtenerPalablaDesdeBD($conn);exit;
function obtenerPalablaDesdeBD($conn){

    $min = "SELECT min(idpralabras) min FROM palabras";
    $max = "SELECT max(idpralabras) max FROM palabras";
    
    $min = $conn->query($min);
    $min = $min->fetch_assoc();
    $min = $min['min'];

    $max = $conn->query($max);
    $max = $max->fetch_assoc();
    $max = $max['max'];

    $rand = random_int($min , $max);

    $sql = "SELECT palabras FROM palabras where idpralabras =" . $rand  ;

    $resulado = $conn->query($sql);
    $palabra = $resulado->fetch_assoc();
    $palabra = $palabra['palabras'];

    return $palabra;
}

//verificar si una letra existe en la palabra cargada por el juego
function validarSiExisteLaLetra($palabraSistema, $letraUsuario){
    $logitud = strlen($palabraSistema);
    $existe = false;
    for($i=0;$i<$logitud;$i++){
        // echo $palabraSistema[$i] . "</br>";

        if($letraUsuario == $palabraSistema[$i]){
            $existe = true;
        }
    }
    
    return $existe;
}

/**
 * Retorna la palabra del usuario rellena con la letra
 */
function llenarLetraEnPalabraUsuario($palabraSistema, $palabraUsuario, $letra){
    
    $longitud = strlen($palabraSistema);
    for ($i=0; $i<$longitud; $i++){

        if($palabraSistema[$i] == $letra){
            $palabraUsuario[$i] = $letra;
        }
    }

    return $palabraUsuario;
}

/**
 * Copiar palabra sistema  en palabrausuario y llevar con _
 */
function iniciarPalabraUsuario($palabra_sistema){
    $palabraUsuario = $palabra_sistema;
    $longitud = strlen($palabraUsuario);
    for($i=0;$i<$longitud;$i++){
        $palabraUsuario[$i] = '_';
    }

    return $palabraUsuario;
}

/**
 * Permite ver si el juego ha terminado
 */
function validarJuego(
    $palabraSistema, 
    $palabraUsuario, 
    $erroresUsuario, 
    $erroresPermitidos){

        //echo $erroresUsuario;exit;

        // Si supera numero de errores se acaba el juego
        if($erroresUsuario >= $erroresPermitidos){
            return true;
        }

        $longitud = strlen($palabraSistema);
        //  Si completa la palabra se acaba el juego
        if(strcmp($palabraSistema, $palabraUsuario) == 0){
            // var_dump($palabraSistema);
            // var_dump($palabraUsuario);
            // echo "retorna true";exit;
            return true;
        }

        //  Sino no se acaba por el juego en este intento
        return false;
}

/**
 * Permite actualizar la imagen segun los errores de usuario para la pantalla
 */
function actualizarImagen($erroresUsuario){
    switch ($erroresUsuario) {
        case '1':
            return '../img/aorcado3.png';
            break;
        case '2':
            return '../img/aorcado4.png';
            break;
        case '3':
            return '../img/aorcado5.png';
            break;
        case '4':
            return '../img/aorcado6.png';
            break;
        case '5':
            return '../img/aorcado7.png';
            break;
        case '6':
            return '../img/aorcado8.png';
            break;
        case '7':
            return '../img/aorcado9.png';
            break;
        default:
            return '../img/aorcado2.png';
            break;
    }
}

/**
 * Mostrar palabra en pantalla
 */

function mostrarPalabraUsuarioEnPantalla($palabraUsuario){
    $imprimir = '';
    $longitud = strlen($palabraUsuario);
    for($i=0;$i<$longitud;$i++){
        $imprimir = $imprimir . $palabraUsuario[$i] . " ";
    }

    return $imprimir;
}