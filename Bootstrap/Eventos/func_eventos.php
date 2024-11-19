<?php

/* Fichero: func_avisos.php
   Autora: Elizabeth Muñoz
   Descripción: En este fichero se encuentran las funciones necesarias para visualizar los avisos en los tablones.
*/

require_once 'conexionBdEventos.php';
require_once 'conexionBD.php';

// Da de baja los eventos con fecha de baja igual o inferior al día en curso.
function actualizarEventos(){
    $hoy = strtotime(date("d-m-Y"));
    $consulta = "SELECT nombreEvento, fechaBaja, idEvento FROM evento WHERE activo = 1";
    $rs = queryEvento($consulta);
    $nFilas = mysqli_num_rows($rs);
    if($nFilas){
        while($fila = mysqli_fetch_array($rs)){
            $fechaBaja = strtotime(date("d-m-Y", strtotime($fila["fechaBaja"])));
            $idEvento = $fila["idEvento"];
            if($fechaBaja < $hoy && $fila["fechaBaja"] != "0000-00-00"){
                $modificar = "UPDATE evento SET activo = 0 WHERE idEvento=$idEvento";
                queryEvento($modificar);
            }
        }
    }
}

// Publica los eventos en español según las restricciones de cada asignatura.
function imprimirEventosEsp($idAsignatura) {
    $consulta = "SELECT nombreAsignatura FROM asignatura WHERE idAsignatura = $idAsignatura";
    $rs = query_personalizada($consulta);
    $fila = mysqli_fetch_array($rs);
    $nombreAsignatura = $fila["nombreAsignatura"];
    $consulta = "SELECT count(ev.idEvento) AS cantidad, a.activado, a.maxEventos FROM asignatura a NATURAL JOIN evento ev WHERE a.nombre = '$nombreAsignatura'";
    $rs = queryEvento($consulta);
    $fila = mysqli_fetch_array($rs);
    $activado = $fila["activado"];
    $hoy = date("Y-m-d G:i:s");
    if($activado){
        $maxEventos = $fila["maxEventos"];
        // Continuar aquí con el código de la función imprimirEventos en español
    }
}

// Publica los eventos en inglés según las restricciones de cada asignatura.
function imprimirEventosEng($idAsignatura) {
    $consulta = "SELECT nombreAsignatura FROM asignatura WHERE idAsignatura = $idAsignatura";
    $rs = query_personalizada($consulta);
    $fila = mysqli_fetch_array($rs);
    $nombreAsignatura = $fila["nombreAsignatura"];
    $consulta = "SELECT count(ev.idEvento) AS cantidad, a.activado, a.maxEventos FROM asignatura a NATURAL JOIN evento ev WHERE a.nombre = '$nombreAsignatura'";
    $rs = queryEvento($consulta);
    $fila = mysqli_fetch_array($rs);
    $activado = $fila["activado"];
    $hoy = date("Y-m-d G:i:s");
    if($activado){
        $maxEventos = $fila["maxEventos"];
        // Continuar aquí con el código de la función imprimirEventos en inglés
    }
}
?>