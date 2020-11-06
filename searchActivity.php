<?php

include_once ("data_access.class.php");
include_once ("presentation.class.php");

$value = $_POST['search'];

$SQL = "SELECT * FROM actividades WHERE nombre LIKE '%$value%' OR tipo  LIKE '%$value%' OR inicio LIKE '%$value%'";
$activities = DB::execute_sql($SQL)->fetchAll(PDO::FETCH_NAMED);

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
    $inicio = date("dd-mm-yyyy", $activity['inicio']);
    $duracion = $activity['duracion']/60;
    $imagen = View::imgtobase64($activity['imagen']);

    echo "<tr>";
    echo "<td class='linktabla'><a href='activity.php?nombre=$nombre'>$nombre</a></td>";
    echo "<td class='linktabla'>$precio €</td>";
    echo "<td class='linktabla'>$descripcion</td>";
    echo "</tr>";

}