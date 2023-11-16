window.addEventListener("load", function () 
{

    var btnFinalizar = document.getElementById("finalizar");
    btnFinalizar.style.display = "none";
    var btnComenzar = document.getElementById("comenzar");
    var divExamen = document.getElementById("examen");
    var preguntas = [];
    var indicePreguntaActual = 0;
    var respuestas = {}; // Almacena las respuestas de las preguntas
    var idsPreguntas = [];

    btnComenzar.addEventListener("click", comenzar);
    btnFinalizar.addEventListener("click", finalizar);

    function comenzar() 
    {
        btnComenzar.style.display = "none";
        console.log("")
        btnFinalizar.style.display = "block";
        fetch("HacerExamen/plantilla/plantillaPregunta.html").then(x => x.text()).then(y => 
        {
            var contenedor = document.createElement("div");
            contenedor.innerHTML = y;
            var pregunta = contenedor.querySelector(".pregunta");
            var cuadrados = contenedor.querySelector(".cuadrados");
            var cuadradosAux = cuadrados.cloneNode(true);

            fetch("http://apiautoescuela.com/ApiExamen.php?id_examen=1").then(x => x.json()).then(y => 
            {
                preguntas = y.preguntas;
                preguntas.forEach((pregActual, index) => 
                {
                    var pregAux = pregunta.cloneNode(true);
                    if (index !== 0) 
                    {
                        pregAux.style.display = "none";
                    }
                    pregAux.getElementsByClassName("numero")[0].innerHTML = (index + 1) + "- ";
                    idsPreguntas.push(pregActual.id);
                    pregAux.getElementsByClassName("enunciado")[0].innerHTML = pregActual.enunciado;
                    //pregAux.getElementsByClassName("imagen")[0].setAttribute("src", pregActual.url);
                    pregAux.getElementsByClassName("resp1")[0].innerHTML = pregActual.respuesta.res1;
                    pregAux.getElementsByClassName("res1")[0].addEventListener("click", function() 
                    {
                        guardarRespuesta(index, pregActual.respuesta.res1);
                    });
                    pregAux.getElementsByClassName("res2")[0].addEventListener("click", function() 
                    {
                        guardarRespuesta(index, pregActual.respuesta.res2);
                    });
                    pregAux.getElementsByClassName("res3")[0].addEventListener("click", function() 
                    {
                        guardarRespuesta(index, pregActual.respuesta.res3);
                    });
                    pregAux.getElementsByClassName("resp2")[0].innerHTML = pregActual.respuesta.res2;
                    
                    pregAux.getElementsByClassName("resp3")[0].innerHTML = pregActual.respuesta.res3;
            
                    pregAux.getElementsByClassName("borrar")[0].onclick = function () 
                    {
                        var auxPadre = this;
                        while (!auxPadre.classList.contains("pregunta")) 
                        {
                            auxPadre = auxPadre.parentNode;
                        }
                        auxPadre.getElementsByClassName("dudosa")[0].checked = false;
                    };

                    divExamen.appendChild(pregAux);
                });

                divExamen.appendChild(cuadradosAux); // Añade los botones debajo del contenido
                agregarBotonesPreguntas(); // Agrega los botones de las preguntas
            });
        });

        divExamen.addEventListener("click", function (event) 
        {
            if (event.target.classList.contains("siguiente")) 
            {
                if (indicePreguntaActual < preguntas.length - 1) 
                {
                    divExamen.children[indicePreguntaActual].style.display = "none";
                    indicePreguntaActual++;
                    mostrarRespuesta();
                    divExamen.children[indicePreguntaActual].style.display = "block";
                    actualizarEstadoBotones();
                }
            } 
            else if (event.target.classList.contains("anterior")) 
            {
                if (indicePreguntaActual > 0) 
                {
                    divExamen.children[indicePreguntaActual].style.display = "none";
                    indicePreguntaActual--;
                    mostrarRespuesta();
                    divExamen.children[indicePreguntaActual].style.display = "block";
                    actualizarEstadoBotones();
                }
            }
        });


          
    }



    function finalizar(ev) 
    {
        ev.preventDefault();
        if (confirm("¿Estás seguro de que quieres terminar el examen?")) 
        {
            console.log(respuestas);
            generarJsonRespuestas();
        }
    }

    function guardarRespuesta(preguntaIndex, respuesta) 
    {
        respuestas[preguntaIndex] = respuesta;
    }

    function agregarBotonesPreguntas() 
    {
        var cuadrados = document.createElement("div");
        cuadrados.className = "cuadrados";
        //var cuadrados = document.querySelector(".cudardados");
    
        preguntas.forEach((pregActual, index) => {
            var numeroPregunta = index + 1;
    
            var botonPregunta = document.createElement('button');
            botonPregunta.textContent = numeroPregunta;
            botonPregunta.addEventListener("click", function() {
                indicePreguntaActual = index;
                mostrarPregunta();
                actualizarEstadoBotones();
            });
    
            if (respuestas[index]) {
                botonPregunta.style.background = "green";
            } else {
                var preguntaActual = preguntas[index];
                if (preguntaActual.dudosa) {
                    botonPregunta.style.background = "orange";
                } else {
                    botonPregunta.style.background = "gris";
                }
            }
    
            cuadrados.appendChild(botonPregunta);
        });
    
        divExamen.appendChild(cuadrados);
    }
    

    function mostrarPregunta() 
    {
        divExamen.querySelectorAll('.pregunta').forEach((pregunta, index ) => 
        {
            if (index === indicePreguntaActual) {
                pregunta.style.display = "block";
            } else {
                pregunta.style.display = "none";
            }
        });
    }

    function mostrarRespuesta() 
    {
        var radios = divExamen.children[indicePreguntaActual].querySelectorAll('input[type="radio"]');
        for (var i = 0; i < radios.length; i++) {
            if (respuestas[indicePreguntaActual] === radios[i].nextSibling.textContent) {
                radios[i].checked = true;
                break;
            }
        }
    }

    function generarJsonRespuestas() 
    {
        var jsonRespuestas = {};
        idsPreguntas.forEach((id, index) => {
            if (respuestas[index]) {
                jsonRespuestas[id] = respuestas[index];
            } else {
                jsonRespuestas[id] = "";
            }
        });

        console.log(JSON.stringify(jsonRespuestas, null, 2));
    }

    function actualizarEstadoBotones() 
    {
        var botones = divExamen.querySelectorAll('.cuadrados button');
        botones.forEach((boton, index) => {
            if (respuestas[index]) {
                boton.style.background = "green";
            } else {
                var preguntaActual = preguntas[index];
                var checkboxDudosa = divExamen.children[index].querySelector('.dudosa');
                if (checkboxDudosa.checked) {
                    boton.style.background = "orange";
                } else {
                    boton.style.background = "gris";
                }
            }
        });
    }
});
