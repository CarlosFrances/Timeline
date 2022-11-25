<?php

//Método para comprobar si una variable existe en el POST
//existir("nombre"); -> devuelve 'true' o 'false' si existe el valor en el POST
function existir($variable){
    return isset($_POST[$variable]);
}

//Método para obtener un valor del POST
//getDato("nombre"); -> devuelve el valor de 'nombre' en el POST
function getDato($variable){
    return $_POST[$variable];
}

?>