<?php
    // controladores.php
	$varError = '
	<!DOCTYPE html>
	<html lang="es">
	<head><title>Status: 404 Not Found</title><meta charset="utf-8">
	</head><body><h1>La página a la que intenta acceder no existe o no se encuentra disponible</h1></body>
	</html>';

	if (!defined("EN_CONTROLADOR")) die($varError);
	else {//echo "Continuamos el proceso";
    }

    /**
     * Muestra la página principal
     * 
     * @author Daniel Gil <mi-email@email.com>
     * @version 1.0.0 Estable
     * 
     */




    /**
     * Función para mostrar el formulario de busqueda de autores
     * 
     * @author Daniel Gil <mi-email@email.com>
     * @version 1.0.0 Estable
     * 
     */
    function controlador_BusquedaAutor()
    {
        //require 'validadores.php';
        $datosEtiqueta = array(
            // Patrón: '(0)Valor for', '(1)texto a mostrar'
            'nAutor',
            'Introduce el nombre del autor que deseas buscar:'
        );

        $formulario = array(
            //Patrón: ('(0)type',   '(1)name',  '(2)value', '(3)placeholder',       '(4)ParametroExtra-1')       =Muestra
            //Patrón: ('text',      'Usuario',  '',         '"Nombre de usuario:"', 'onkeyup="mostrar_sugerencias(this.value)"') = Para la caja de texto
            //Patrón: ('submit',    'submit',   'Enviar',   '')                     = Para el botón submit
            array('text',       'nAutor',      '',         'Nombre del autor:', " list='lista1' onkeypress='soloCaracteres()' onkeyup='mostrarAutoresSugeridos(this.value".', "'.$GLOBALS['sRuta2'].'", "'.$_SERVER["SCRIPT_NAME"].'"'.")'")
        );

        if(isset($_POST['registrar']))
        {

        } else {
            require './mvc/templates/contenido/Busquedas.php';
        }
    }

?>
