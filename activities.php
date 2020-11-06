<?php

include ("presentation.class.php");

View::start();
View::header();

$SQL = "SELECT * FROM actividades;";
$activities = DB::execute_sql($SQL)->fetchAll(PDO::FETCH_NAMED);

echo "<!-- Seccion central -->";
echo "<section class='central'>";
echo "<div class='container title'>";
echo "<h1>Actividades populares en GCActiva</h1>";
echo "</div>";
echo "<div class='background'>";
echo "<div class='container content'>";
echo "<div class='table_container'>";
echo "<div class='searchInput'>";
echo "<label>Buscar:</label>";
echo "<input id='search' type='text' onkeyup='startTimer()' onkeydown='restartTimer()' placeholder='Opera'>";
echo "</div>";
echo "<table id='activities'>";
echo "<tr>";
echo "<th>Nombre</th>";
echo "<th class='lugartabla'>Precio</th>";
echo "<th class='desc-tabla'>Descripción</th>";
echo "</tr>";

foreach ($activities as $activity) {

    $id = $activity['id'];
    $idempresa = $activity['idempresa'];
    $nombre = $activity['nombre'];
    $tipo = $activity['tipo'];
    $descripcion = $activity['descripcion'];
    $precio = $activity['precio'];
    $aforo = $activity['aforo'];
    $inicio = date("d-m-y", $activity['inicio']);
    $duracion = $activity['duracion']/60;

    echo "<tr>";
    echo "<td class='linktabla'><a href='activity.php?id=$id'>$nombre</a></td>";
    echo "<td class='linktabla'>$precio €</td>";
    echo "<td class='linktabla'>$descripcion</td>";
    echo "</tr>";

}

echo "</table>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</section>";

View::footer();
