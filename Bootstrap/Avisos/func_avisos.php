<?php

/* Fichero: func_avisos.php
   Autora: Elizabeth Muñoz
   Descripción: En este fichero se encuentran las funciones necesarias para visualizar los avisos en los tablones.
*/

require_once 'conexionBdAvisos.php';
require_once 'conexionBD.php';

// Da de baja los avisos con fecha de baja igual o inferior al día en curso.
function actualizarAvisos(){
	$hoy = strtotime(date("d-m-Y"));
	$consulta = "SELECT mensajeESP, fechaBaja,idAviso FROM aviso WHERE activo = 1" ;
	$rs = queryAviso($consulta);
	$nFilas = mysqli_num_rows($rs);
	if($nFilas){
		while($fila = mysqli_fetch_array($rs)){
			$fechaBaja = strtotime(date("d-m-Y", strtotime($fila["fechaBaja"])));
			$idAviso = $fila["idAviso"];
			if($fechaBaja < $hoy && $fila["fechaBaja"] != "0000-00-00"){
				$modificar = "UPDATE aviso SET activo = 0 WHERE idAviso=$idAviso";
				queryAviso($modificar);
			}
		}
	}
}

// Publica los avisos en castellano según las restricciones de cada asignatura.
function imprimirAvisosEsp($idAsignatura) {
	$consulta = "SELECT nombreAsignatura FROM asignatura WHERE idAsignatura = $idAsignatura";
	$rs = query_personalizada($consulta);
	$fila = mysqli_fetch_array($rs);
	$nombreAsignatura = $fila["nombreAsignatura"];
	$consulta = "SELECT count(av.idAviso) AS cantidad, a.activado, a.maxAvisos FROM asignatura a NATURAL JOIN aviso av WHERE a.nombre = '$nombreAsignatura'";
	$rs = queryAviso($consulta);
	$fila = mysqli_fetch_array($rs);
	$activado = $fila["activado"];
	$hoy = date("Y-m-d G:i:s");
	if($activado){
		$maxAvisos = $fila["maxAvisos"];
	}else{
		$maxAvisos = $fila["cantidad"];
	}

	echo '<thead class="encabezado_tabla">
					<tr>
						<th scope="col" id="fecha">Fecha</th>
						<th scope="col" id="aviso">Aviso</th>
					</tr>
				</thead>
				<tbody class="cuerpo_tabla">';

	$consulta = "SELECT av.* FROM aviso av NATURAL JOIN asignatura asig WHERE asig.nombre = '$nombreAsignatura' AND av.activo = 1 AND av.fechaPublicacion <= '$hoy' AND  av.mensajeESP != '' ORDER BY av.fechaPublicacion DESC, av.fechaCreacion DESC, av.fechaBaja DESC LIMIT $maxAvisos" ;
	$rs = queryAviso($consulta);

	while($fila = mysqli_fetch_array($rs)){
        $fila["fechaPublicacion"] = date("d-m-Y", strtotime($fila["fechaPublicacion"]));
		echo "<tr><td headers='fecha'>" . $fila["fechaPublicacion"] . "</td><td headers='aviso'>" . $fila["mensajeESP"] . "</td></tr>";
	}
	echo "</tbody>";
}

