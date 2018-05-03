<?php 

$page_title = "Subir anuncio";
//incluir el menu
include 'includes/menu.php'; 
if ($_SERVER['REQUEST_METHOD']=='POST') {

	// Conectar a la base de datos
	require ("mysqli_connect_is.php");

	// Arreglo para almacenar mensajes de error
	$error = array();

	// Verificar que se proporcione el Título
	if (isset($_POST['titulo'])&&empty($_POST['titulo']))
		$error[]="Olvidó introducir el Título.";
	else{
		$titulo = trim($_POST['titulo']);
	}

	// Verificar que se propocione la información
	if (isset($_POST['info'])&&empty($_POST['info']))
		$error[]="Olvidó introducir la Información.";
	else{
		$info = trim($_POST['info']);
	}

	// Verificar que se proporcione la fecha de inicio de anuncio
	if (empty($_POST['f_inicio']))
		$error[] = 'Olvidó introducir la fecha de inicio';
	else{
		$f_inicio = trim($_POST['f_inicio']);	
		//$f_inicio = mysqli_real_escape_string($conexion, $f_inicio);
	}

	// Verificar que se proporcione la fecha fin de anuncio
	if (empty($_POST['f_fin']))
		$error[] = 'Olvidó introducir la fecha fin';
	else{
		$f_fin = trim($_POST['f_fin']);	
		//$f_fin = mysqli_real_escape_string($conexion, $f_fin);
	}

	// Verificar que se proporcione la hora inicial del anuncio
	if (empty($_POST['h_inicio']))
		$error[] = 'Olvidó introducir la hora inicial';
	else{
		$h_inicio = trim($_POST['h_inicio']);
		//$h_inicio = mysqli_real_escape_string($conexion, $h_inicio);
	}

	// Verificar que se proporcione la fecha fin de anuncio
	if (empty($_POST['h_fin']))
		$error[] = 'Olvidó introducir la hora final';
	else{
		$h_fin = trim($_POST['h_fin']);	
		//$h_fin = mysqli_real_escape_string($conexion, $h_fin);
	}
	if (!empty($_FILES['archivo'])){ //comprobar si se subio un archivo
			if (is_uploaded_file($_FILES['archivo']['tmp_name'])){
				// Datos del fichero
				$ruta = $_FILES['archivo']['tmp_name'];	// dirección temporal
				$name = $_FILES['archivo']['name'];	// nombre del archivo
				$tama = $_FILES['archivo']['size']; //tamaño del archivo
				$nruta = 'files/archivo/'.$name;	//nueva direccion
				$array = explode('.', $name); //split con .
				$ext = end($array);	// Obtenemos la extensión el archivo
				$pdf = 'pdf';

				if ($ext == $pdf){
					$archivo = $nruta;
				}
				else{
					$error[] = 'Asegúrese de subir un archivo tipo PDF';
				}
			}
			else{
				$error[] = 'Olvidó introducir el Archivo';
			}
	}
	if(empty($error)){ //si no hay errores
		$query = "guardarArchivo('$ruta','$f_inicio','$f_fin','$h_inicio','$h_fin')";
		$resul = mysqli_query($query,$conexion);
		if($resul){
			$error [] = "No se puedo registrar el anuncio. Comuníquese con soporte.";
		}
		else{

		}
		if(move_uploaded_file($ruta, $nruta)){

		}
		else{
			$error[] = "No se pudo subir el archivo. Intente de nuevo.";
		}
	}
	
}

?>
		<form enctype="multipart/form-data" id="form" method="post"	action="subir.php">
			<fieldset>
				<label for="titulo" class="txt">Título:</label>
				<input type="text" class="pw lab" id="titulo" name="titulo" required="required" value="<?php if(isset($_POST['titulo'])) echo $_POST['titulo']; ?>"><br><br>
				<div class="centrado">
					<input type="file" name="archivo" class="inputFile centrado" required="required">
				</div>
				<div class="centrado">
					<label><em>Solo archivos en formato pdf. Máximo: 4MB</em></label>
				</div>
				<center><div>
					<label for="f_inicio" class="txt">Fecha inicio:</label>
					<input type="date" name="f_inicio">
					<script type="text/javascript">new Date();</script>
					<label for="f_fin" class="txt">Fecha fin:</label>
					<input type="date" name="f_fin">
				</div></center><br>
				<div>
					<center>
						<label for="h_inicio" class="txt">Hora inicio:</label>
						<input type="time" name="h_inicio">
						<label for="h_fin" class="txt">Hora fin:</label>
						<input type="time" name="h_fin">
						
					</center>
				</div><br>
				<div class="centrado">
					<span class="error">
						<?php
							if (!empty($error)){
								foreach ($error as $msg) {	// Mostrar cada error
								echo "<b class='error'>*$msg</b> <br>\n";
								}
							}
						?>
					</span>
				</div>
			<div class=centrado>
				<button class="boton">Guardar</button>
				<button class="boton" type="reset">Limpiar</button>
			</div>
			</fieldset>
		</form>
	</div>
</body>
</html>