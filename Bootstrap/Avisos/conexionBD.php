<?php

/* Fichero: conexionBD.php
   Autora: Elizabeth Muñoz
   Descripci�n: En este fichero se encuentran las funciones necesarias para conectar con la B.D.
*/

if(!isset($_SESSION)) {
	session_start();
}
//Función que conecta a la BD da datos y devuelve la conexión en una variable
function conectarBd() {
	try{
		$servidor = "localhost";
		//$usuario = "jfuertes";
		//$contrasenna = "cpltlc6";
		$usuario = "root";
		$contrasenna = "";
		$nombreBD = "gestion_grupos";

		//Intenta conectarse a la BD
		$conexion = mysqli_connect($servidor, $usuario, $contrasenna);
		//Si no hay conexión a la BD nos indica el error
		if(!$conexion){
			throw new Exception("Error 25. Se ha producido un error al conectar con la B.D. Por favor, póngase en contacto con el Web Master.");
		}
		//Adaptado a php7
		if(!mysqli_select_db($conexion, $nombreBD)){
			throw new Exception("Error 26. Se ha producido un error al conectar con la B.D. Por favor, póngase en contacto con el Web Master.");
		}else{
			return $conexion;
		}
	}catch(Exception $e){
		$_SESSION["error"] =  $e->getMessage();
	}
}


// Función que realiza una query a la base de datos  GESTION GRUPOS. (Optimizada para php7)
// devuelve un mysqli_result
// solo se le pasa un query. Aquí dentro se hace la conexion a la base de datos
function query_personalizada($query){
	try{
	$conexion = conectarBd();
	$rs = mysqli_query($conexion, $query);
	if(!$rs){
		throw new Exception(mysqli_error($conexion));
	}else{
        mysqli_close($conexion);
		return $rs;
	}

	}catch(Exception $e){
		$_SESSION["error"] =  $e->getMessage();
	}
}


