<?php
// Esta API tiene dos posibilidades; Mostrar una lista de autores o mostrar la información de un autor específico.
require_once "../class/gestionLibros.php";

    //Datos del servidor MySQL:
    $GLOBALS['servidor'] ="127.0.0.1";
    $GLOBALS['usuario'] ="foc";
    $GLOBALS['contrasenna'] ="foc";
    $GLOBALS['bbdd'] ="bbdd_u-6";


function get_lista_nombre_autores($str) {
    $resultado = gestionLibros::datos_Autor_Y_Libros($str);

    return $resultado;
}



// Listado de páginas permitadas:
$posibles_URL = array(	"get_lista_autores",
						"get_datos_autor",
						"get_lista_libros",
						"get_datos_libro",
						"get_datos_autor_y_libros",
						"get_nombre_sugerido",
						"get_libro_sugerido"
					);
					
$valor = "Ha ocurrido un error";
					
if (isset($_GET["action"]) && in_array($_GET["action"], $posibles_URL)) {

	switch ($_GET["action"])
	{
		case $posibles_URL[5]:
			$valor = get_lista_nombre_autores($_GET["nom"]);
			break;
		
		case $posibles_URL[6]:
			//$valor = get_lista_nombre_libros($_GET["lib"]);
			break;
				
		default:
			break;
    }
}

//devolvemos los datos serializados en JSON
exit(json_encode($valor));
?>

