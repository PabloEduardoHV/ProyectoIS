<!DOCTYPE html>
<html>
<head>
	<title><?php echo $page_title; ?></title>
	<link rel="stylesheet" type="text/css" href="comun/css/estilo.css">
	<script type="text/javascript" src="comun/js/jquery.js"></script>
	<script type="text/javascript" src="comun/js/ventana.js"></script>
</head>
<body>
	<aside class="aside">
	</aside>
	<div class="float">
		<figure>
			<a href="index.php">
				<img alt="Cerrar sesión" src="comun/imagenes/logout.png" width="100%">
			</a>
		</figure>
		<aside class="aside2">
		</aside>
	</div>
	<div class="container fondo">
		<center><h1 class="ledpard">LEDPARD</h1></center>
		<header>
			<nav>
				<ul>
					<li><a href="publicar.php">Publicar</a></li>
					<li class="desplegable"><a>Agregar</a>
						<ul class="contenido">
							<li class="desp"><a href="subir.php">Subir</a></li>
							<li class="desp"><a href="crear.php">Crear</a></li>
						</ul>
					</li>
					<li><a href="configuracion.php">Configuración</a></li>
				</ul>
			</nav>
		</header>
