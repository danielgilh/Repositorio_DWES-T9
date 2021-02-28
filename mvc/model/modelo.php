<?php
    //modelo.php
    /**
     * Descripción de los modelos de datos utilizados en el sitio web
     * 
     * @author Daniel Gil <mi-email@email.com>
     * @version 1.0.0 Estable
     */

	$varError = '
	<!DOCTYPE html>
	<html lang="es">
	<head><title>Status: 404 Not Found</title><meta charset="utf-8">
	</head><body><h1>La página a la que intenta acceder no existe o no se encuentra disponible</h1></body>
	</html>';

    $mysqli = '';
    
    //require_once "../../class/gestionLibros.php";
	if (!defined("EN_CONTROLADOR")) die($varError);
	else {
        //echo "Continuamos el proceso";
    }

?>