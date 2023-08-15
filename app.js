const tieneSoporteUserMedia = () =>
    !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
const _getUserMedia = (...arguments) =>
    (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);

// Declaramos elementos del DOM
const 
    //CREAMOS VARIABLES PARA LOS VIDEO DE TODOS LOS MODULOS
    $videoFachada = document.querySelector("#videoFachada"),
    $videoCaja = document.querySelector("#videoCaja"),
    $videoConexion = document.querySelector("#videoConexion"),
    $videoFormato = document.querySelector("#videoFormato"),
    //CREAMOS VARIABLES PARA LOS CANVAS DE TODOS LOS MODULOS
    $canvasFachada = document.querySelector("#canvasFachada"),
    $canvasCaja = document.querySelector("#canvasCaja"),
    $canvasConexion = document.querySelector("#canvasConexion"),
    $canvasFormato = document.querySelector("#canvasFormato"),
    //CREAMOS VARIABLES PARA LOS BOTONES DE TOMAR FOTO DE CADA MODAL
    $botonFachada = document.querySelector("#takeFachada"),
    $botonCaja = document.querySelector("#takeCaja"),
    $botonConexion = document.querySelector("#takeConexion"),
    $botonFormato = document.querySelector("#takeFormato"),

    $listaDeDispositivos = document.querySelector("#listaDeDispositivos");


const limpiarSelect = () => {
    for (let x = $listaDeDispositivos.options.length - 1; x >= 0; x--)
        $listaDeDispositivos.remove(x);
};
const obtenerDispositivos = () => navigator
    .mediaDevices
    .enumerateDevices();

// La función que es llamada después de que ya se dieron los permisos
// Lo que hace es llenar el select con los dispositivos obtenidos
const llenarSelectConDispositivosDisponibles = () => {

    limpiarSelect();
    obtenerDispositivos()
        .then(dispositivos => {
            const dispositivosDeVideo = [];
            dispositivos.forEach(dispositivo => {
                const tipo = dispositivo.kind;
                if (tipo === "videoinput") {
                    dispositivosDeVideo.push(dispositivo);
                }
            });

            // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
            if (dispositivosDeVideo.length > 0) {
                // Llenar el select
                dispositivosDeVideo.forEach(dispositivo => {
                    const option = document.createElement('option');
                    option.value = dispositivo.deviceId;
                    option.text = dispositivo.label;
                    $listaDeDispositivos.appendChild(option);
                });
            }
        });
}

(function() {
    // Comenzamos viendo si tiene soporte, si no, nos detenemos
    if (!tieneSoporteUserMedia()) {
        alert("Lo siento. Tu navegador no soporta esta característica");
        $estado.innerHTML = "Parece que tu navegador no soporta esta característica. Intenta actualizarlo.";
        return;
    }
    //Aquí guardaremos el stream globalmente
    let stream;


    // Comenzamos pidiendo los dispositivos
    obtenerDispositivos()
        .then(dispositivos => {
            // Vamos a filtrarlos y guardar aquí los de vídeo
            const dispositivosDeVideo = [];

            // Recorrer y filtrar
            dispositivos.forEach(function(dispositivo) {
                const tipo = dispositivo.kind;
                if (tipo === "videoinput") {
                    dispositivosDeVideo.push(dispositivo);
                }
            });

            // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
            // y le pasamos el id de dispositivo
            if (dispositivosDeVideo.length > 0) {
                // Mostrar stream con el ID del primer dispositivo, luego el usuario puede cambiar
                mostrarStream(dispositivosDeVideo[0].deviceId);
            }
        });



    const mostrarStream = idDeDispositivo => {
        _getUserMedia({
                video: {
                    // Justo aquí indicamos cuál dispositivo usar
                    deviceId: idDeDispositivo,
                }
            },
            (streamObtenido) => {
                // Aquí ya tenemos permisos, ahora sí llenamos el select,
                // pues si no, no nos daría el nombre de los dispositivos
                llenarSelectConDispositivosDisponibles();

                // Escuchar cuando seleccionen otra opción y entonces llamar a esta función
                $listaDeDispositivos.onchange = () => {
                    // Detener el stream
                    if (stream) {
                        stream.getTracks().forEach(function(track) {
                            track.stop();
                        });
                    }
                    // Mostrar el nuevo stream con el dispositivo seleccionado
                    mostrarStream($listaDeDispositivos.value);
                }

                // Simple asignación
                stream = streamObtenido;

                // Mandamos el stream de la cámara al elemento de vídeo
                $videoFachada.srcObject = stream;
                $videoFachada.play();

                $videoCaja.srcObject = stream;
                $videoCaja.play();

                $videoConexion.srcObject = stream;
                $videoConexion.play();

                $videoFormato.srcObject = stream;
                $videoFormato.play();

                //Escuchar el click del botón para tomar la foto
                //Escuchar el click del botón para tomar la foto
                // MODAL FACHADA
                $botonFachada.addEventListener("click", function() {

                    //Pausar reproducción
                    // $video.pause();

                    //Obtener contexto del canvas y dibujar sobre él
                    let contextoFachada = $canvasFachada.getContext("2d");
                    $canvasFachada.width = $videoFachada.videoWidth;
                    $canvasFachada.height = $videoFachada.videoHeight;
                    contextoFachada.drawImage($videoFachada, 0, 0, $canvasFachada.width, $canvasFachada.height);


                    document.getElementById('videoFachada').style.display = 'none';
                    document.getElementById('canvasFachada').style.display = 'block';
                    
             
                    let fotoFachada = $canvasFachada.toDataURL(); //Esta es la foto, en base 64


                    
                    const $suministro = document.getElementById('suministro').value
                    const $catastro = document.getElementById('catastro').value

                    let enlaceFachada = document.createElement('a'); // Crear un <a>
                    enlaceFachada.download = `fachada${$suministro}${$catastro}.png`;
                    enlaceFachada.href = fotoFachada;
                    enlaceFachada.click();




                    //Reanudar reproducción
                    $videoFachada.play();
                });

                // MODAL CAJA 
                $botonCaja.addEventListener("click", function() {
                    let contextoCaja = $canvasCaja.getContext("2d");
                    $canvasCaja.width = $videoCaja.videoWidth;
                    $canvasCaja.height = $videoCaja.videoHeight;
                    contextoCaja.drawImage($videoCaja, 0, 0, $canvasCaja.width, $canvasCaja.height);

                    document.getElementById('videoCaja').style.display = 'none';
                    document.getElementById('canvasCaja').style.display = 'block';


                    let fotoCaja = $canvasCaja.toDataURL(); //Esta es la foto, en base 64

                    const $suministro = document.getElementById('suministro').value
                    const $catastro = document.getElementById('catastro').value


                    let enlaceCaja = document.createElement('a'); // Crear un <a>
                    enlaceCaja.download = `caja${$suministro}${$catastro}.png`;
                    enlaceCaja.href = fotoCaja;
                    enlaceCaja.click();

                    $videoCaja.play();
                });

                // MODAL CONEXION
                 $botonConexion.addEventListener("click", function() {

                    let contextoConexion = $canvasConexion.getContext("2d");
                    $canvasConexion.width = $videoConexion.videoWidth;
                    $canvasConexion.height = $videoConexion.videoHeight;
                    contextoConexion.drawImage($videoConexion, 0, 0, $canvasConexion.width, $canvasConexion.height);

                    document.getElementById('videoConexion').style.display = 'none';
                    document.getElementById('canvasConexion').style.display = 'block';

                    let fotoConexion = $canvasConexion.toDataURL(); //Esta es la foto, en base 64


                    const $suministro = document.getElementById('suministro').value
                    const $catastro = document.getElementById('catastro').value


                    let enlaceConexion = document.createElement('a'); // Crear un <a>
                    enlaceConexion.download = `conexion${$suministro}${$catastro}.png`;
                    enlaceConexion.href = fotoConexion;
                    enlaceConexion.click();

                 });


                 // MODAL FORMATO
                 $botonFormato.addEventListener("click", function() {

                    let contextoFormato = $canvasFormato.getContext("2d");
                    $canvasFormato.width = $videoFormato.videoWidth;
                    $canvasFormato.height = $videoFormato.videoHeight;
                    contextoFormato.drawImage($videoFormato, 0, 0, $canvasFormato.width, $canvasFormato.height);


                    document.getElementById('videoFormato').style.display = 'none';
                    document.getElementById('canvasFormato').style.display = 'block';

                    let fotoFormato = $canvasFormato.toDataURL(); //Esta es la foto, en base 64


                    const $suministro = document.getElementById('suministro').value
                    const $catastro = document.getElementById('catastro').value


                    let enlaceFormato = document.createElement('a'); // Crear un <a>
                    enlaceFormato.download = `formato${$suministro}${$catastro}.png`;
                    enlaceFormato.href = fotoFormato;
                    enlaceFormato.click();

                 });
            }, (error) => {
                console.log("Permiso denegado o error: ", error);
            });
    }
})();


