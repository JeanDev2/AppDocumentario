<?php
include('c.php');

$suministrodet = $_POST['codSuministro'];

session_start();
$_SESSION['nro_suministro'] = $suministrodet;
if($suministrodet){
	header("location:../pages/vista-suministro.php");
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
	<input type="text" name="" id="" placeholder="<?php echo $suministrodet?>" value="<?php echo $suministrodet?>">
</body>
</html>



