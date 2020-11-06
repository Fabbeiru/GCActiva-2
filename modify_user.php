<?php

include_once ("data_access.class.php");
include_once ("presentation.class.php");

View::start();

View::header();

if (isset($_POST['id'])) {

	$id = $_POST['id'];
	$cuenta = $_POST['cuenta'];
	$nombre = $_POST['nombre'];
	$tipo = $_POST['tipo'];
	$email = $_POST['email'];
	$poblacion = $_POST['poblacion'];
	$direccion = $_POST['direccion'];
	$telefono = $_POST['telefono'];

	$SQL = "UPDATE usuarios SET "
	. "cuenta='$cuenta',"
	. "nombre='$nombre',"
	. "tipo='$tipo',"
	. "email='$email',"
	. "poblacion='$poblacion',"
	. "direccion='$direccion',"
	. "telefono='$telefono'"
	. "where id='$id'";

	DB::execute_sql($SQL);

} else $id = $_GET['id'];

$SQL = "SELECT * FROM usuarios WHERE id='$id';";
$usuario = DB::execute_sql($SQL)->fetchAll(PDO::FETCH_NAMED)[0];

$cuenta = $usuario['cuenta'];
$clave = $usuario['clave'];
$nombre = $usuario['nombre'];
$tipo = $usuario['tipo'];
$email = $usuario['email'];
$poblacion = $usuario['poblacion'];
$direccion = $usuario['direccion'];
$telefono = $usuario['telefono'];

?>

<!-- Seccion central -->
<section class="central">
	<div class="container title">
		<h1>¿Qué es GCActiva?</h1>
	</div>
	<div class="background">
		<div class="container content">
			<div class="margin">
				<form action="modify_user.php" method="POST" class="modify_user">

					<label>Cuenta:</label><br>
					<input type="text" name="cuenta" value="<?php echo $cuenta ?>" required><br><br>

					<label>Nombre:</label><br>
					<input type="text" name="nombre" value="<?php echo $nombre ?>" required><br><br>

					<label>Tipo:</label><br>
					<input type="number" name="tipo" value="<?php echo $tipo ?>" min="1" max="3" required><br><br>

					<label>Email:</label><br>
					<input type="email" name="email" value="<?php echo $email ?>" required><br><br>

					<label>Población:</label><br>
					<input type="text" name="poblacion" value="<?php echo $poblacion ?>" required><br><br>

					<label>Dirección:</label><br>
					<input type="text" name="direccion" value="<?php echo $direccion ?>" required><br><br>

					<label>Teléfono:</label><br>
					<input type="text" name="telefono" value="<?php echo $telefono ?>" required><br><br>

					<input type="hidden" name="id" value="<?php echo $id ?>">
					<input type="submit" value="Modificar">

				</form>
			</div>
		</div>
	</div>
</section>

<?php
View::footer();