//GENERANDO TODOS LOS MODAL PARA TOMAR LA FOTO
  const $modalFachada = document.getElementById('modalFoto').addEventListener("click", () =>{
    document.querySelector('.modalFachada').style.display = 'flex';
})

const $modalCaja = document.getElementById('nextCaja').addEventListener("click", () =>{
    document.querySelector('.modalFachada').style.display = 'none';
    document.querySelector('.modalCaja').style.display = 'flex';
})

// BOTON DE REGRESO DEL MODAL CAJA
const $modalReturnFachada = document.getElementById('returnFachada').addEventListener("click", () =>{
    document.querySelector('.modalCaja').style.display = 'none';
    document.querySelector('.modalFachada').style.display = 'flex';
})

const $modalConexion = document.getElementById('nextConexion').addEventListener("click", () =>{
     document.querySelector('.modalCaja').style.display = 'none';
     document.querySelector('.modalConexion').style.display = 'flex';
})

// BOTON DE REGRESO DEL MODAL CAJA
const $modalReturnCaja = document.getElementById('returnCaja').addEventListener("click", () =>{
    document.querySelector('.modalConexion').style.display = 'none';
    document.querySelector('.modalCaja').style.display = 'flex';
})

const $modalFormato = document.getElementById('nextFormato').addEventListener("click", () =>{
     document.querySelector('.modalConexion').style.display = 'none';
     document.querySelector('.modalFormato').style.display = 'flex';
})

// BOTON DE REGRESO DEL MODAL CONEXION
const $modalReturnConexion = document.getElementById('returnConexion').addEventListener("click", () =>{
    document.querySelector('.modalFormato').style.display = 'none';
    document.querySelector('.modalConexion').style.display = 'flex';
})

const $CerrarModalFachada = document.getElementById('closeFachada').addEventListener("click", () =>{
    document.querySelector('.modalFachada').style.display = 'none';
})

const $CerrarModalCaja = document.getElementById('closeCaja').addEventListener("click", () =>{
    document.querySelector('.modalCaja').style.display = 'none';
})

const $CerrarModalConexion = document.getElementById('closeConexion').addEventListener("click", () =>{
    document.querySelector('.modalConexion').style.display = 'none';
})

const $CerrarModalFormato = document.getElementById('closeFormato').addEventListener("click", () =>{
    document.querySelector('.modalFormato').style.display = 'none';
})

//JAVASCRIPT PARA LOS BOTONES DE SUBIR IMAGENES


