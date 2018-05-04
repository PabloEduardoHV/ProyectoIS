<?php
	if ($_SERVER['REQUEST_METHOD']=='POST') {
		if (isset($_POST['password'])&&empty($_POST['password'])) {
			$error="Olvidó introducir la contraseña.";
		}
		else{
			$password = trim($_POST['password']);
        }
        
        $query = "call buscarUsuario('$password')";
        $resultado = mysqli_query($conexion, $query);

        if ($resultado) {
            $num = mysqli_num_rows($resultado);
            if($num>0){
                $cuenta = array();

                while($fila = mysqli_fetch_assoc($resultado)){
                        $cuenta['tipo']=$fila['tipo'];
                }
				//Liberar el resultado
                mysqli_free_result($resultado);
				//Iniciar la sesión
                session_start();   
                $_SESSION['contraseña'] = $password;  

                if($cuenta['tipo']=='admin'){
                        $_SESSION['tipo'] = 'admin';
                        header ("Location: crear.php");
                }
                elseif($cuenta['tipo']=='admin2'){
                        $_SESSION['tipo'] = 'admin2';
                        header("Location: crear.php");
                }
            }
            else{
                    $error = "Usuario o contraseña equivocada";
            }
        }
        else{
            $error = "Por el momento no se puede iniciar sesión";
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
				<fieldset>
					<h1 class="titulo">Iniciar sesión</h1>
					<label for="password" class="label">Contraseña:</label>  
					<input type="password" class="pw" id="password" name="password">
					<div>
						<span class="error">
							<?php
								echo (isset($error)) ? "$error" : "";
							?>
						</span>
					</div>
				<button class="boton">Enviar</button>
				<button class="boton" formaction="index.php">Regresar</button>
				</fieldset>
			</form>

		</div>
	</div>
</body>
