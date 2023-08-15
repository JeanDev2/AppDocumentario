<?php
include('c.php');

$tipoActividad = $_POST['codActividad'];

session_start();
$_SESSION['codActividad'] = $tipoActividad;
// settype($tipoActividad,"string");
if($tipoActividad){
	   header("location:../pages/listSuministroActividad.php");
};
	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<div class="wrapper">
	<input type="text" name="" id="" placeholder="<?php echo $tipoActividad?>" value="<?php echo $tipoActividad?>">

    <?php
				include ('./c.php');

				if ($conexion){
				$consulta = "select * from suministro where actividad = '$tipoActividad'";
                echo  $consulta;
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
</body>
</html>