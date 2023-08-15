<?php
include('c.php');


// CAMPOS DEL FORMULARIO

$fecha = $_POST['fecha'];
$motivo = $_POST['motivo'];
$observacion = $_POST['observacion_medidor'];

//CAMPO DE LAS IMAGENES

$n_fachada = $_FILES['imgFachada']['name'];
$fachada = $_FILES['imgFachada']['tmp_name'];
$n_caja = $_FILES['imgCaja']['name'];
$caja = $_FILES['imgCaja']['tmp_name'];
$n_conexion = $_FILES['imgConexion']['name'];
$conexion1 = $_FILES['imgConexion']['tmp_name'];
$n_formato = $_FILES['imgFormato']['name'];
$formato = $_FILES['imgFormato']['tmp_name'];
//RUTA DE LAS IMAGENES
$rutaFachada = "../image/" . $n_fachada;
$rutaCaja = "../image/" . $n_caja;
$rutaConexion = "../image/" . $n_conexion;
$rutaFormato = "../image/" . $n_formato;
//DIRECCION PARA LA BASE DE DATOS DE LAS IMAGENES
$bdFachada = "image/" . $n_fachada;
$bdCaja = "image/" . $n_caja;
$bdConexion = "image/" . $n_conexion;
$bdFormato = "image/" . $n_formato;
//CREACION LAS IMAGENES EN LA CARPETA IMAGE

move_uploaded_file($fachada,$rutaFachada);
move_uploaded_file($caja,$rutaCaja);
move_uploaded_file($conexion1,$rutaConexion);
move_uploaded_file($formato,$rutaFormato);


$insertar = mysqli_query($conexion,"INSERT INTO `visita` (`id_visita`, `fecha_visita`, `observacion`, `motivo`, `foto_fachada`, `foto_caja`, `foto_conexion`, `foto_medidor_retirado`, `foto_medidor_instalado`, `cedula_notificacion`, `conexion_interna`, `conexion_externa`, `carta_notificacion`, `acta_conformidad`, `acta_instalacion_med`, `certificado_medidor`, `notificacion_control_med`, `acta_retiro_medidor`, `orden_trabajo`, `nro_visita`, `nro_suministro`, `id_actividad`, `id_estado_visita`) VALUES 
(NULL, '$fecha', '$observacion', '$motivo', '$bdFachada', '$bdCaja', '$bdConexion', '$bdFormato', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4', '5034840', '2', '1')");


if($insertar){
	echo '
	
	<script>
	alert("Los datos se guardaron exitosamente");
	</script>
	
	';

 header("location:../pages/vista-suministro.php");

}else{

	echo '
	
	<script>
	alert("Los datos no se guardaron");
	</script>
	
	';
 header("location:../pages/vista-suministro.php");
}

?>