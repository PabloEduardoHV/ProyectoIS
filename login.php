<?php
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		if (isset($_POST['password'])&&empty($_POST['password'])) {
			$error="Olvidó introducir la contraseña.";
		}
		else{
			$password = trim($_POST['password']);
		}	
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Iniciar sesión</title>
	<link rel="stylesheet" type="text/css" href="comun/css/estilo.css">
</head>
<body class="centrado">
	<aside class="aside">
	</aside>
	<div class="float">
		<aside class="aside2">
		</aside>
	</div>
	<div class="fondo">
		<div class="container">
			<form id="form" method="post"	action="login.php">
				<h1 class="titulo">INICIAR SESIÓN</h1>
				<fieldset>
					<label for="password" class="label">Contraseña:</label>
					<input type="password" class="pw" id="password" name="password">
					<div>
						<span class="error">
							<?php
								echo (isset($error)) ? "$error" : "";
							?>
						</span>
					</div>
				</fieldset>
				<button class="boton">Enviar</button>
				<button class="boton" formaction="index.php">Regresar</button>
			</form>

		</div>
	</div>
</body>
</html>