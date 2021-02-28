<?php

use PHP_CodeSniffer\Standards\Squiz\Sniffs\Strings\EchoedStringsSniff;

$mysqli;


/**
 * Descripción de la clase
 * @author Daniel Gil <mi-email@email.com
 * @version 1.0.0 En pruebas
 */
class gestionLibros
{
    public $servidor;
    public $bbdd;
    public $usuario;
    public $contrasenna;


    /**
     * Constructor de la clase
     * 
     * @param string $servidor Indica el servidor donde esta alojada la base de datos 
     * @param string $bbdd Indica el nombre de la base de datos
     * @param string $usuario Indica el nombre de usuario 
     * @param string $contrasenna Indica la contraseña del usuario 
     * 
     */
    function __construct($servidor, $bbdd, $usuario, $contrasenna)
    {//Constructor

        $this->servidor = $servidor;
        $this->bbdd = $bbdd;
        $this->usuario = $usuario;
        $this->contrasenna = $contrasenna;

        gestionLibros::AbrirConexion($servidor, $bbdd, $usuario, $contrasenna);

    }



    // Metodos


    /**
     * Asigna el servidor al objeto de la clase
     * 
     * @param string $servidor Indica el nombre del articulo 
     * 
     */
    function set_servidor($servidor) {
        $this->servidor = $servidor;
    }
    /**
     * Devuelve el servidor del objeto de la clase
     * 
     * @return string $servidor
     * 
     */
    function get_servidor() {
        return $this->servidor;
    }

    /**
     * Asigna el servidor al objeto de la clase
     * 
     * @param string $servidor Indica el nombre del articulo 
     * 
     */
    function set_bbdd($bbdd) 
    {
        $this->bbdd = $bbdd;
    }
    /**
     * Devuelve el bbdd del objeto de la clase
     * 
     * @return string $bbdd
     * 
     */
    function get_bbdd() 
    {
        return $this->bbdd;
    }

    /**
     * Asigna el usuario al objeto de la clase
     * 
     * @param string $usuario Indica el nombre del articulo 
     * 
     */
    function set_usuario($usuario) 
    {
        $this->usuario = $usuario;
    }
    /**
     * Devuelve el usuario del objeto de la clase
     * 
     * @return string $usuario
     * 
     */
    function get_usuario() 
    {
        return $this->usuario;
    }

    /**
     * Asigna el contrasenna al objeto de la clase
     * 
     * @param string $contrasenna Indica el nombre del articulo 
     * 
     */
    function set_contrasenna($contrasenna) 
    {
        $this->contrasenna = $contrasenna;
    }
    /**
     * Devuelve el contrasenna del objeto de la clase
     * 
     * @return string $contrasenna
     * 
     */
    function get_nombre()
    {
        return $this->contrasenna;
    }


    public static function AbrirConexion($servidor, $bbdd, $usuario, $contrasenna)
    {
        $MySqli = mysqli_connect($servidor, $usuario, $contrasenna, $bbdd);
        
        if (!$MySqli) {
            echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
            echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
            echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
            exit;
        };

        $GLOBALS['MySql'] = $MySqli;
    }

    public static function CerrarConexion()
    {
        $MySqli = $GLOBALS['MySql'];
        $MySqli->close();
        //Echo ("cerrada...");
    }
   
    public function Consulta($Consulta)
    {
        $MySqli = $GLOBALS['MySql'];
        $Resultados = $MySqli->query($Consulta);

        return $Resultados;
    }



    /**
     * Devuelve un listado de los autores y los libros publicados por el autor indicado
     * 
     * @author Daniel Gil <mi-email@email.com>
     * @version 1.0.0 Estable
     * @param string $str Parte del nombre o del apellido del autor a buscar
     * @return $resultado Devuelve un listado de los autores y sus libros publicados
     * 
     */
    public static function datos_Autor_Y_Libros($str)
    {
        $MySqli = new gestionLibros($GLOBALS['servidor'], $GLOBALS['bbdd'], $GLOBALS['usuario'], $GLOBALS['contrasenna']);

        $query = 'SELECT 
            Autor.id as "Id_Autor",
            Autor.nombre,
            Autor.apellido,
            Autor.nacionalidad,
            Libro.id as "Id_Libro",
            Libro.titulo
        FROM Autor
        JOIN Libro ON (Autor.id = Libro.id_autor)
        WHERE Autor.nombre LIKE "%' .$str. '%" OR Autor.apellido LIKE "%' .$str. '%"';

        $resultado = $MySqli->Consulta($query);
        
        if ($resultado->num_rows > 0) {
            $detalles = $resultado->fetch_all(MYSQLI_ASSOC);
        } else {
            $detalles = 0;
        }

        $resultado->free();
        $MySqli->CerrarConexion();

        return ($detalles);
    }



