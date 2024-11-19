<?php

/* Fichero: conexionBDAvisos.php
   Autora: Elizabeth Mu�oz
   Descripci�n: En este fichero se encuentran las funciones necesarias para conectar con la B.D. de avisos.
*/

//Funci�n que conecta a la BD da datos de eventos y devuelve la conexi�n en una variable.
function conectarBdEventos() {
	$servidor = "localhost";
	//$usuario = "jfuertes";
	//$contrasenna = "cpltlc6";
	$usuario = "root";
	$contrasenna = "";
	$nombreBD = "eventos";

	$conexion = mysqli_connect($servidor, $usuario, $contrasenna);
	if(!$conexion){
		$_SESSION['error']="Error 203. Se ha producido un error al conectar con la B.D. Por favor, p�ngase en contacto con el Web Master.";
	}
	if(!mysqli_select_db($conexion, $nombreBD)){
		$_SESSION['error']="Error 203. Se ha producido un error al conectar con la B.D. Por favor, p�ngase en contacto con el Web Master.";
	}
	return $conexion;
}

// Realiza una query a la base de datos de eventos.
function queryEvento($query){
	$conexion = conectarBdEventos();
	$rs = mysqli_query($conexion, $query);
	if(!$rs){
		throw new Exception(mysqli_error($conexion));
	}else{
		return $rs;
	}
	mysqli_close($conexion);
}

?>