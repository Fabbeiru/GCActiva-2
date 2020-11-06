<?php

include_once ("presentation.class.php");
include_once ("data_access.class.php");

View::start();

View::header();

?>

	<!-- Seccion central -->
	<section class="central">
		<div class="container title">
			<h1>¿Qué es GCActiva?</h1>
		</div>
		<div class="background">
			<div class="container content">
				<div class="margin">
					<p> &nbsp;&nbsp; La empresa se denomina GCActiva y, mediante un portal en internet, se dedica esencialmente a 
						ofrecer venta de tickets de actividades a realizar en la isla de Gran Canaria. Por un lado ofrece 
						actividades atractivas a los visitantes y por otro ofrece un medio de ofrecer en internet sus 
						servicios a los empresarios del sector en la isla. Los productos incluyen, entradas a espectáculos, 
						parques temáticos, tours guiados, senderismo, actividades gratuitas, etc. </p>
					<p> &nbsp;&nbsp; ¿Estás buscando regalos en Gran Canaria? ¡Has encontrado el sitio más adecuado! Déjate sorprender
						con los planes más originales y exclusivos que ofrece GCActiva. Podrás divertirte con la variedad 
						de diferentes actividades que te proponemos. ¡No te quedes sin una de las mejores experiencias que 
						ofrece la isla! </p>
				</div>
			</div>
		</div>

		<div class="container title">
			<h1>Sobre la isla</h1>
		</div>
		<div class="background">
			<div class="container content">
				<div class="margin">
				<p> &nbsp;&nbsp; Las Palmas de Gran Canaria es una ciudad y municipio español, capital de la isla de Gran Canaria, 
					de la Provincia de Las Palmas y de la Comunidad Autónoma de Canarias (capitalidad compartida con Santa 
					Cruz de Tenerife). Con una población de 379 925 habitantes en 2019, es la ciudad más poblada de Canarias y 
					la novena de España.</p>
				<p> &nbsp;&nbsp; La ciudad fue fundada en 1478, siendo considerada la capital de facto (sin significado jurídico y real) 
					del archipiélago canario hasta el siglo XVII. Es sede de la Delegación del Gobierno de España, así como 
					sede de su correspondiente subdelegación provincial, de la presidencia del Gobierno de Canarias en períodos 
					legislativos alternos con Santa Cruz de Tenerife, de la Presidencia del Tribunal Superior de Justicia de Canarias,
					de la Diócesis de Canarias (que engloba a la provincia de Las Palmas), del Consejo Económico y Social de Canarias,
					así como otras instituciones de diversa importancia como la Casa África. El Carnaval de Las Palmas de Gran Canaria 
					es uno de los eventos más importantes de Canarias, y goza de una importante proyección nacional e internacional.</p>
				</div>
			</div>
		</div>

		<div class="container title">
			<h1>Actividades populares</h1>
		</div>
		<div class="background">
			<div class="container content">
				<div class="margin">
					<section class="galery">
						<div class="galery-imgs">
						    
						    <?php
						    
						    $SQL = "SELECT * FROM actividades;";
						    $activities = DB::execute_sql($SQL)->fetchAll(PDO::FETCH_NAMED);
						    
						    foreach ($activities as $activity) {
						        $id = $activity['id'];
						        $nombre = $activity['nombre'];
						        $imagen = View::imgtobase64($activity['imagen']);
						        
						        echo $html = "
						        <div class='image-galery'>
								    <img src='$imagen' alt='Imagen de $nombre' title='$nombre'>
								    <div class='hover-galery'>
									    <img src='imagenes/icon.png'>
									    <p><a href='activity.php?id=$id'>$nombre</a></p>
								    </div>
							    </div>
						        ";
						    }
						    
						    ?>
							
						</div>           
					</section>
				</div>
			</div>
		</div>
	</section>

<?php
View::footer();
?>
