<?php

include_once 'business.class.php';
include_once 'data_access.class.php';
include_once 'presentation.class.php';

if (User::getLoggedUser() != null) header("Location:index.php");

View::start();
View::header();

$login = true;

if (isset($_POST["access"])){
    $userName = $_POST["name"];
    $password = $_POST["password"];
    
    if(User::login($userName,$password)){
        header('Location:index.php');
    } else {
        $login = false;
    }
}

	?>

<!-- Seccion central -->
<section class="central">
	<div class="container title">
		<h1>Iniciar Sesión</h1>
	</div>
		<div class="background">
		<div class="container content">
			<div class="margin">
				<div class="form">
				    <form class="formlogin" method="POST" action="login.php">
				        <label class="labelogin" for="nombre">Usuario:</label><br>
				        <input class="inputlogin" type="text" name="name"><br>
				        <label class="labelogin" for="password">Contraseña:</label><br>
				        <input class="inputlogin" type="password" name="password"><br><br>
				        <input type="text" name="access" value="true" hidden>
				        <button class="button" type="submit">Identifícate</button><br>
				    </form>
				</div>
				<?php
                    if (!$login) {
                        echo "<p><b>Nombre o contraseña incorrectos</b></p>";
                    }
                ?>
			</div>
		</div>
	</div>
</section>

<?php
	View::footer();
?>
