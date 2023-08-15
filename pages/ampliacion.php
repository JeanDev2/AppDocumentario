<?php
	session_start();
	$userglobal = $_SESSION['user'];
	$passglobal = $_SESSION['contra'];
	?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/index.css">
	<title>Document</title>
</head>
<body>
<!-- CREACION DEL HEADER CON EL NOMBRE DE USUARIO Y CERRAR SESION -->
	<header class="header">
		<div class="usuario">
			<img src="../icons/icon-user.png" alt="Logo de usuario">
			<?php
				include ('../php/c.php');

				if ($conexion){
				$consulta = "select * from usuario where user_login = '$userglobal'";
				$resultado  = mysqli_query($conexion,$consulta);
				if($resultado){
					while($row = $resultado->fetch_array()){
						
						$name = $row['nombre'];
			?>
							
							<p id="<?php echo $nro_suministro?>" class="btnLogin" type="submit"><?php echo $name?></p>
			<?php
					}
				}
			}
			?>
		</div>
		<div class="cerrarSesion">
		<a href="../php/cerrarsesion.php"><img src="../icons/icon-salida.png"  alt=""></a>
		</div>
	</header>
	<div class="wrapper">
		<h1 class="title">Ampliación</h1>
		<form name="actividad" id="actividad" action="../php/consulta-actividad.php" method="POST">
				<div class="credenciales">
					<button class="btnLogin"  href="">Compatibilidad</button>
					<button class="btnLogin" href="">Notificacion</button>
					<button class="btnLogin" href="">Inspeccion Interna</button>
					<button class="btnLogin" href="">Inspeccion Externa</button>
					<button class="btnLogin" href="">Instalación de medidor</button>
					<button class="btnLogin" href="">Toma de Lectura</button>
				</div>
				<style>
					#codActividad{
						display:none;
					}
				</style>
				<input name="codActividad" id="codActividad" type="text" >
			</form>

	</div>
	<script>
		
		let $valorActividad = document.getElementsByClassName("btnLogin");
		let $length = $valorActividad.length-1;
		let i = 0;
		while (i <= $length) {
				let $varActividad = document.getElementsByClassName("btnLogin")[i].innerHTML;
				$valorActividad[i].addEventListener("click", () =>{
				document.actividad.codActividad.value = $varActividad
				})	
				i++;
			}

	</script>
</body>
</html>