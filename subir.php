<?php 

$page_title = "Subir anuncio";
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
		$titulo = mysqli_real_escape_string($conexion,$_POST['titulo']);
		$titulo = trim($titulo);
	}
	if (!empty($_FILES['archivo'])){
			if (is_uploaded_file($_FILES['archivo']['tmp_name'])){
				// Datos del fichero
				$ruta = $_FILES['archivo']['tmp_name'];
				$name = $_FILES['archivo']['name'];	// nombre del archivo
				$tamanio = $_FILES['archivo']['size']; //tamaño del archivo
				$nruta = 'files/'.$name;	//nueva direccion
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
     if (empty($errores)) {
    	if(move_uploaded_file($ruta, $nruta)){
    		if (move_uploaded_file($rutaTemporalR, $rutaR)) {
    			$query = "CALL inscribirArchivo('$folio','$rutaC','$rutaR')";
				$resultado = mysqli_query($conexion,$query);
				if ($resultado) {
					$mensaje = "";
				}
				else{
					$errores[] = mysqli_error($conexion);
				}
    		}
			else{
				$errores [] = "Su recibo de pago no pudo ser almacenado correctamente";
				unlink($rutaC);
			}
		}
		else{
			$errores[]="Su cedula de registro no pudo ser almacenada correctamente";
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