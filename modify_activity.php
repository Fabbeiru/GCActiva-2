<?php

include_once ("presentation.class.php");
include_once ("business.class.php");

View::start();

View::header();

$id = $_GET['id'];

if(isset($_POST['command'])) {
	if ($_POST['command'] == "update") {

		$idempresa = User::getLoggedUser()['id'];
        $nombre = $_POST["nombre"];
        $tipo = $_POST["tipo"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $aforo = $_POST["aforo"];
        $inicio = $_POST["inicio"];
        $duracion = $_POST["duracion"]* 60;

		$inicio = new DateTime($inicio);
		$inicio = $inicio->getTimeStamp();
		

		$SQL = "UPDATE actividades SET "
			. "nombre='$nombre',"
			. "tipo='$tipo',"
			. "descripcion='$descripcion',"
			. "precio='$precio',"
			. "aforo='$aforo',"
			. "inicio='$inicio',"
			. "duracion='$duracion'"
			. "where id='$id';";

		DB::execute_sql($SQL);
	}
}


$actividad = DB::execute_sql("SELECT * FROM actividades WHERE id='$id';")->fetchAll(PDO::FETCH_NAMED);

$nombre = $actividad[0]['nombre'];
$tipo = $actividad[0]['tipo'];
$descripcion = $actividad[0]['descripcion'];
$empr = DB::execute_sql("SELECT nombre FROM empresas WHERE idempresa='" . $actividad[0]['idempresa'] . "';")->fetchAll(PDO::FETCH_NAMED)[0]['nombre'];
$precio = round($actividad[0]['precio'], 1);
$aforo = $actividad[0]['aforo'];
$inicio = "20" . preg_split("/ /", date("y-m-d H:i", $actividad[0]['inicio']))[0];
$duracion = round($actividad[0]['duracion'] / 60);
//$img = View::imgtobase64($actividad[0]['imagen']);

?>

<!-- Seccion central -->
<section class="central">
	<div class="container title">
		<h1>Modificar Actividad</h1>
	</div>
		<div class="background">
		<div class="container content">
			<div class="margin">
				<div class="form">
                    <form action="modify_activity.php?id=<?php echo $id ?>" class="formlogin" method="POST">
                    	
                    	<!-- <img src="<?php echo $img ?>" alt="<?php echo $name ?>"> -->
                    		<label class="labelogin" for="nombre">Nombre:</label><br>
                    		<input class="inputlogin" type="text" name="nombre" value="<?php echo $nombre ?>"><br>
                    		<label class="labelogin" for="tipo">Tipo:</label><br>
                    		<input class="inputlogin" type="text" name="tipo" value="<?php echo $tipo ?>"><br>
                    		<label class="labelogin" for="descripcion">Desripción:</label><br>
                    		<textarea class="inputlogin" name="descripcion" cols="50"><?php echo $descripcion ?></textarea><br>
                    		<label class="labelogin" for="precio">Precio:</label><br>
                    		<input class="inputlogin" type="number" name="precio" value="<?php echo $precio ?>" min="0" step="any"><br>
                    		<label class="labelogin" for="aforo">Capacidad:</label><br>
                    		<input class="inputlogin" type="number" name="aforo" value="<?php echo $aforo ?>" min="1"><br>
                    		<label class="labelogin" for="inicio">Fecha:</label><br>
                    		<input class="date" type="date" name="inicio" value="<?php echo $inicio ?>"><br>
                    		<label class="labelogin" for="duracion">Duración:</label><br>
                    		<input class="inputlogin" type="number" name="duracion" value="<?php echo $duracion ?>" min="5"><br>
                    		<input type="text" name="command" value="update" hidden>
                    		<input type="submit" value="Actualizar">
                    
                    </form>

                </div>
			</div>
		</div>
		</div>
	</div>
</section>

<?php

View::footer();
