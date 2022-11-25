<?php

$numeroJugadores = 1;

require("complementos/utiles.php");
require("complementos/obtenerJugadorActual.php"); //NO IMPLEMENTADO
require("complementos/creacionCartas.php");

?>
<html>
    <head>
        <!-- DATOS -->
        <title>Turno de <?php echo $jugadorActual ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="google" content="notranslate">

        <!-- ESTILOS CSS -->
        
        <link type="text/css" rel="stylesheet" href="styles/main.css">
        <link type="text/css" rel="stylesheet" href="styles/mazos.css">
        <link type="text/css" rel="stylesheet" href="styles/carta.css">
        <link type="text/css" rel="stylesheet" href="styles/lineaTiempo.css">
        <link type="text/css" rel="stylesheet" href="styles/botonConfirmar.css">
        <link type="text/css" rel="stylesheet" href="styles/responsive.css">

        <!-- CÓDIGOS JS -->
        <script type="text/javascript" src="scripts/main.js"></script>
        <script type="text/javascript" src="scripts/DragDrop.js"></script>

        <style>
            
            p {
                margin: 0;
                color: black;
                position: absolute;
                width: inherit;
                
            }

        </style>
    </head>
    <body>
        <!--<font color="white">
            <?php
                //var_export($_POST);
            ?>
        </font>-->
            <?php
                if(existir("cartasTiempo")){
                    $cartasTiempo = array();
                    for($i=0; $i<count(getDato("cartasTiempo")); $i++){
                        array_push($cartasTiempo, explode(",", getDato("cartasTiempo")[$i])); 
                    }
                    foreach($cartasTiempo as $carta){
                        array_push($cartasSacadas, $carta[0]);
                    }
                }
                //Guardar todas las cartas existentes
                if(existir("cartasUsuario")){
                    $cartasUsuario = array();
                    for($i=0; $i<count(getDato("cartasUsuario")); $i++){
                        array_push($cartasUsuario, explode(",", getDato("cartasUsuario")[$i])); 
                    }
                    foreach($cartasUsuario as $carta){
                        array_push($cartasSacadas, $carta[0]);
                    }
                }
            ?>
        
            <form class="contenedor" action="index.php" method="POST">
            <?php

                $intentos = 0;
                if(existir("intentos")){
                    $intentos = getDato("intentos");
                    $intentos++;
                }
                echo "<input name=\"intentos\" type=\"hidden\" value=\"$intentos\"/>";

            ?>

            <div id="mazoTiempo">
                <?php
                
                    if(existir("cartasTiempo")){
                        $cartasTiempo = array();
                        for($i=0; $i<count(getDato("cartasTiempo")); $i++){
                            array_push($cartasTiempo, explode(",", getDato("cartasTiempo")[$i])); 
                        }

                        //La forma de comprobar que una carta no está ordenada es comparar
                        $barajaTemporalTiempo = $cartasTiempo;

                        //Ordena las cartas, indiferentemente de
                        sort($cartasTiempo);

                        foreach($cartasTiempo as $carta){
                            //Imprimirá una carta, indicando el mazo actual
                            echo devolverCarta($carta, $mazo="mazoTiempo");
                        }

                    } else {
                        echo generarCartaAleatoria($clickable=false, "cartasTiempo[]");
                    }

                ?>

            </div>
            <div id="mazoUsuario">
                <?php
                    if(existir("cartasTiempo")){
                        if($cartasTiempo == $barajaTemporalTiempo){
                            echo generarCartaAleatoria($clickable=true, "cartasUsuario[]");
                        } else {
                            echo "</div><div style=\"width: 100%;position: absolute;top: 80%;text-align: center;\">";
                            echo "<p class=\"textoGanado\">Tu puntuación: $intentos</p>";
                        }

                    } else {
                        echo generarCartaAleatoria($clickable=true, "cartasUsuario[]");
                    }
                    

                    /*} else if($intentos == 0) {
                        //Se reparten por primera vez
                        for($i=0; $i<3; $i++){
                            echo generarCartaAleatoria($clickable=true, "cartasUsuario[]");
                        }
                    } else {
                        //Se supone que ya no existen cartas
                        if($cartasTiempo == $barajaTemporalTiempo){
                            echo "</div><div style=\"width: 100%;position: absolute;top: 80%;text-align: center;\">";
                            echo "<p class=\"textoGanado\">¡Has ganado!</p>";    
                        } else {
                            echo generarCartaAleatoria($clickable=true, "cartasUsuario[]");
                        }
                    }*/

                    ?>
            </div>
            <div class="botonesMovimiento">
                <button type="button" class="botonMovimiento" onclick="irIzquierda()">&larr;</button>
                <button type="submit" class="botonConfirmar">Finalizar turno</button>
                <button type="button" class="botonMovimiento" onclick="irDerecha()">&rarr;</button>
            </div>
            <div class="puntuacion">
            <?php
                echo "Puntuación: ". $intentos;
            ?></div>
            </form>
            <hr id="lineaTiempo">


    </body>
</html>