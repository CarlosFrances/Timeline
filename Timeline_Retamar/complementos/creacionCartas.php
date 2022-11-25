<?php

require("complementos/eventos.php");
$cartasSacadas = array();

function generarCartaAleatoria($clickable, $baraja){
    //Captura los datos y los guarda
    $datos = crearDatosAleatorios();
    $year = $datos[0];
    $evento = $datos[1];


    $devolver = "<div style=\"background-image:url(assets/$year.jpg);\" class=\"carta\"";
    if($clickable){
        $devolver .= " onclick=\"cambiar(this, 'mazoUsuario')\">";
    } else {
        $devolver .= ">";
    }
    
    $devolver .= "<input name='$baraja' value='$year,$evento' type='hidden'/>";
    $devolver .= "<p class=\"textoEvento\">$evento</p>";

    if(!$clickable){
        $devolver .= "<p class=\"textoYear\">$year</p>";
    }
    $devolver .= "</div>";
    return $devolver;
}

function devolverCarta($datos, $mazo){
    $rutaImagen = $datos[0];
    $mazoActual = $mazo;
    $devolver = "<div style=\"background-image:url(assets/$rutaImagen.jpg);\" ";
    if($mazo == "mazoTiempo"){
        $arrayActual = "cartasTiempo[]";
    } else {
        $arrayActual = "cartasUsuario[]";
        $devolver .= "onclick=\"cambiar(this, '$mazoActual')\"";
    }
    
    $devolver .= " class=\"carta\">";
    $devolver .= "<input name='$arrayActual' value='$datos[0],$datos[1]' type='hidden'/>";
    $devolver .= "<p class=\"textoEvento\">". $datos[1] ."</p>";
    if($mazo == "mazoTiempo"){
        $devolver .= "<p class=\"textoYear\">". $datos[0] ."</p>";
    }
    $devolver .= "</div>";
    return $devolver;
}

function crearDatosAleatorios(){
    //Las variables globales se pasan a la función
    global $mazoCartas;
    global $cartasSacadas;

    $repetir = true;

    //Por siempre, se repetirá la fuunción
    while($repetir){
        //Se obtiene el año y el evento
        $year = array_rand($mazoCartas, 1);
        $evento = $mazoCartas[$year];

        //Se comprueba si el año existe en las cartas sacadas
        //En caso de no existir, rompe el bucle
        //echo "\n\n\n ($year)". var_dump($cartasSacadas);
        //echo !in_array($year, $cartasSacadas);
        if(!in_array($year, $cartasSacadas)) break;
        
    }

    //Añade ese registro a las cartas sacadas (con el año es suficiente)
    array_push($cartasSacadas, $year);

    //Devuelve los datos generados
    return [$year, $evento];
}

?>