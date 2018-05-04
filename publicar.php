<?php
// Verificar si se inició sesión
/*session_start();
if($_SESSION['user'] != 'coordinador'){
	header("Location:index.php");
}*/

	$page_title = "Crear anuncio"; 	// Nombre de la pestaña
	include 'includes/menu.php'; // incluir en diseño del menú a la página

	// Conectar a la base de datos
	require ("../mysqli_connect_is.php");

	echo "<h1>Anuncios guardados</h1>";

	// Preparar consulta de los anuncios guardados con éxito
	$query = "call getAnunciosNoPublicados()";
	$resultado = mysqli_query($conexion, $query);
	
	// Contar los resultados obtenidos
	$num = @mysqli_num_rows($resultado);

	// Mostrar los anuncios no publicados
	if ($num > 0){

		// Mostrar la cantidad de anuncios guardados
		if ($num == 1)
			echo "<p>Actualmente hay $num anuncio guardado</p><br>";
		else
			echo "<p>Actualmente hay $num anuncios guardados</p><br>";

		//Tabla para mostrar los registros
		echo '<table cellspacing="3" cellpadding="3" width="auto">
				<tr><td align="center"><b>Título</b></td>
					<td align="center"><b>Ver</b></td>
					<td align="center"><b>Opciones</b></td>
				</tr>';

		// Recuperar y mostrar todos los registros
		while ($anp = mysqli_fetch_assoc($resultado)){
			echo '<tr><td align="center">'.$anp['titulo'].'</td>'.
					 '<td align="center"><a href="'.$anp['ruta'].'.jpg">Abrir</a></td>'.
					 '<td align="center"><a href="">Editar</a>, <a href="">Eliminar</a>,<a href="">Publicar</a></td>
				  </tr>';
		}
		echo "</table>";

		// Liberar el recurso y esperar otra query
		mysqli_next_result($conexion);
		@mysqli_free_result($resultado);
	}
	else // No hubo registros
		echo '<p class="error">Actualmente no hay anuncios guardados</p>';

	echo "<br><br><br>";

	echo "<h1>Anuncios publicados</h1>";
	/*
	// Preparar consulta de los anuncios publicads con éxito
	$query2 = "call getAnunciosPublicados()";
	$resultado2 = mysqli_query($conexion, $query2);
	
	// Contar los resultados obtenidos
	$num2 = @mysqli_num_rows($resultado2);

	// Mostrar los anuncios no publicados
	if ($num2 > 0){

		// Mostrar la cantidad de anuncios guardados
		if ($num2 == 1)
			echo "<p>Actualmente hay $num2 anuncio publicado</p><br>";
		else
			echo "<p>Actualmente hay $num anuncios publicados</p><br>";

		//Tabla para mostrar los registros
		echo '<table cellspacing="3" cellpadding="3" width="auto">
				<tr><td align="center"><b>Título</b></td>
					<td align="center"><b>Ver</b></td>
					<td align="center"><b>Opciones</b></td>
				</tr>';

		// Recuperar y mostrar todos los registros
		while ($ap = mysqli_fetch_assoc($resultado2)){
			echo '<tr><td align="center">'.$ap['titulo'].'</td>'.
					 '<td align="center">'.$ap['ruta'].'</td>'.
					 '<td align="center"><a href="">Eliminar</a></td>
				  </tr>';
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
</body>
</html>