// Función que realiza una query a la base de datos. (Optimizada para php7)
// devuelve un mysqli_result
// La única diferencia con query_personalizada es que se le pasa como parametro el caso de error posible para tratarse
function query_personalizada2($query, $casoError){
    try{
		$conexion = conectarBd();
		$rs = mysqli_query($conexion, $query);
		if(!$rs){
			throw new Exception(mysqli_error($conexion));
			echo "la conexion ha fallado en 439895<br>";
		}
		switch ($casoError) {
			case '13':
				$cantidad = mysqli_affected_rows($conexion);
				if(!$cantidad){
					throw new Exception("Error 13. Se ha producido un error al crear el grupo. Por favor, póngase en contacto con el Web Master.");
				}
				return $rs;
				break;
			case '14':
				$cantidad = mysqli_affected_rows($conexion);
				if(!$cantidad){
					throw new Exception("Error 14. Se ha producido un error al asignar las practicas. Por favor, pongase en contacto con el Web Master.");
				}
				return $rs;
				break;
			case '60';
				$cantidad = mysqli_affected_rows($conexion);
				if($cantidad){
					$_SESSION["ok"] = "Se ha cambiado la contraseña correctamente.";
				}else{
					throw new Exception("Error 60. Se ha producido un error al cambiar la contraseña.");
				}
				return $rs;
				break;
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			case '74':
				$cantidad = mysqli_affected_rows($conexion);
				if (!$cantidad){
					throw new Exception("Error 74. Ha ocurrido un error al cambiar las prácticas.");
				}else{
					$_SESSION["ok"] = "Las opciones de prácticas han sido cambiadas correctamente.";
				}
				return $rs;
				break;
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			case '77';
				$cantidad = mysqli_affected_rows($conexion);
				$nombreOpcion= $_SESSION['nombreOpcion'];
				$idCategoria = $_SESSION['idCategoria'];
				$nombreCategoria = buscaCategoriaPorId($idCategoria);//WARNING 120818, Variable sin utilizar detectada
				if($cantidad){
					$_SESSION["ok"] = "La opción ". $nombreOpcion . " se ha guardado correctamente.";
				}else{
					throw new Exception("Error 77. Se ha producido un error al guardar opción " . $nombreOpcion . " en la B.D.");
				}
				return $rs;
				break;
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			case '78':
				$cantidad = mysqli_affected_rows($conexion);
				session_start();
				$nombreCategoria = $_SESSION['nombreCategoria'];
				if($cantidad){
					$_SESSION["ok"] = "Se ha creado la categoría " . $nombreCategoria. " correctamente.";
				}else{
					throw new Exception("Error 78. Se ha producido un error al crear la  categoría " . $nombreCategoria. " en la B.D.");
				}
				return $rs;
				break;

			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			case '83':
				$cantidad = mysqli_affected_rows($conexion);
				if($cantidad){
					$idAsignatura = mysqli_insert_id($conexion);
					//session_start();//resulta que la sesion ya esta creada en otro punto del código y ya se puede acceder a las variables globales desde fuera.
					$nombreAsignatura = $_SESSION['nombreAsignatura'];
					$insertar = "INSERT INTO asignatura(nombre, idAsignaturaPracticas) VALUES('$nombreAsignatura', $idAsignatura)";
					queryAviso($insertar);
					//traspaso de variable via session para simular el return comentado. se hace unset en func_asignaturas, desde donde se llama a query_personalizada2
					$idAsignaturaTablon = mysqli_insert_id($conexion);
					$_SESSION['idAsignaturaTablon']=$idAsignaturaTablon;

					$_SESSION["ok"] = "Se ha creado la asignatura correctamente.";
					//return $idAsignaturaTablon;

				}else{
					throw new Exception("Error 83. Se ha producido un error al crear la Asignatura en la base de datos.");
				}
				return $rs;
				break;
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			case '84':
				$cantidad = mysqli_affected_rows($conexion);
				if($cantidad){
					$_SESSION["ok"] = "Se han actualizado los datos del curso correctamente.";
				}else{
					throw new Exception("Error 84. Se ha producido un error al modificar los datos del curso.");
				}
				return $rs;
				break;
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			case '85';
				$cantidad = mysqli_affected_rows($conexion);
				session_start();
				$numGrupo= $_SESSION['numGrupo'];
				$idCategorias= $_SESSION['idCategorias'];
				unset($_SESSION['numGrupo']);
				unset($_SESSION['idCategorias']);
				if($cantidad){
					$idCurso = mysqli_insert_id($conexion);
					if($numGrupo != ""){
						reiniciarNumGrupo($idCurso);
					}
					$nCategorias = count($idCategorias);
					for($i=0;$i < $nCategorias; $i++){
						$idCategoria = $idCategorias[$i];
						$insertar = "INSERT INTO curso_has_categoria(idCategoria_cc,  idCurso_cc) VALUES($idCategoria, $idCurso)";
						query_personalizada($insertar);
					}
					$_SESSION["ok"] = "Se ha creado el curso correctamente.";
				}else{
					throw new Exception("Error 85. Se ha producido un error al crear el curso en la base de datos.");
				}
				return $rs;
				break;
			///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			default:
				throw new Exception("Se le debe llamar a query_personalizada2 con un casoError válido");
				break;
				return $rs;
		}
		mysqli_close($conexion);
	}catch(Exception $e){
		$_SESSION["error"] =  $e->getMessage();
	}
}


function comprobarPermisosAvisos($idAdministrador){
	$permisos = false;
	$consulta = "SELECT idAsignatura_aa FROM administrador_has_asignaturas WHERE idAdministrador_aa = $idAdministrador";
	$rs = query_personalizada($consulta);
	$numFilas = mysqli_num_rows($rs);
	if($numFilas){
		$permisos = true;
	}
	return $permisos;
}
?>
