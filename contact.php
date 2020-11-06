<?php

	include ("presentation.class.php");
	View::start();
	View::header();

	?>
<!-- Seccion central -->
<section class="central">
	<div class="container title">
		<h1>Contacto</h1>
	</div>
		<div class="background">
		<div class="container content">
			<div class="margin">
				<div class="form">
				    <form class="formcontact" method="POST" action="index.php">
				        <label class="labelcontact" for="nombre">Nombre:</label><br>
				        <input class="inputcontact" type="text" name="name"><br>
				        <label class="labelcontact" for="motivo">Asunto:</label><br>
				        <input class="inputcontact" type="text" name="motivo"><br><br>
				        <textarea class="textareacontact" placeholder="Escriba aqui su propuesta de participación"></textarea><br><br>
				        <button class="buttoncontact" type="submit">Enviar</button><br>
			    	</form>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
	View::footer();
?>
