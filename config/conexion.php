
<?php
session_start();

class Conectar {
    protected $dbn;

    // Método para conectar a la base de datos
    protected function Conexion() {
        try {
            $engine = "mysql";
            $server = "localhost";
            $user = "root";
            $password = ""; // Asegúrate de que la contraseña sea correcta (vacía por defecto en XAMPP)
            $database = "paginaBD"; // Verifica que esta base de datos exista
            $charset = "utf8";

            // DSN para PDO
            $dsn = sprintf("%s:host=%s;dbname=%s;charset=%s", $engine, $server, $database, $charset);

            // Crear la conexión
            $this->dbn = new PDO($dsn, $user, $password);
            $this->dbn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Confirmar conexión exitosa
            echo "La conexión a la base de datos fue exitosa.<br>";
        } catch (PDOException $e) {
            // Manejo de errores en la conexión
            echo "Error de conexión: " . $e->getMessage() . "<br>";
            exit;
        }
    }

    // Método para obtener la conexión
    public function getConexion() {
        if (!$this->dbn) {
            $this->Conexion();
        }
        return $this->dbn;
    }

    // Configurar el conjunto de caracteres
    public function set_names() {
        if (is_object($this->dbn)) {
            return $this->dbn->exec("SET NAMES 'utf8'");
        } else {
            throw new Exception("Error: la conexión no está inicializada correctamente.");
        }
    }

    // Método para obtener la ruta base
    public function ruta() {
        return "http://localhost/Proyecto/index.php"; // Ajusta esta ruta según tu proyecto
    }
}

// Código de prueba para verificar conexión
try {
    $conexion = new Conectar();
    $db = $conexion->getConexion();
    $conexion->set_names(); // Configurar caracteres
    echo "Conexión y configuración establecidas correctamente.";
} catch (Exception $e) {
    echo "Error general: " . $e->getMessage();
}
?>
