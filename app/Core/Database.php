
<?php

// ======================================================
// CLASE DATABASE
// ======================================================

// class permite definir una clase.
//
// Database es la clase que utilizaremos para administrar
// la conexión de nuestra aplicación con MySQL.

class Database
{
    // --------------------------------------------------
    // PROPIEDAD DE CONEXIÓN
    // --------------------------------------------------

    // private:
    // Esta propiedad solamente puede utilizarse
    // directamente dentro de la clase Database.
    //
    // static:
    // La propiedad pertenece a la clase, no a un objeto
    // individual. Podemos acceder a ella con self::.
    //
    // ?PDO:
    // Indica que puede almacenar un objeto PDO o null.
    //
    // = null:
    // Inicialmente no existe ninguna conexión.

    private static ?PDO $connection = null;


    // --------------------------------------------------
    // MÉTODO CONNECT()
    // --------------------------------------------------

    // public:
    // El método puede llamarse desde otras clases.
    //
    // static:
    // Permite llamarlo sin crear un objeto Database.
    //
    // connect():
    // Nombre del método que establece la conexión.
    //
    // : PDO
    // Indica que este método debe devolver un objeto PDO
    // cuando termina correctamente.

    public static function connect(): PDO
    {

        // ----------------------------------------------
        // 1. COMPROBAR SI YA EXISTE UNA CONEXIÓN
        // ----------------------------------------------

        // self::$connection:
        // Accede a la propiedad estática de la clase.
        //
        // !== null:
        // Comprueba que la conexión no sea null.
        //
        // Si ya existe una conexión, la reutilizamos.

        if (self::$connection !== null) {

            return self::$connection;

        }


        // ----------------------------------------------
        // 2. CARGAR LA CONFIGURACIÓN
        // ----------------------------------------------

        // __DIR__:
        // Devuelve la ruta del directorio actual.
        //
        // En este caso:
        // app/Core/
        //
        // ../../:
        // Retrocede dos directorios hasta app-base/.
        //
        // require:
        // Ejecuta database.php y recibe su return.
        //
        // $config:
        // Almacena el arreglo de configuración.

        $config = require __DIR__ . '/../../config/database.php';


        // ----------------------------------------------
        // 3. CONSTRUIR EL DSN
        // ----------------------------------------------

        // DSN significa Data Source Name.
        //
        // Es una cadena que indica a PDO:
        // - Qué motor de base de datos utilizaremos.
        // - En qué servidor se encuentra.
        // - Qué puerto utiliza.
        // - Qué base de datos seleccionaremos.
        // - Qué codificación de caracteres utilizaremos.
        //
        // Las llaves {} permiten insertar valores
        // del arreglo $config dentro de la cadena.

        $dsn = "mysql:host={$config['host']};"
             . "port={$config['port']};"
             . "dbname={$config['dbname']};"
             . "charset={$config['charset']}";


        // ----------------------------------------------
        // 4. INTENTAR ESTABLECER LA CONEXIÓN
        // ----------------------------------------------

        // try:
        // Ejecuta código que podría generar una excepción.
        //
        // Si ocurre un error PDO, el programa pasa
        // al bloque catch correspondiente.

        try {

            // new PDO():
            // Crea un objeto PDO e intenta conectarse
            // al servidor MySQL.
            //
            // Primer argumento: DSN.
            // Segundo argumento: usuario MySQL.
            // Tercer argumento: contraseña MySQL.
            // Cuarto argumento: opciones de PDO.

            self::$connection = new PDO(

                $dsn,

                $config['username'],

                $config['password'],

                [

                    // ----------------------------------
                    // MANEJO DE ERRORES
                    // ----------------------------------

                    // Indica que PDO debe lanzar
                    // excepciones cuando ocurra un error.

                    PDO::ATTR_ERRMODE =>
                        PDO::ERRMODE_EXCEPTION,


                    // ----------------------------------
                    // FORMATO DE LOS RESULTADOS
                    // ----------------------------------

                    // Devuelve los registros como
                    // arreglos asociativos.
                    //
                    // Ejemplo:
                    // ['id' => 1, 'nombre' => 'Taladro']

                    PDO::ATTR_DEFAULT_FETCH_MODE =>
                        PDO::FETCH_ASSOC,


                    // ----------------------------------
                    // CONSULTAS PREPARADAS
                    // ----------------------------------

                    // false:
                    // Desactiva la emulación de consultas
                    // preparadas del lado de PDO.
                    //
                    // Para consultas compatibles, utiliza
                    // la preparación nativa de MySQL.

                    PDO::ATTR_EMULATE_PREPARES =>
                        false

                ]

            );


            // ------------------------------------------
            // 5. DEVOLVER LA CONEXIÓN
            // ------------------------------------------

            // Si llegamos aquí, la conexión fue creada.
            //
            // return entrega el objeto PDO al código
            // que llamó Database::connect().

            return self::$connection;


        } catch (PDOException $e) {

            // ------------------------------------------
            // 6. CAPTURAR ERRORES DE CONEXIÓN
            // ------------------------------------------

            // PDOException:
            // Tipo de excepción generada por PDO.
            //
            // $e:
            // Objeto que contiene información del error.
            //
            // getMessage():
            // Obtiene el mensaje técnico del error.
            //
            // error_log():
            // Registra el error en el servidor PHP.

            error_log(
                'Error de conexión MySQL: ' . $e->getMessage()
            );


            // ------------------------------------------
            // 7. PROPAGAR UN ERROR CONTROLADO
            // ------------------------------------------

            // throw:
            // Lanza una excepción.
            //
            // RuntimeException:
            // Representa un error durante la ejecución.
            //
            // El mensaje es genérico para evitar
            // exponer información técnica al usuario.
            //
            // 0:
            // Código de la excepción.
            //
            // $e:
            // Conserva la excepción original como causa.

            throw new RuntimeException(
                'No fue posible establecer la conexión con la base de datos.',
                0,
                $e
            );

        }

    }

}
