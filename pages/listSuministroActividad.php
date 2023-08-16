<?php
include ('../php/c.php');
	session_start();
	$userglobal = $_SESSION['user'];
	$passglobal = $_SESSION['contra'];
	$tipoActividad = $_SESSION['codActividad'];

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
							
							<p  class="btnLogin" type="submit"><?php echo $name?></p>
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

	<!-- Cuerpo del aplicativo -->
	<div class="wrapper">
		<h1 class="title"><?php echo $tipoActividad ?></h1>
		<!-- <form  action="" method="POST">			
			<div class="search">
				<img src="../icons/search.png"  alt="">
				<input type="search" class="searchAction" name="search" >
				<button type="submit" name="submit">Buscar</button>
			</div>
		</form> -->
		<form method="post" action="">
		<div class="search">
			<img src="../icons/search.png"  alt="">
			<input type="search" name="busqueda" class="searchAction" placeholder="Buscar">
			<input class="buttonSearch" type="submit" name="submit" value="Buscar">
		</div>
		</form>
		<?php
		$busqueda = '';
		if (isset($_POST['submit'])) {
			$busqueda = $_POST['busqueda'];
			if (empty($busqueda)) {
				$busqueda = "";
			}
}
    	?>

		<form name="cod" id="cod" action="../php/detalle-suministro.php" method="POST">
		<div class="credenciales">
				<?php
					include ('../php/c.php');

					if ($conexion){
					$consulta =	"SELECT * FROM suministro INNER JOIN usuario ON usuario.dni = suministro.dni WHERE usuario.user_login = 'kninahuanca' AND suministro.actividad = 'COMPATIBILIDAD' AND (LOWER(suministro.distrito) LIKE LOWER('%$busqueda%') OR LOWER(suministro.sector) LIKE LOWER('%$busqueda%') OR LOWER(suministro.manzana) LIKE LOWER('%$busqueda%'))";
					$resultado  = mysqli_query($conexion,$consulta);
					if($resultado){
						while($row = $resultado->fetch_array()){
							
							$nro_suministro = $row['nro_suministro'];
							
				?>
								
								<button id="<?php echo $nro_suministro?>" class="btnLogin" type="submit"><?php echo "Suministro ",$nro_suministro?></button>
				<?php
						}
					}
				}
				
				?>
			</div>
				<style>
					#codSuministro{
						display:none;
					}
				</style>
				<input name="codSuministro" id="codSuministro" type="text" >

		</form>
			<script>
				
				const $botonsumi = document.getElementsByClassName("btnLogin");
				let $length = $botonsumi.length-1;
				let i = 0;
				while (i <= $length) {
				let $varid = document.getElementsByClassName("btnLogin")[i].id;
				$botonsumi[i].addEventListener("click", () =>{
				document.cod.codSuministro.value = $varid
				})	
				i++;
			}
			</script>

	</div>

</body>
</html>