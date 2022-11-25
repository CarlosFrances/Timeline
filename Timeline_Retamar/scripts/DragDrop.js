var cartaColocada = false;
var cartaTemporal = null;

function irIzquierda(){
    //Captura los contenedores del mazo de tiempo y el orden actual
    var contenedores = Array.prototype.slice.call(document.getElementsByTagName("div")[0].children);
    var ordenCartaTemporal = contenedores.indexOf(cartaTemporal);

    //Si la carta existe y el orden no es el principio, intercambia las cartas
    if(cartaTemporal != null && ordenCartaTemporal != 0){
        sustituir(document.getElementsByTagName("div")[ordenCartaTemporal], cartaTemporal);
    }
}

function irDerecha(){
    //Captura los contenedores del mazo de tiempo
    var contenedores = Array.prototype.slice.call(document.getElementsByTagName('div')[0].children);
    var ordenCartaTemporal = contenedores.indexOf(cartaTemporal);
    
    //Si la carta temporal existe y no es la última, intercambia las cartas
    if(cartaTemporal != null && ordenCartaTemporal != contenedores.length-1){
        sustituir(cartaTemporal, document.getElementsByTagName('div')[ordenCartaTemporal+2]);
    }
}

//Método que se le pasa una carta y el lugar actual en el que se encuentra
function cambiar(objeto, lugarActual){
    //Si todavía no se ha colocado una carta o el lugar de la carta está en el mazo del tiempo,
    //Habilita intercambiar la carta
    if(!cartaColocada || lugarActual == "mazoTiempo"){
        //Crea una nueva ubicacion
        var nuevaUbicacion = "";

        //Cambia el lugar de la carta
        if(lugarActual == "mazoTiempo"){
            nuevaUbicacion = "mazoUsuario";
            objeto.style.top = "0px";

            //Cambia el valor del name
            objeto.querySelector("input").setAttribute("name", "cartasUsuario[]");

            //Ya no existe carta temporal
            cartaTemporal = null;
        } else {
            nuevaUbicacion = "mazoTiempo";
            objeto.querySelector("input").setAttribute("name", "cartasTiempo[]");
            cartaTemporal = objeto;
            objeto.style.top = "20px";
        }
        //Cambia el atributo onclick
        objeto.setAttribute("onclick", "cambiar(this, '"+ nuevaUbicacion +"')");

        //Habrá una carta colocada si la nueva ubicación es diferente del mazo del usuario
        cartaColocada = nuevaUbicacion != "mazoUsuario";
        
        //Elmina el objeto de su ubicación actual
        objeto.remove();

        //Captura el contenedor de la nueva ubicación y ahí añade el objeto
        document.getElementById(nuevaUbicacion).append(objeto);

        
    }
}

//Función para sustituir el primer objeto por el segundo
function sustituir(objeto1, objeto2) {
    objeto1.parentNode.replaceChild(objeto1, objeto2);
    objeto1.parentNode.insertBefore(objeto2, objeto1); 
}