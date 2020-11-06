<?php

include_once 'presentation.class.php';
include_once 'data_access.class.php';

View::start("GCActiva - Empresa");

View::header();

// Get values
$nombre = $_GET['name'];
$empresa = DB::execute_sql("select * from empresas where nombre='$nombre';")->fetchAll(PDO::FETCH_NAMED)[0];

$id = $empresa['idempresa'];
$descripcion = $empresa['descripcion'];
$contacto = $empresa['contacto'];
$logo = View::imgtobase64($empresa['logo']);

?>

<section class='central'>
    <div class='container title'>
	    <h1><?php echo $_GET['name'] ?></h1>
    </div>
	<div class='background'>
	    <div class='container content'>
	        <div class='margin'>
                <div class="empresa">
                	<div class="img">
                		<img src="<?php echo $logo ?>">
                	</div>
                	<div class="info">
                		<p><?php echo $descripcion ?></p>
                		<p><b>Contacto:</b><?php echo $contacto ?></p>
                	</div>
                </div>
                <div class="tour_list">
<?php

$actList = DB::execute_sql("select * from actividades where idempresa='$id';")->fetchAll(PDO::FETCH_NAMED);

echo "<table>";
echo "<tr>";
echo "<th>Nombre</th>";
echo "<th>Día</th>";
echo "<th>Aforo</th>";
echo "<th>Precio</th>";
echo "<th>Link</th>";
echo "</tr>";

foreach ($actList as $activity) {
	
	$id = $activity['id'];
	$nombre = $activity['nombre'];
	$inicio = date("d-m-y", $activity['inicio']);
	$aforo = $activity['aforo'];
	$precio = round($activity['precio'], 1);

	$row = 
	"
	<tr>
		<td>$nombre</td>
		<td>$inicio</td>
		<td>$aforo</td>
		<td>$precio</td>
		<td>
			<form action='activity.php' method='GET'>
				<input type='text' name='id' value='$id' hidden>
				<input type='submit' value='Ir'>
			</form>
		</td>
	</tr>
	";

	echo $row;
}

echo "</table>";

?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
View::footer();
