<?php

include_once ("presentation.class.php");
include_once ("business.class.php");

View::start();

View::header();

$login = true;
$ppass = true;
$completo = false;

if (isset($_POST["access"])){

    $userName = $_POST["user"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $place = $_POST["place"];
    $dir = $_POST["dir"];
    $tlfn = $_POST["tlfn"];
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];
    
    if (empty($userName) or empty($email) or empty($name) or empty($place) 
                         or empty($dir) or empty($tlfn) or empty($password1) 
                         or empty($password2)) {
        $login = false;
        $completo = false;
    } else{
        $completo = true;
    }
    
    if($password1 != $password2){
    	$login = false;
        $ppass = false;
    } else{
        $ppass = true;
    }
    
    if($completo and $ppass){

        $tipo = 3;

        if(isset($_POST['tipo'])) $tipo = $_POST['tipo'];

        if(User::registerUser($userName, md5($password1), $name, $tipo, $email, //3 es para hacerlo cliente
        					  $place, $dir, $tlfn)){
            header('Location:index.php');
        } else {
            $login = false;
        }
    }
    
    
}


?>
<!-- Seccion central -->
<section class="central">
	<div class="container title">
		<h1>Regístrate</h1>
	</div>
		<div class="background">
		<div class="container content">
			<div class="margin">
				<div class="form">
				    <form class="formlogin" method="POST" action="register.php">
				        
                        <input type="text" name="access" value="true" hidden><br><br>
				        
                        <label class="labelogin" for="user">Usuario:</label><br>
				        <input class="inputlogin" type="text" name="user"><br><br>
				        
                        <label class="labelogin" for="email">Email:</label><br>
				        <input class="inputlogin" type="text" name="email"><br><br>
				        
                        <label class="labelogin" for="name">Nombre:</label><br>
				        <input class="inputlogin" type="text" name="name"><br><br>

                        <?php

                        if(User::getLoggedUser()['tipo'] == 1) {

                        ?>
                        
                        <label class="labelogin">Tipo:</label><br>
                        <input type="number" name="tipo" min="1" max="3" value="3"><br><br>

                        <?php
                        }
                        ?>
				        
                        <label class="labelogin" for="place">Poblacion:</label><br>
				        <input class="inputlogin" type="text" name="place"><br><br>
				        
                        <label class="labelogin" for="dir">Direccion:</label><br>
				        <input class="inputlogin" type="text" name="dir"><br><br>
				        
                        <label class="labelogin" for="tlfn">Telefono:</label><br>
				        <input class="inputlogin" type="text" name="tlfn"><br><br>
				        
                        <label class="labelogin" for="password1">Contraseña:</label><br>
				        <input class="inputlogin" type="password" name="password1"><br><br>
				        
                        <label class="labelogin" for="password2">Confirmar Contraseña:</label><br>
				        <input class="inputlogin" type="password" name="password2"><br><br>
				        
                        <button class="button" type="submit">Crear Cuenta</button><br>

				    </form>
				</div>
				<?php
                    if (!$login) {
                        if (!$ppass) {
                            echo "<p><b>Las Contraseñas no coinciden</b></p>";
                        }
                        if(!$completo){
                            echo "<p><b>Rellene todos los campos</b></p>";
                        }
                    }
                ?>
			</div>
		</div>
		</div>
	</div>
</section>

<?php
	View::footer();