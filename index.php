<?php
    //index.php
    const EN_CONTROLADOR = true;

    require_once "mvc/model/modelo.php";
    require_once 'mvc/controller/controladores.php';
    require_once "src/class/gestionLibros.php";

    // Recogemos la uri insertada
    //$URI = $_SERVER['REQUEST_URI'];

    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $segments = explode('/', $path);
    $URI = $segments[count($segments)-1];
    
    //Datos del servidor MySQL:

    $GLOBALS['servidor'] ="127.0.0.1";
    $GLOBALS['usuario'] ="foc";
    $GLOBALS['contrasenna'] ="foc";
    $GLOBALS['bbdd'] ="bbdd_u-6";

    //Textos varios:
    $GLOBALS['Texto0'] = array($_SERVER['SCRIPT_NAME']."?action=", "Búsqueda de autores");

    $GLOBALS['Texto1'] = array("get_lista_autores", "Listado de autores");
    $GLOBALS['Texto2'] = array("get_datos_autor", "Búscar datos de un autor"); //??
    $GLOBALS['Texto3'] = array("get_lista_libros", "Listado de libros");
    $GLOBALS['Texto4'] = array("get_datos_libro", "Búscar datos de un libro");
    $GLOBALS['Texto5'] = array("get_datos_autor_y_libros", "Búscar los datos del autor y sus libros");
    
    $GLOBALS['Texto4b'] = array("/BorrarAutorYLibros", "Borrar autor y libros");
    $GLOBALS['Texto6'] = array("/RestaurarBBDD", "Restaurar base de datos");

    //Indica la ubicación de Api
    $GLOBALS['sRuta'] = "http://localhost:8080/0-PHP/5-DWES/Tarea-8/src/APIs/api.php";
    $GLOBALS['sRuta2'] = "src/APIs/api.php";



    //Indica la opción seleccionada
    $GLOBALS['Opcion1'] = "0"; // Codigo de identificacion del boton (submit) pulsado;

    //echo ">>>$URI<br>";
    //echo $_GET['action']."<br/>";

    if (isset($_GET["action"])) {

        if ((($_GET["action"]) == $GLOBALS['Texto1'][0])) {
            // Funcion del fichero controladores.php
            //controlador_index(); // Se ejecuta el controlador específico de index
            $GLOBALS['Texto0a'] = $GLOBALS['Texto1'][1];
            controlador_BusquedaAutor(); 

        } elseif ($URI == 'BusquedaAutores') {
            // Se ejecuta el controlador específico de registro
            $GLOBALS['Texto0a'] = $GLOBALS['Texto1'][1];
            controlador_BusquedaAutor();

        } elseif (($_GET["action"]) == $GLOBALS['Texto3'][0]) {
            // Se ejecuta el controlador específico de registro
            $GLOBALS['Texto0a'] = $GLOBALS['Texto3'][1];
            controlador_BuscarAlgo();

        } elseif ($URI == 'BusquedaLibros') {
            // Se ejecuta el controlador específico de registro
            $GLOBALS['Texto0a'] = $GLOBALS['Texto3'][1];
            controlador_BuscarLibro();

        } elseif ($URI == 'BorrarAutor') {
            // Se ejecuta el controlador específico de registro
            $GLOBALS['Texto0a'] = $GLOBALS['Texto4'][1];
            controlador_BorrarAutor();

        } elseif ($URI == 'BorrarAutorYLibros') {
            // Se ejecuta el controlador específico de registro
            $GLOBALS['Texto0a'] = $GLOBALS['Texto4b'][1];
            controlador_BorrarAutorYLibros();

        } elseif ($URI == 'BorrarLibro') {
            // Se ejecuta el controlador específico de registro
            $GLOBALS['Texto0a'] = $GLOBALS['Texto5'][1];
            controlador_BorrarLibro();

        } elseif ($URI == 'RestaurarBBDD') {
            // Se ejecuta el controlador específico de registro
            $GLOBALS['Texto0a'] = $GLOBALS['Texto6'][1];
            controlador_RestaurarBBDD();

        } else { //Podemos gestionar errores de URI de esta forma
            header('Status: 404 Not Found');
            echo '<html><body><h1>La página a la que intenta acceder no       
                existe</h1></body></html>';
        }
    
    } else {
        if (($URI == 'index.php')) {
            // Funcion del fichero controladores.php
            //controlador_index(); // Se ejecuta el controlador específico de index
            $GLOBALS['Texto0a'] = $GLOBALS['Texto1'][1];
            controlador_BusquedaAutor(); 
        }
    }


?>