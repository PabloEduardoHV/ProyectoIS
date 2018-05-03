<?php
// Verificar si se inició sesión
/*session_start();
if($_SESSION['user'] != 'coordinador'){
	header("Location:index.php");
}*/

$page_title = "Configuracion"; 	// Nombre de la pestaña
include 'includes/menu.php'; // incluir en diseño del menú a la página
?>

<form id="form" method="post" action="configuracion.php">
			<fieldset class="centrado">
				<label for="titulo" class="label titulo centrado">CAMBIAR CONTRASEÑA</label>
				<br><br>
				<label for="info" class="txt area">Contraseña:</label>
				<input type="text" id="info" class="pw lab info" name="info" value="<?php if(isset($_POST['info'])) echo $_POST['info']; ?>">
                <label for="info" class="txt area">Nueva contraseña:</label>
                <input type="text" id="info" class="pw lab info" name="info" value="<?php if(isset($_POST['info'])) echo $_POST['info']; ?>">
				<div class="error centrado">
					<span class="error">
						<?php
							if (!empty($error)){
								foreach ($error as $msg) {	// Mostrar cada error
								echo "<b class='error'>*$msg</b> <br>\n";
								}
							}
						?>
					</span>
				</div><br>
				
					<button class="boton">Guardar</button>
					<button class="boton" type="reset">Limpiar</button>
				</center>
			</fieldset>
		</form>
	</div>
</body>
</html>