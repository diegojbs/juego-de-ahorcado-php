<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahorcado</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

    <h1>Juego del ahorcado</h1>
    <hr>

    <div>

        <form action="../controllers/index.php" method="post">
            <input type="hidden" name="iniciar_juego" value="1"></br>      
    
            <button>NUEVO JUEGO</button>
        </form>

        <hr>
       

        <?php
            
            require '../controllers/index.php';

            // echo  'PALABRA QUE SE DEBEADIVINAR: ' . $_SESSION['palabra_sistema'] . '</br>';
            
            // var_dump($_SESSION['juego_terminado']);
            
            echo 'MENSAJE DEL SISTEMA: ' . $_SESSION['mensaje'] . "</br></br>";
            echo  'PALABRA USUARIO: ' . mostrarPalabraUsuarioEnPantalla($_SESSION['palabra_usuario']) . '</br>';

        ?>


        <hr>
 
        <form action="../controllers/index.php" method="post">
            <input type="text" name="letra" required maxlength="1" autocomplete="off" autofocus > <br></br>      
    
            <button id="calcular">INTENTAR</button><br></br>
        </form>
    </div>

    <div class="imagen">
        <img width="250" src="<?php echo $_SESSION['imagen_actual'] ?>" alt="">
    </div>
        
    </body>
</html>