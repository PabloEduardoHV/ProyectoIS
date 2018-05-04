<?php
// Verificar si se inició sesión
/*session_start();
if($_SESSION['user'] != 'coordinador'){
	header("Location:index.php");
}*/

	$page_title = "Anuncios"; 	// Nombre de la pestaña
	include 'includes/menu.php'; // incluir en diseño del menú a la página

	// Conectar a la base de datos
	require ("../mysqli_connect_is.php");

	if ( (isset($_GET['id'])) && (is_numeric($_GET['id']))){ // desde paginas.php
		$id = $_GET['id'];

		// Preparar PA para publicar anuncio
		$query1 = "call publicarAnuncio()";
		$resultado1 = mysqli_query($conexion, $query1);

		// Si el resultado tuvo éxito, entonces recargar página
		if ($resultado1){
			echo '<script>alert("¡Gracias! anuncio publicado con éxito")</script>';
			echo '<script>location.href="publicar.php"</script>';
			mysqli_next_result($conexion);
			@mysqli_free_result($resultado1);
		}
		else{
			echo '<h2 class="error">¡Error del sistema!</h2>';
			echo '<p>Lo sentimos el servidor está en mantenimiento, intente más tarde</p>';

			// Debuggin message:
			echo '<p>'.mysqli_error($conexion).'<br>Query: '.$query1.'</p>';
		}
	}

	echo "<div class='cont'>
	<h1>Anuncios</h1>";

	// Preparar consulta de los anuncios guardados con éxito
	$query = "call getAnunciosNoPublicados()";
	$resultado = mysqli_query($conexion, $query);
	
	// Contar los resultados obtenidos
	$num = @mysqli_num_rows($resultado);

	// Mostrar los anuncios no publicados
	if ($num > 0){

		//Tabla para mostrar los registros
		echo '<table>
				<thead>
					<tr>
						<th colspan="3">Guardados</th>
					</tr>
					<tr>
						<th>id</th>
						<th colspan="2">Título</th>
					</tr>
				</thead>';

		// Recuperar y mostrar todos los registros
		while ($anp = mysqli_fetch_assoc($resultado)){
			echo '<tbody>
					<tr>
						<td>'.$anp['id'].'</td>
						<td>'.$anp['titulo'].'</td>
						<td>
							<i class="buttona edit">Editar</i>
							<i class="buttona delete"><a href="eliminar_anuncio_np.php?id='.$anp['id'].'">Eliminar</a></i>
							<i class="buttona view"><a href="'.$anp['ruta'].'.jpg" target="_blank">Ver</a></i>
							<i class="buttona pub"><a href="publicar.php?id='.$anp['id'].'">Publicar</a></i>
						</td>
				  	</tr>
				  </tbody>';
		}
		echo "</table>";

		// Liberar el recurso y esperar otra query
		mysqli_next_result($conexion);
		@mysqli_free_result($resultado);
	}
	else // No hubo registros
		echo '<p class="error">Actualmente no hay anuncios guardados</p>';

	echo "<br>";

	echo "<h1>Anuncios</h1>";
	/*
	// Preparar consulta de los anuncios publicads con éxito
	$query2 = "call getAnunciosPublicados()";
	$resultado2 = mysqli_query($conexion, $query2);
	
	// Contar los resultados obtenidos
	$num2 = @mysqli_num_rows($resultado2);

	// Mostrar los anuncios no publicados
	if ($num2 > 0){

		//Tabla para mostrar los registros
		echo '<table>
				<thead>
					<tr>
						<th colspan="3">Publicados</th>
					</tr>
					<tr>
						<th>id</th>
						<th colspan="2">Título</th>
					</tr>
				</thead>';

		// Recuperar y mostrar todos los registros
		while ($ap = mysqli_fetch_assoc($resultado)){
			echo '<tbody>
					<tr>
						<td>'.$ap['id'].'</td>
						<td>'.$ap['titulo'].'</td>
						<td>
							<i class="buttona view"><a href="'.$ap['ruta'].'.jpg" target="_blank">Ver</a></i>
							<i class="buttona delete">Eliminar</i>
						</td>
				  	</tr>
				  </tbody>';
		}
		echo "</table>";

		@mysqli_free_result($resultado2);
	}

	else // No hubo registros
		echo '<p class="error">Actualmente no hay anuncios publicados</p>';

*/
	// Cerrar la conexión a la base de datos
	mysqli_close($conexion);
?>
	</div>
	</div>
</body>
</html>
