<?php
// Definimos las credenciales de conexion
$servername = "localhost";
$database = "dlsiis";
$username = "root";
$password = "";
// Creamos la conexion con la BBDD
$conn = new mysqli($servername, $username, $password, $database);
// Comprobamos las conexion
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
?>
