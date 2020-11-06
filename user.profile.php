<?php

include_once ("presentation.class.php");
include_once ("business.class.php");

View::start();

View::header();

$id = User::getLoggedUser()['id'];

$SQL = "SELECT * FROM tickets WHERE idcliente='$id';";
$alltickets = DB::execute_sql($SQL)->fetchAll(PDO::FETCH_NAMED);

echo "<!-- Seccion central -->";
echo "<section class='central'>";
echo "<div class='container title'>";
echo "<h1>Mis Actividades</h1>";
echo "</div>";
echo "<div class='background'>";
echo "<div class='container content'>";
echo "<div class='table_container'>";
echo "<table id='activities'>";
echo "<tr>";
echo "<th>Actividad</th>";
echo "<th class='lugartabla'>Precio</th>";
echo "<th class='desc-tabla'>Cantidad de Tickets</th>";
echo "</tr>";


foreach ($alltickets as $ticket) {

    $idticket = $ticket['id'];
    $idactividad = $ticket['idactividad'];
    $precio = $ticket['precio'];
    $unidades = $ticket['unidades'];
    
    $SQL = "SELECT nombre FROM actividades WHERE id='${ticket['idactividad']}'";
	$actividad = DB::execute_sql($SQL)->fetchAll(PDO::FETCH_NAMED)[0]['nombre'];
    
    echo "<tr>";
    echo "<td class='linktabla'><a href='activity.php?id=$idactividad'>$actividad</a></td>";
    echo "<td class='linktabla'>$precio €</td>";
    echo "<td class='linktabla'>$unidades</td>";
    echo "</tr>";

}

echo "</table>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</section>";




	View::footer();
?>
