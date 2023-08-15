<?php
include('../php/c.php');
session_start();
$suministro = $_SESSION['nro_suministro'];
$userglobal = $_SESSION['user'];
$passglobal = $_SESSION['contra'];
?>

<?php
				
				if ($conexion){
				$consultaSuministro = "select * from suministro WHERE nro_suministro = '$suministro'";
				$resultado  = mysqli_query($conexion,$consultaSuministro);
				if($resultado){
					while($row = $resultado->fetch_array()){
						
						$n_suministro = $row['nro_suministro'];
						$catastro = $row['catastro'];
						$nombres = $row['nombres'];
						$urbanizacion = $row['urbanizacion'];
						$direccion = $row['direccion'];
						$categoria = $row['categoria'];
						$actividad = $row['actividad'];
						$serie_medidor = $row['serie_medidor'];

?>
			<?php
					}
				}
			}
			?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/desarrollo.css">
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

		<form action="../php/imagenes.php" method="POST" enctype="multipart/form-data">
			<h1 class="title">Compatibilidad</h1>
			<div class="infoCompatibilidad">
				<label for="">Suministro:</label>
				<input disabled  type="text" name="suministro" id="suministro"  value="<?php echo $suministro ?>">
			</div>
			<div class="infoCompatibilidad">
				<label for="">Catastro:</label>
				<input disabled type="text" name="catastro" id="catastro" value="<?php echo $catastro  ?>">
			</div>
			<div class="infoCompatibilidad">
				<label for="">Nombre:</label>
				<input disabled type="text" name="nombres" id="nombres" value="<?php echo $nombres ?>"> 
			</div>
			<div class="infoCompatibilidad">
				<label for="">Urbanizacion:</label>
				<input disabled type="text" name="urbanizacion" id="urbanizacion" value="<?php echo $urbanizacion ?>">
			</div>
			<div class="infoCompatibilidad">
				<label for="">Dirección:</label>
				<input disabled type="text" name="direccion" id="direccion" value="<?php echo $direccion ?>">
			</div>
			<div class="infoCompatibilidad">
				<label for="">Categoría:</label>
				<input disabled type="text" name="categoria" id="categoria" value="<?php echo $categoria ?>">
			</div>
			<div class="infoCompatibilidad">
				<label for="">Actividad:</label>
				<input disabled type="text" name="actividad" id="actividad" value="<?php echo $actividad ?>">
			</div>
			<div class="infoCompatibilidad">
				<label for="">Serie Medidor:</label>
				<input disabled type="text" name="serie_medidor" id="serie_medidor" value="<?php echo $serie_medidor ?>">
			</div>
			<div class="infoCompatibilidad">
				<label for="">fecha:</label>
				<input  type="text" name="fecha" id="fecha" value="" required>
			</div>
			<div class="infoCompatibilidad">
				<label for="">Motivo:</label>
				<input  type="text" name="motivo" id="motivo" value="" required>
			</div>
			<div class="infoCompatibilidad-obs">
				<label for="">Observación:</label>
				<textarea name="observacion_medidor" id="observacion_medidor" cols="30" rows="5" value=""></textarea>
			</div>

			

			<div class="file">
				<label for="">Subir Imagenes</label>
				<div class="container-file">
					<input class="fancyFile" id="imgFachada" type="file"  name="imgFachada" requiered>
					<label for="imgFachada">
						<span class="fancyFileName">
							<span>Ningun archivo selecionado</span>
						</span>
						<span class="fancyFileButton">Buscar archivo</span>
					</label>
				</div>
				<div class="container-file">
					<input class="fancyFile" id="imgCaja" type="file"  id="" name="imgCaja" requiered>
					<label for="imgCaja">
						<span class="fancyFileName">
							<span>Ningun archivo selecionado</span>
						</span>
						<span class="fancyFileButton">Buscar archivo</span>
					</label>
				</div>
				<div class="container-file">
					<input class="fancyFile" id="imgConexion3" type="file"  name="imgConexion" requiered>
					<label for="imgConexion3">
						<span class="fancyFileName">
							<span>Ningun archivo selecionado</span>
						</span>
						<span class="fancyFileButton">Buscar archivo</span>
					</label>
				</div>
				<div class="container-file">
					<input class="fancyFile" id="imgFormato" type="file"  id="" name="imgFormato" requiered>
					<label for="imgFormato">
						<span class="fancyFileName">
							<span>Ningun archivo selecionado</span>
						</span>
						<span class="fancyFileButton">Buscar archivo</span>
					</label>
				</div>
			</div>

		<div class="buttonAccion">
			<button id="modalFoto" type="button" name="">FOTO</button>
			<button type="submit">Registrar</button>
		</div>
	</form>
	</div>

	<div class="modalFachada">
		<div class="modal-content">
			<div>
				<select name="listaDeDispositivos" id="listaDeDispositivos"></select>
				<button id="closeFachada">X</button>
			</div>
			<h2>1.Facahada</h2>
			<div class="container-video">
				<video src="" id="videoFachada" autoplay="true"></video>
				<canvas id="canvasFachada"></canvas>
			</div>
			<div class="buttonCapture">
				<button id="takeFachada"><img src="../icons/icon-camera.png"   alt=""></button>
				<button id="nextCaja" type="button" name="next"><img src="../icons/icon-next.png" alt=""></button>
			</div>
		</div>
	</div>

	<div class="modalCaja">
		<div class="modal-content">
			<div>
				<select name="listaDeDispositivos" id="listaDeDispositivos"></select>
				<button id="closeCaja">X</button>
			</div>
			<h2>2.Caja</h2>
			<div class="container-video">
				<video src="" id="videoCaja" autoplay="true"></video>
				<canvas id="canvasCaja"></canvas>
			</div>
			<div class="buttonCapture">
				<button id="takeCaja"><img src="../icons/icon-camera.png"   alt=""></button>
				<button id="returnFachada" type="button" name="next"><img src="../icons/icon-return.png" alt=""></button>
				<button id="nextConexion" type="button" name="next"><img src="../icons/icon-next.png" alt=""></button>
			</div>
		</div>
	</div>

	<div class="modalConexion">
		<div class="modal-content">
			<div>
				<select name="listaDeDispositivos" id="listaDeDispositivos"></select>
				<button id="closeConexion">X</button>
			</div>
			<h2>3.Conexion</h2>
			<div class="container-video">
				<video src="" id="videoConexion" autoplay="true"></video>
				<canvas id="canvasConexion"></canvas>
			</div>
			<div class="buttonCapture">
				<button id="takeConexion"><img src="../icons/icon-camera.png"   alt=""></button>
				<button id="returnCaja" type="button" name="next"><img src="../icons/icon-return.png" alt=""></button>
				<button id="nextFormato" type="button" name="next"><img src="../icons/icon-next.png" alt=""></button>
			</div>
		</div>
	</div>

	<div class="modalFormato">
		<div class="modal-content">
			<div>
				<select name="listaDeDispositivos" id="listaDeDispositivos"></select>
				<button id="closeFormato">X</button>
			</div>
			<h2>4.Formato</h2>
			<div class="container-video">
				<video src="" id="videoFormato" autoplay="true"></video>
				<canvas id="canvasFormato"></canvas>
			</div>
			<div class="buttonCapture">
				<button id="takeFormato"><img src="../icons/icon-camera.png"   alt=""></button>
				<button id="returnConexion" type="button" name="next"><img src="../icons/icon-return.png" alt=""></button>
			</div>
		</div>
	</div>


	<script src="../app.js"></script>
</body>
</html>