    /**
     * Restaura la Base de datos a la forma inical de la tarea
     * 
     * @author Daniel Gil <mi-email@email.com>
     * @version 1.0.0 Estable
     * 
     */
    public static function RestaurarBBDD()
    {
        $MySqli = new gestionLibros($GLOBALS['servidor'], $GLOBALS['bbdd'], $GLOBALS['usuario'], $GLOBALS['contrasenna']);
		
        $query = array("DROP TABLE Libro;","DROP TABLE Autor;","
		CREATE TABLE `Autor` (
			`id` INT(4) NOT NULL ,
			`nombre` VARCHAR(15) NOT NULL ,
			`apellido` VARCHAR(25) NOT NULL,
			`nacionalidad` VARCHAR(10) NOT NULL
		) ENGINE = InnoDB;",
		"ALTER TABLE `Autor` ADD CONSTRAINT
			`Autor_PK` PRIMARY KEY (`id`);",
		"CREATE TABLE `Libro` (
			`id` INT(4) NOT NULL ,
			`titulo` VARCHAR(50) NOT NULL ,
			`f_publicacion` VARCHAR(10) NOT NULL,
			`id_autor` INT(4) DEFAULT NULL
		) ENGINE = InnoDB;",
		"ALTER TABLE `Libro` ADD CONSTRAINT
			`Libro_PK` PRIMARY KEY (`id`);",
		"ALTER TABLE `Libro` ADD CONSTRAINT
			`Libro_FK_1` FOREIGN KEY (`id_autor`)
			REFERENCES `Autor` (`id`) ON DELETE SET null;",
			
		"INSERT INTO Autor(id, nombre, apellido, nacionalidad)
			VALUES (0, 'J.R.R.','Tolkien', 'Inglaterra');",
		"INSERT INTO Autor(id, nombre, apellido, nacionalidad)
			VALUES (1, 'Isaac','Asimov', 'Rusia');",
		"INSERT INTO Libro(id, titulo, f_publicacion, id_autor)
			VALUES (0, 'El Hobbit','21/09/1937', '0');",
		"INSERT INTO Libro(id, titulo, f_publicacion, id_autor)
			VALUES (1, 'La Comunidad del anillo','29/07/1954', '0');",
		"INSERT INTO Libro(id, titulo, f_publicacion, id_autor)
			VALUES (2, 'Las dos torres','11/11/1954', '0');",
		"INSERT INTO Libro(id, titulo, f_publicacion, id_autor)
			VALUES (3, 'El retorno del Rey','20/10/1955', '0');",
		"INSERT INTO Libro(id, titulo, f_publicacion, id_autor)
			VALUES (4, 'Un guijarro en el cielo','19/01/1950', '1');",
		"INSERT INTO Libro(id, titulo, f_publicacion, id_autor)
			VALUES (5, 'Fundación','01/06/1951', '1');",
		"INSERT INTO Libro(id, titulo, f_publicacion, id_autor)
			VALUES (6, 'Yo, robot','02/12/1950', '1');"
		);
		
		for ($e = 0; $e<count($query); $e++) {
			//($MySqli->Consulta($query[$e])
			if ($MySqli->Consulta($query[$e]) === true) {
				echo "Consulta completada."."<br/>";
			} else {
				echo "Error al realizar la transacción: " . $MySqli->error."<br/>";
			}
		}
		/*
		if ($MySqli->Consulta($query) === TRUE) {
		  echo "Record deleted successfully";
		} else {
		  echo "Error deleting record: " . $MySqli->error;
		}
		*/
		
        $MySqli->CerrarConexion();
		
		echo "<br/>"."Base de datos restaurada correctamente."."<br/>";
    }
}
?>