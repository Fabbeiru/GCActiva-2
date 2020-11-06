<?php

include_once ("presentation.class.php");
include_once ("data_access.class.php");

if (isset($_POST['command'])) {

    $idcliente = User::getLoggedUser()['id'];
    $idactividad = $_POST['id'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    $SQL = "INSERT INTO tickets (idcliente, idactividad, precio, unidades) values ("
    . "'$idcliente',"
    . "'$idactividad',"
    . "'$precio',"
    . "'$cantidad')";

    if (DB::execute_sql($SQL)) header("Location:perfil.php");

}

View::start();

View::header();

$id = $_GET['id'];

$SQL = "select * from actividades where id='$id';";
$activity = DB::execute_sql($SQL)->fetchAll(PDO::FETCH_NAMED)[0];

$nombre = $activity['nombre'];
$tipo = $activity['tipo'];
$precio = $activity['precio'];
$aforo = $activity['aforo'];
$duracion = round($activity['duracion']/60);
$inicio = date("d-m-Y", $activity['inicio']);
$descripcion = $activity['descripcion'];
$idempresa = $activity['idempresa'];

$SQL = "select nombre from empresas where idempresa='$idempresa';";
$empresa = DB::execute_sql($SQL)->fetchAll(PDO::FETCH_NAMED)[0]['nombre'];

$SQL = "SELECT unidades FROM tickets WHERE idactividad='$id';";
$tickets = DB::execute_sql($SQL)->fetchAll(PDO::FETCH_NAMED);

$cont = 0;

foreach ($tickets as $ticket) {
    $cont = $cont + intval($ticket['unidades']);
}

$maxtickets = $aforo - $cont;

?>
<section class='central'>
    <div class='container title'>
	    <h1><?php echo $nombre; ?></h1>
    </div>
	<div class='background'>
	    <div class='container content'>
	        <div class='margin'>
                <div class="tour">
                	<!-- Cuerpo -->
                	<div class="body">
                	    
                		<!-- Imagen -->
                		<div class="img">
                		    <?php
                		    if(empty($activity['imagen'])){
                                $imagen = "No hay Imagen Todavia";
                            }else{
                                $imagen = View::imgtobase64($activity['imagen']);
                                echo "<img src='$imagen' alt='$descripcion'>";
                            }
                            ?>
                		</div>
                		
                		<!-- Descripcion -->
                		<div class="desc">
                			<?php echo $descripcion; ?>
                		</div>
                
                		<!-- Info -->
                		<div class="info">
                			<div><b>Fecha:</b><div class="value"><?php echo $inicio ?></div></div>
                			<div><b>Duración:</b><div class="value"><?php echo $duracion ?> min</div></div>
                			<div><b>Precio:</b><div class="value"><?php echo $precio ?>€</div></div>
                			<div><b>Empresa:</b><br><a href="empresa.php?name=<?php echo $empresa ?>"><?php echo $empresa ?></a></div>
                			<?php 
                			if(User::getLoggedUser()['tipo'] == 3){
                			    if($maxtickets != 0){
                			        $html = "
                			        <form action='activity.php?id=<?php echo $id ?>' method='POST'>
                                        <label>Cantidad:</label><br>
                                        <input type='number' name='cantidad' value='1' min='1' max='$maxtickets'>
                                        <input type='text' name='id' value='$id' hidden>
                                        <input type='text' name='precio' value='$precio' hidden>
                                        <input type='text' name='command' value='comprar' hidden>
                                        <input type='submit' value='Comprar'>
                                    </form>
                    			    ";
                    			    echo $html;
                			    }
                			}
                			?>
                		</div>
                	</div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
View::footer();
?>