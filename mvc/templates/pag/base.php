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

<?php
    require_once "ti.php";
    include "header.php";
    //include "nav.php";

    //$sRuta = "http://localhost:8080/0-PHP/5-DWES/Tarea-8/src/APIs/api.php";
    $sRuta = $GLOBALS['sRuta'];

?>

<!-- base.php -->

<!-- En este bloque se cargará el contenido -->

<br/>
<br/>

<div id="divContent">

    <aside>
        <div id="divAccesosDirectos">
            <a href=<?php echo $GLOBALS['Texto0'][0].$GLOBALS['Texto1'][0]; ?>>
                <span><?php echo $GLOBALS['Texto1'][1]?></span>
            </a>
        </div>
    </aside>
    <section id="section1">
        <article>
            <div id="articleMainDiv">
                <?php
                    startblock('contenido1');
                    endblock();

                    echo ('<div id="div_datosBBDD">');
                    echo ("</div>");
                ?>

            </div>
        </article>
    </section>
</div>



<?php
    include "footer.php"
?>

<?php




    /**
     * Imprime una página de error cuando no encuentra la página buscada
     * 
     * @author Daniel Gil <mi-email@email.com>
     * @version 1.0.0 Estable
     * 
     */
    function Funcion_Por_Defecto()
    {
        $varError = '
        <!DOCTYPE html>
        <html lang="es">
        <head><title>Status: 404 Not Found</title><meta charset="utf-8">
        </head><body><h1>La página a la que intenta acceder no existe o no se encuentra disponible</h1></body>
        </html>';
        die($varError);
    }
?>