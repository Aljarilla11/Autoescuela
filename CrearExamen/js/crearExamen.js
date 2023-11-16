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

        fetch("CrearExamen/plantilla/plantillaExamen.html").then(x => x.text()).then(y => {
            var contenedor = document.createElement("div");
            contenedor.innerHTML = y;
            var pregunta = contenedor.querySelector(".pregunta");

            fetch("http://apiautoescuela.com/ApiPregunta.php?categoria=Motor&dificultad=Facil").then(x => x.json()).then(y => {
                preguntas = y.preguntas;
                preguntas.forEach((pregActual, index) => {
                    var pregAux = pregunta.cloneNode(true);
                    pregAux.querySelector('.enunciado').innerHTML = pregActual.enunciado;

                    // Crear y configurar el botón
                    var btnAgregar = document.createElement("button");
                    btnAgregar.textContent = "Añadir";
                    btnAgregar.addEventListener("click", function() {
                        // Llamada a la función para agregar la pregunta al examen
                        agregarPreguntaAlExamen(pregActual.enunciado);
                    });

                    // Adjuntar el botón al lado del enunciado
                    pregAux.appendChild(btnAgregar);

                    divExamen.appendChild(pregAux);
                });
            });
        });
    }

    function agregarPreguntaAlExamen(enunciado) {
        // Datos para enviar en la solicitud POST
        var data = {
            idUsuario: 1, // Reemplaza con el ID del usuario actual
            fecha: obtenerFechaActual(),
            enunciado: enunciado
        };
    
        // Configuración de la solicitud POST
        var requestOptions = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data),
            mode: 'cors', // Asegúrate de especificar el modo CORS
            credentials: 'include', // Agrega esto si estás utilizando credenciales
        };
    
        // Realizar la solicitud POST al servidor
        fetch('http://apiautoescuela.com/ApiAgregarPreguntaExamen.php',requestOptions)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));
    }
    
    function obtenerFechaActual() {
        var fecha = new Date();
        var dia = fecha.getDate();
        var mes = fecha.getMonth() + 1;
        var anio = fecha.getFullYear();
        return anio + '-' + mes + '-' + dia;
    }

    
});
