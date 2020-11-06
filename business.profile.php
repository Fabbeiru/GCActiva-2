<?php

include_once ("presentation.class.php");
include_once ("data_access.class.php");

View::start();

View::header();

$user = User::getLoggedUser();

if ($user == null) {
	header("Location:index.php");
}

$SQL = "SELECT * FROM actividades WHERE idempresa=${user['id']};";
$activities = DB::execute_sql($SQL)->fetchAll(PDO::FETCH_NAMED);

echo "<!-- Seccion central -->";
echo "<section class='central'>";
echo "<div class='container title'>";
echo "<h1>${user['nombre']}</h1>";
echo "</div>";
echo "<div class='background'>";
echo "<div class='container content'>";
echo "<div class='margin'>";

echo "<div class='separa'>";
echo "<table id='activities'>";
echo "<tr>";
echo "<th>Nombre</th>";
echo "<th>Día</th>";
echo "<th>Aforo</th>";
echo "<th>Precio</th>";
echo "<th>Enlace</th>";
echo "<th>Editar</th>";
echo "<th>Eliminar</th>";
echo "</tr>";

foreach ($activities as $activity) {
	
	$id = $activity['id'];
	$nombre = $activity['nombre'];
	$dia = date("d-m-y", $activity['inicio']);
	$aforo =$activity['aforo'];
	$precio =$activity['precio'];

	echo "<tr>";
	echo "<td>$nombre</td>";
	echo "<td>$dia</td>";
	echo "<td>$aforo</td>";
	echo "<td>$precio</td>";
	echo "<td><a href='activity.php?id=$id'><button type='button'>Ver</button></a></td>";
	echo "<td><a href='modify_activity.php?id=$id'><button type='button'>Editar</button></a></td>";
	echo "<td><a href='remove_activity.php?id=$id'><button type='button'>Eliminar</button></a></td>";
	echo "</tr>";

}

echo "</table>";

echo "<br><br>";
echo "<div class='form'>";
echo "<form method='POST' action='add_activity.php'>";
echo "<button class='button' type='submit'>Crear Actividad</button><br>";
echo "</form>";
echo "</div>";
echo "</div>";
?>

<div class="tour_list">

<?php

$SQL = "SELECT * FROM tickets WHERE idactividad IN (SELECT id from actividades WHERE idempresa='${user['id']}');";

$ticketList = DB::execute_sql($SQL)->fetchAll(PDO::FETCH_NAMED);

echo "<table>";
echo "<tr>";
echo "<th>Cliente</th>";
echo "<th>Actividad</th>";
echo "<th>Precio</th>";
echo "<th>Unidades</th>";
echo "<th>Total</th>";
echo "</tr>";

foreach ($ticketList as $ticket) {
	
	$SQL = "SELECT nombre FROM usuarios WHERE id='${ticket['idcliente']}';";
	$cliente = DB::execute_sql($SQL)->fetchAll(PDO::FETCH_NAMED)[0]['nombre'];

	$SQL = "SELECT nombre FROM actividades WHERE id='${ticket['idactividad']}';";
	$actividad = DB::execute_sql($SQL)->fetchAll(PDO::FETCH_NAMED)[0]['nombre'];
	
	$precio = round($ticket['precio'], 1);
	$unidades = $ticket['unidades'];
	$total = $unidades * $precio;
	
	echo "<tr>";
	echo "<td>$cliente</td>";
	echo "<td>$actividad</td>";
	echo "<td>$precio</td>";
	echo "<td>$unidades</td>";
	echo "<td>$total</td>";
	echo "</tr>";
	
}

echo "</table>";
?>

</div>

<?php
echo "</div>";
echo "</div>";
echo "</div>";
echo "</section>";

View::footer();