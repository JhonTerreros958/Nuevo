<?php
// Conexión a la base de datos MySQL
function conectar_db() {
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "paginaBD";

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Error al conectar a MySQL: " . $conn->connect_error);
    }
    return $conn;
}

// Crear las tablas si no existen
function crear_tablas() {
    $conn = conectar_db();

    $conn->query("
        CREATE TABLE IF NOT EXISTS consultas (
            id_consulta INT AUTO_INCREMENT PRIMARY KEY,
            id_usuario INT NOT NULL,
            contenido TEXT NOT NULL,
            fecha_consulta TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    $conn->query("
        CREATE TABLE IF NOT EXISTS contacto (
            id_contacto INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(80) NOT NULL,
            correo VARCHAR(80) NOT NULL,
            mensaje TEXT NOT NULL,
            fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    $conn->query("
        CREATE TABLE IF NOT EXISTS menu (
            id INT AUTO_INCREMENT PRIMARY KEY,
            opcion TEXT NOT NULL,
            url TEXT NOT NULL,
            est INT NOT NULL
        )
    ");
    $conn->query("
        CREATE TABLE IF NOT EXISTS socialmedia (
            socmed_id INT AUTO_INCREMENT PRIMARY KEY,
            socmed_icono VARCHAR(80) NOT NULL,
            socmed_url TEXT NOT NULL,
            est INT NOT NULL
        )
    ");
    $conn->query("
        CREATE TABLE IF NOT EXISTS usuarios (
            usu_id INT AUTO_INCREMENT PRIMARY KEY,
            usu_nom TEXT NOT NULL,
            usu_apep TEXT NOT NULL,
            usu_apem TEXT NOT NULL,
            usu_correo TEXT NOT NULL,
            usu_pass TEXT NOT NULL,
            usu_telf TEXT NOT NULL,
            est INT NOT NULL
        )
    ");
    $conn->close();
}

// Insertar datos
function insertar($tabla, $datos) {
    $conn = conectar_db();
    $placeholders = implode(', ', array_fill(0, count($datos), '?'));
    $stmt = $conn->prepare("INSERT INTO $tabla VALUES (NULL, $placeholders)");
    $stmt->bind_param(str_repeat('s', count($datos)), ...$datos);
    $stmt->execute();
    $conn->close();
}

// Mostrar todos los registros
function mostrar_todos($tabla) {
    $conn = conectar_db();
    $result = $conn->query("SELECT * FROM $tabla");
    $datos = [];
    while ($row = $result->fetch_assoc()) {
        $datos[] = $row;
    }
    $conn->close();
    return $datos;
}

// Actualizar registros
function actualizar($tabla, $columna_id, $id_valor, $actualizaciones) {
    $conn = conectar_db();
    $set_clause = implode(', ', array_map(fn($col) => "$col = ?", array_keys($actualizaciones)));
    $stmt = $conn->prepare("UPDATE $tabla SET $set_clause WHERE $columna_id = ?");
    $valores = array_merge(array_values($actualizaciones), [$id_valor]);
    $stmt->bind_param(str_repeat('s', count($valores)), ...$valores);
    $stmt->execute();
    $conn->close();
}

// Eliminar registros
function eliminar($tabla, $columna_id, $id_valor) {
    $conn = conectar_db();
    $stmt = $conn->prepare("DELETE FROM $tabla WHERE $columna_id = ?");
    $stmt->bind_param('s', $id_valor);
    $stmt->execute();
    $conn->close();
}

// Recuperar registros
function recuperar_clase($tabla, $columna_id, $id_valor) {
    $conn = conectar_db();
    $stmt = $conn->prepare("UPDATE $tabla SET est = 1 WHERE $columna_id = ?");
    $stmt->bind_param('s', $id_valor);
    $stmt->execute();
    $conn->close();
}

// Crear tablas al inicio
crear_tablas();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Base de Datos</title>
</head>
<body>
    <h1>Gestión de Base de Datos</h1>
    <form method="POST" action="">
        <label for="tabla">Tabla:</label>
        <input type="text" id="tabla" name="tabla" required><br><br>

        <label for="operacion">Operación:</label>
        <select id="operacion" name="operacion">
            <option value="insertar">Insertar</option>
            <option value="mostrar">Mostrar</option>
            <option value="actualizar">Actualizar</option>
            <option value="eliminar">Eliminar</option>
            <option value="recuperar">Recuperar</option>
        </select><br><br>

        <div id="campos">
            <label for="datos">Datos (separados por coma):</label>
            <input type="text" id="datos" name="datos"><br><br>
            
            <label for="id_col">Columna ID:</label>
            <input type="text" id="id_col" name="id_col"><br><br>

            <label for="id_valor">Valor ID:</label>
            <input type="text" id="id_valor" name="id_valor"><br><br>
        </div>

        <button type="submit">Ejecutar</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $tabla = $_POST['tabla'];
        $operacion = $_POST['operacion'];

        switch ($operacion) {
            case 'insertar':
                $datos = explode(',', $_POST['datos']);
                insertar($tabla, $datos);
                echo "Datos insertados correctamente.";
                break;

            case 'mostrar':
                $registros = mostrar_todos($tabla);
                echo "<h2>Registros de $tabla:</h2>";
                echo "<pre>" . print_r($registros, true) . "</pre>";
                break;

            case 'actualizar':
                $id_col = $_POST['id_col'];
                $id_valor = $_POST['id_valor'];
                $actualizaciones = [];
                parse_str($_POST['datos'], $actualizaciones);
                actualizar($tabla, $id_col, $id_valor, $actualizaciones);
                echo "Registro actualizado correctamente.";
                break;

            case 'eliminar':
                $id_col = $_POST['id_col'];
                $id_valor = $_POST['id_valor'];
                eliminar($tabla, $id_col, $id_valor);
                echo "Registro eliminado correctamente.";
                break;

            case 'recuperar':
                $id_col = $_POST['id_col'];
                $id_valor = $_POST['id_valor'];
                recuperar_clase($tabla, $id_col, $id_valor);
                echo "Registro recuperado correctamente.";
                break;

            default:
                echo "Operación no válida.";
        }
    }
    ?>
</body>
</html>
