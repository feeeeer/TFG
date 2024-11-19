<?php
    $host = 'localhost';
    $dbname = 'dlsiis';
    $username = 'root';
    $password = '';

// Intento de conexión
    $conn = new mysqli($host, $username, $password, $dbname);

// Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    } else {
        echo "Conexión exitosa!";
    }
?>
