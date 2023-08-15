
<?php
include('c.php');

$user = $_POST['user'];
$contra = $_POST['contra'];



$numeroRegistros=$user;
if ($conexion){
	$consulta = "SELECT * FROM usuario WHERE user_login = '$user' and pass_login = '$contra'";
	$resultado  = mysqli_query($conexion,$consulta);
	if($resultado){
	while($row = $resultado->fetch_array()){
						
	$dni = $row['dni'];

		}
	}
}



$login = "SELECT COUNT(*) as contar FROM usuario WHERE user_login = '$user' and pass_login = '$contra'  and id_estado = '1'";
$estado = "SELECT COUNT(*) as estado FROM usuario WHERE user_login = '$user' and pass_login = '$contra'  and id_estado = '2'";
$consultaLogin = mysqli_query($conexion,$login);
$consultaEstado = mysqli_query($conexion,$estado);
$arrayLogin = mysqli_fetch_array($consultaLogin);
$arrayEstado = mysqli_fetch_array($consultaEstado);



if($arrayLogin['contar']>=1){
	session_start();
	$_SESSION['user'] = $user;
	$_SESSION['contra'] = $contra;
	header("location:../pages/procedimientos.php");
}elseif($arrayEstado['estado']>0){
	echo '
	<script>
	alert("Usuario Invalidado")
	window.location = "../index.php"
	</script>
	';

}else{
	echo '
	<script>
	alert("CONTRASEÑA Y/O USUARIO INCORRECTO ")
	window.location = "../index.php"
	</script>
	';
}

?>