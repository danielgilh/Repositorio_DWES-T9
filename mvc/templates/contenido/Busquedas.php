<!-- Busquedas.php -->
<?php
	$varError = '
	<!DOCTYPE html>
	<html lang="es">
	<head><title>Status: 404 Not Found</title><meta charset="utf-8">
	</head><body><h1>La página a la que intenta acceder no existe o no se encuentra disponible</h1></body>
	</html>';

	if (!defined("EN_CONTROLADOR")) die($varError);
	else //echo "Continuamos el proceso";
?>
<?php include 'mvc/templates/pag/base.php' ?>


<?php startblock('contenido1') ?>
<?php 
	echo '<div class="grupoForm">';
	echo $GLOBALS['Texto0a'];
	echo '<form action="" method="post">';
	echo '<div class="grupoFormTitulo">';
	
	//echo '<label for="nAutor">Introduce el nombre del autor o deja en blanco para mostrar todos los autores registrados:</label><br>';
	echo '<label for="' .$datosEtiqueta[0]. '">' .$datosEtiqueta[1]. '</label><br>';

	foreach ($formulario as $campo) {
		//Patrón: ('(0)type',   '(1)name',  '(2)value', '(3)placeholder')       =Muestra
		echo '<input type="' .$campo[0]. '" id="'.$campo[1].  '" name="'.$campo[1]. '" value="'.$campo[2]. '" placeholder="' .$campo[3]. '" ' .$campo[4]. '>';
	}

	echo '</div>';
    echo '</form>';

	echo ("<div id='divListaDatos'></div>");
    echo '</div>';

?>

<?php 
	endblock();
?>