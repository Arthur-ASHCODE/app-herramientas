
<?php

// ======================================================
// MODELO USUARIO - APP-BASE
// ======================================================

// Clase encargada de consultar los usuarios
// registrados en la tabla usuarios_sistema.

// Cargar la conexión centralizada a MySQL.
require_once __DIR__ . '/../Core/Database.php';


class Usuario
{

    // ==================================================
    // 1. BUSCAR USUARIO PARA AUTENTICACIÓN
    // ==================================================

    public static function buscarPorUsuario(string $usuario): ?array
    {
        // Obtener conexión PDO.
        $pdo = Database::connect();


        // --------------------------------------------------
        // CONSULTA SQL
        // --------------------------------------------------

        // Recuperar los campos necesarios para:
        // - Identificar al usuario.
        // - Verificar su estado.
        // - Validar su contraseña.
        //
        // La contraseña almacenada debe ser un hash
        // generado mediante password_hash().

        $sql = "
            SELECT
                id,
                nombre,
                usuario,
                password,
                estatus
            FROM usuarios_sistema
            WHERE usuario = :usuario
            LIMIT 1
        ";


        // --------------------------------------------------
        // PREPARAR CONSULTA
        // --------------------------------------------------

        $stmt = $pdo->prepare($sql);


        // --------------------------------------------------
        // EJECUTAR CONSULTA
        // --------------------------------------------------

        $stmt->execute([
            'usuario' => $usuario
        ]);


        // --------------------------------------------------
        // OBTENER RESULTADO
        // --------------------------------------------------

        $resultado = $stmt->fetch();


        // Si existe el usuario, devolver sus datos.
        // En caso contrario, devolver null.
        return $resultado ?: null;
    }

}