// Publica los avisos en inglés según las restricciones de cada asignatura.
function imprimirAvisosEng($idAsignatura) {

	$consulta = "SELECT nombreAsignatura FROM asignatura WHERE idAsignatura = $idAsignatura";
	$rs = query_personalizada($consulta);
	$fila = mysqli_fetch_array($rs);
	$nombreAsignatura = $fila["nombreAsignatura"];
	$consulta = "SELECT count(av.idAviso) AS cantidad, a.activado, a.maxAvisos FROM asignatura a NATURAL JOIN aviso av WHERE a.nombre = '$nombreAsignatura'";
	$rs = queryAviso($consulta);
	$fila = mysqli_fetch_array($rs);
	$activado = $fila["activado"];
	$hoy = date("Y-m-d G:i:s");
	if($activado){
		$maxAvisos = $fila["maxAvisos"];
	}else{
		$maxAvisos = $fila["cantidad"];
	}

	echo '<thead class="encabezado_tabla">
					<tr>
						<th scope="col" id="fecha">Date</th>
						<th scope="col" id="aviso">Message</th>
					</tr>
				</thead>
				<tbody class="cuerpo_tabla">';

	$consulta = "SELECT av.* FROM aviso av NATURAL JOIN asignatura asig WHERE asig.nombre = '$nombreAsignatura' AND av.activo = 1 AND av.fechaPublicacion <= '$hoy' AND  av.mensajeENG != ''  ORDER BY av.fechaPublicacion DESC, av.fechaCreacion DESC, av.fechaBaja DESC LIMIT $maxAvisos" ;
	$rs = queryAviso($consulta);

	while($fila = mysqli_fetch_array($rs)){
		$fila["fechaPublicacion"] = date("d-F-Y", strtotime($fila["fechaPublicacion"]));
		echo "<tr><td headers='fecha'>" . $fila["fechaPublicacion"] . "</td><td headers='aviso'>" . $fila["mensajeENG"] . "</td></tr>";
	}
	echo "</tbody>";
}
// Muestra la fecha del último aviso publicado si existe. En caso contrario muestra la fecha en curso.
function mostrarFechaUltimoAviso($idAsignatura){
	$publicados = array();
	$hoy = date("Y-m-d G:i:s");
	$consulta = "SELECT count(av.idAviso) AS cantidad, a.activado, a.maxAvisos FROM asignatura a NATURAL JOIN aviso av WHERE a.idAsignaturaPracticas = $idAsignatura";
	$rs = queryAviso($consulta);
	$fila = mysqli_fetch_array($rs);
	$activado = $fila["activado"];
	if($activado){
		$maxAvisos = $fila["maxAvisos"];
	}else{
		$maxAvisos = $fila["cantidad"];
	}
	$consulta = "SELECT av.* FROM aviso av NATURAL JOIN asignatura asig WHERE asig.idAsignaturaPracticas = $idAsignatura AND av.activo = 1 AND av.fechaPublicacion <= '$hoy' AND (av.mensajeESP != '' or av.mensajeENG != '') ORDER BY av.fechaPublicacion DESC, av.fechaCreacion DESC, av.fechaBaja DESC LIMIT $maxAvisos" ;
	$rs = queryAviso($consulta);
	$nFilas = mysqli_num_rows($rs);
	if($nFilas){
		while($fila = mysqli_fetch_array($rs)){
		array_push($publicados, $fila["idAviso"]);
		}
	}
	$consulta = "SELECT av.*, asig.nombre FROM aviso av NATURAL JOIN asignatura asig WHERE asig.idAsignatura = $idAsignatura ORDER BY av.fechaPublicacion DESC, av.fechaCreacion DESC, av.fechaBaja DESC" ;
	$rs = queryAviso($consulta);
	while($fila = mysqli_fetch_array($rs)){
		if($fila["activo"]){
			$fila["activo"] = "sí";
		}else{
			$fila["activo"] = "no";
		}
		if(in_array($fila["idAviso"], $publicados)){
			$publicado = "sí";
		}else{
			$publicado = "no";
		}
		if($fila["fechaBaja"] == '0000-00-00' ){
			$fila["fechaBaja"] = '';
		}else{
			$fila["fechaBaja"] = date("d-m-Y", strtotime($fila["fechaBaja"]));
		}
        $mes = transformarMesALetra((int)date("m", strtotime($fila["fechaPublicacion"])));
        $fechaPublicacion = date("d", strtotime($fila["fechaPublicacion"]));
        $fechaPublicacion = $fechaPublicacion."-".$mes."-";
		$fechaPublicacion = $fechaPublicacion.date("Y", strtotime($fila["fechaPublicacion"]));
		$fila["fechaCreacion"] = date("d-m-Y", strtotime($fila["fechaCreacion"]));
		if ($publicado == 'sí'){
			echo $fechaPublicacion;
			return 0;
		}
	}
	$mesActual = transformarMesALetra((int)date("m"));
    $fechaActual = date("d");
    $fechaActual = $fechaActual."-".$mes."-";
	$fechaActual = $fechaActual.date("Y");
	echo $fechaActual;
}

function transformarMesALetra($numMes){
    $meses=array("","enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
    return $meses[$numMes];
}
?>
