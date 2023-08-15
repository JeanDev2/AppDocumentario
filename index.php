
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="./css/index.css">
	<title>Document</title>
</head>
<body>
	<div class="wrapper">
		<h1 class="title">Login</h1>
		<form action="./php/procedimiento-login.php" method="POST" enctype="multipart/form-data">
				<div class="credenciales">
					<input class="textInfo" type="text" placeholder="Usuario" name="user">			
					<input class="textInfo" type="password" placeholder="Contraseña" name="contra">
						<!-- <a class="btnLogin" href="./pages/procedimientos.html"></a> -->
					<button class="btnLogin" type="submit" name="login" id="login">Login</button>
				</div>
			</div>
		</form>

</body>
</html>