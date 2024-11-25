<?php

echo "¡Hola, el archivo test.php está funcionando!";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (file_exists("config/conexion.php")) {
    echo "El archivo conexion.php existe.";
} else {
    echo "El archivo conexion.php NO existe.";
}
?>

