window.addEventListener("load", function () {
    var btnFinalizar = document.getElementById("finalizar");
    btnFinalizar.style.display = "none";
    var btnComenzar = document.getElementById("comenzar");
    var divExamen = document.getElementById("examen");
    btnComenzar.addEventListener("click", comenzar);
    btnFinalizar.addEventListener("click", finalizar);
    var preguntas = [];

    function comenzar() {
        btnComenzar.style.display = "none";
        btnFinalizar.style.display = "block";

       
        fetch("CrearExamen/plantilla/preguntaExamen.html").then(x => x.text()).then(y => 
                {
                    var contenedor = document.createElement("div");
                    contenedor.innerHTML = y;
                    var pregunta = contenedor.querySelector(".pregunta");

                fetch("http://apiautoescuela.com/ApiPregunta.php?categoria=Motor&dificultad=Facil").then(x => x.json()).then(y => 
                {
                        preguntas = y.preguntas;
                        preguntas.forEach((pregActual, index) => {
                            var pregAux = document.createElement("div");
                            pregAux.querySelector('.enunciado').innerHTML = pregActual.enunciados;
                            divExamen.appendChild(pregAux);
                        });

                    });
            });
    }
});
