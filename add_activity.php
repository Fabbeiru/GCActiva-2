<?php

include_once ("presentation.class.php");
include_once ("business.class.php");

View::start();

View::header();

$fail = false;

if (isset($_POST['add_activity'])){

	$idempresa = User::getLoggedUser()['id'];
    $nombre = $_POST["nombre"];
    $tipo = $_POST["tipo"];
    $descripcion = $_POST["descripcion"];
    $precio = $_POST["precio"];
    $aforo = $_POST["aforo"];
    $inicio = $_POST["inicio"];
    $duracion = $_POST["duracion"];
    
    //$imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

    $inicio = new DateTime($inicio);
	$inicio = $inicio->getTimeStamp();
    
    $SQL = "INSERT INTO actividades(idempresa, nombre, tipo, descripcion, precio, aforo, inicio, duracion) VALUES ("
    . "'$idempresa',"
    . "'$nombre',"
    . "'$tipo',"
    . "'$descripcion',"
    . "'$precio',"
    . "'$aforo',"
    . "'$inicio',"
    . "'$duracion');";
    //. "'$imagen');";

    $fail = DB::execute_sql($SQL);

    if (!$fail) $fail = true;
    else header("Location:index.php");

    $fail = true;
}
?>

<!-- Seccion central -->
<section class="central">
	<div class="container title">
		<h1>Crear Actividad</h1>
	</div>
		<div class="background">
		<div class="container content">
			<div class="margin">
				<div class="form">

					<?php
					if ($fail) echo "<p>Error al crear la actividad</p>";
					?>

					<form class="formlogin" method="POST" action="add_activity.php">
				       
				        <label class="labelogin" for="nombre">Nombre:</label><br>
				        <input class="inputlogin" type="text" name="nombre" required><br><br>
				        
				        <label class="labelogin" for="tipo">Tipo:</label><br>
				        <input class="inputlogin" type="text" name="tipo" required><br><br>
				        
				        <label class="labelogin" for="descripcion">Descripcion:</label><br>
				        <textarea class="inputlogin" name="descripcion" required rows="5"></textarea><br><br>
				        
				        <label class="labelogin" for="precio">Precio:</label><br>
				        <input class="inputlogin" type="number" name="precio" min="0" required><br><br>
				        
				        <label class="labelogin" for="aforo">Aforo:</label><br>
				        <input class="inputlogin" type="number" name="aforo" min="1" required><br><br>
				        
				        <label class="labelogin" for="inicio">Inicio:</label><br>
				        <input class="date" type="date" name="inicio" required><br><br>
				        
				        <label class="labelogin" for="duracion">Duracion: (min)</label><br>
				        <input class="inputlogin" type="number" name="duracion" min="1" required><br><br>
				        <!--
						<label class="labelogin">Imagen:</label><br>
						<input type="file" name="imagen" onchange="preview_image(event)"><br>

						<img id="output_image" />
						-->
				        <input type="text" name="add_activity" value="true" hidden><br>
				        <input type="submit" value="Crear Actividad">

				    </form>

				</div>
			</div>
		</div>
		</div>
	</div>
</section>

<?php

View::footer();
