<?php
require_once ('loginBD.php');

echo "Connected successfully";

//Comprobacion de la fecha de la consulta.
$fecha_anio = date("y");
$fecha_mes = date("m");
$fecha_dia = date("d");
$fecha_tope_mes = "07";
$fecha_tope_dia = "15";

$anio = "20";
if ($fecha_mes >= $fecha_tope_mes) {
  if ($fecha_dia >= $fecha_tope_dia){
    $anio = $anio.$fecha_anio.++$fecha_anio;
  }
  else {
    $anio = $anio.--$fecha_anio.++$fecha_anio;
  }
}
else {
  $anio = $anio.--$fecha_anio.++$fecha_anio;
}
//Conexion a la API-UPM a los JSON de las titulaciones del DLSIIS.
$ch_titulaciones = curl_init();
curl_setopt($ch_titulaciones, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($ch_titulaciones, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch_titulaciones, CURLOPT_URL,
'https://www.upm.es/wapi_upm/academico/comun/index.upm/v2/departamento.json/D470/planes?anio='.$anio);
$result_titulaciones = curl_exec($ch_titulaciones);
curl_close($ch_titulaciones);
$objeto_titulo = json_decode($result_titulaciones);

//Consultas a BD para eliminar las relaciones, vaciar las tablas y volver a crear las relaciones.
$sql_drop = "ALTER TABLE asignaturas DROP FOREIGN KEY FOREIGN_KEY";
if (mysqli_query($conn, $sql_drop)) {
      $sql_drop = mysqli_query($conn, $sql_drop);
} else {
      echo "Error: " . $sql_drop . mysqli_error($conn);
}
$sql_drop_ap = "ALTER TABLE asignatura_profesor DROP FOREIGN KEY FOREIGN_KEY_A";
if (mysqli_query($conn, $sql_drop_ap)) {
      $sql_drop_ap = mysqli_query($conn, $sql_drop_ap);
} else {
      echo "Error: " . $sql_drop_ap . mysqli_error($conn);
}
$sql_drop_ap2 = "ALTER TABLE asignatura_profesor DROP FOREIGN KEY FOREIGN_KEY_P";
if (mysqli_query($conn, $sql_drop_ap2)) {
      $sql_drop_ap2 = mysqli_query($conn, $sql_drop_ap2);
} else {
      echo "Error: " . $sql_drop_ap2 . mysqli_error($conn);
}
$sql_truncate_t = "TRUNCATE TABLE titulaciones";
if (mysqli_query($conn, $sql_truncate_t)) {
      $sql_truncate_t = mysqli_query($conn, $sql_truncate_t);
} else {
      echo "Error: " . $sql_truncate_t . mysqli_error($conn);
}
$sql_truncate_a = "TRUNCATE TABLE asignaturas";
if (mysqli_query($conn, $sql_truncate_a)) {
      $sql_truncate_a = mysqli_query($conn, $sql_truncate_a);
} else {
      echo "Error: " . $sql_truncate_a . mysqli_error($conn);
}
$sql_truncate_ap = "TRUNCATE TABLE asignatura_profesor";
if (mysqli_query($conn, $sql_truncate_ap)) {
      $sql_truncate_ap = mysqli_query($conn, $sql_truncate_ap);
} else {
      echo "Error: " . $sql_truncate_ap . mysqli_error($conn);
}
$sql_alter = "ALTER TABLE asignaturas ADD  CONSTRAINT `FOREIGN_KEY` FOREIGN KEY (`codigo_titulacion`) REFERENCES titulaciones (`codigo_titulo`) ON DELETE CASCADE ON UPDATE CASCADE";
if (mysqli_query($conn, $sql_alter)) {
      $sql_alter = mysqli_query($conn, $sql_alter);
} else {
      echo "Error: " . $sql_alter . mysqli_error($conn);
}
$sql_alter_ap = "ALTER TABLE asignatura_profesor ADD  CONSTRAINT `FOREIGN_KEY_A` FOREIGN KEY (`codigo_asignatura`) REFERENCES asignaturas (`id`) ON DELETE CASCADE ON UPDATE CASCADE";
if (mysqli_query($conn, $sql_alter_ap)) {
      $sql_alter_ap = mysqli_query($conn, $sql_alter_ap);
} else {
      echo "Error: " . $sql_alter_ap . mysqli_error($conn);
}

//Recorrer el JSON con las titulaciones, accediendo a cada una de ellas.
for($i=0;$i<count($objeto_titulo);$i++){
  $nombre = addslashes($objeto_titulo[$i]->nombre);
  $codigo_titulo = $objeto_titulo[$i]->codigo;
  $codigo_subtipo = $objeto_titulo[$i]->codigo_subtipo;

  //Se guarda en BD la consulta a la API-UPM de las asignaturas de la titulacion.
  $url_asignaturas = 'https://www.upm.es/wapi_upm/academico/comun/index.upm/v2/departamento.json/D470/'.$codigo_titulo.'/asignaturas?anio='.$anio;

  //Se introduce la titulacion en la BD.
  $sql_insert_titulo = "INSERT INTO titulaciones (nombre, codigo_titulo, codigo_subtipo, url_asignaturas)
  VALUES ('$nombre', '$codigo_titulo', '$codigo_subtipo', '$url_asignaturas')";
  if (!mysqli_query($conn, $sql_insert_titulo)){
    echo "Error: " . $sql_insert_titulo . mysqli_error($conn);
  }
  //Se accede a las asignaturas de la titulacion.
  $ch_asignatura = curl_init();
  curl_setopt($ch_asignatura, CURLOPT_SSL_VERIFYPEER, true);
  curl_setopt($ch_asignatura, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch_asignatura, CURLOPT_URL, $url_asignaturas);
  $url_asignatura = curl_exec($ch_asignatura);
  curl_close($ch_asignatura);
  $objeto_asignatura = json_decode($url_asignatura, true);
  //Se va accediendo a cada asignatura para guardarla en BD.
  foreach ($objeto_asignatura as $obj){
    if($obj["ofertada"] == "S" && $obj["curso"] != ""){
      $codigo_asignatura = $obj["codigo"];
      $id = $codigo_titulo . $codigo_asignatura;
      $nombre_tipo_asignatura = ucfirst(mb_strtolower($obj["nombre_tipo_asignatura"]));
      $nombre_asignatura = $obj["nombre"];
      $nombre_asignatura_ingles = $obj["nombre_ingles"];
      $curso = $obj["curso"];
      $creditos = $obj["credects"];
      $creditos = str_replace(",", ".", $creditos);
      $ects = floatval($creditos);
      $obj_semestre = $obj["imparticion"];
      $semestre = "";
      $guia_aprendizaje = "";
      $contador_obj = 0;
      //Se comprueba si la asignatura es multidepartamental.
      if (count($obj["departamentos"]) > 1) {
        $otro_departamento = '1';
      }
      else {
        $otro_departamento = '0';
      }
      foreach ($obj_semestre as $obj_s) {
        if ($contador_obj == 0){
          $semestre = $semestre.$obj_s["nombre_duracion"];
          $contador_obj++;
        }
        else {
          $semestre = $semestre.", ".$obj_s["nombre_duracion"];
        }
      }
      $obj_idiomas = $obj["idiomas"];
      $idiomas = "";
      $contador_obj = 0;
      foreach ($obj_idiomas as $obj_i) {
        if ($contador_obj == 0){
          $idioma = "";
          for($l=0;$l<strlen($obj_i);$l++){
            $idioma = $idioma.$obj_i[$l];
          }
          if ($idioma == "InglÃ©s") {
            $idioma = "Inglés";
          }
          $idiomas = $idiomas.$idioma;
          $contador_obj++;
        }
        else {
          $idioma = "";
          for($l=0;$l<strlen($obj_i);$l++){
            $idioma = $idioma.$obj_i[$l];
          }
          if ($idioma == "InglÃ©s") {
            $idioma = "Inglés";
          }
          $idiomas = $idiomas.", ".$idioma;
        }
      }
      if ($obj_s["guia_json"]){
        $guia_json = $obj_s["guia_json"];
      }
      $guia_aprendizaje = $guia_aprendizaje.$obj_s["guia_pdf"]." ";
      //Se guarda la asignatura en la BD.
      $sql_insert_asignatura = "INSERT INTO asignaturas (id, codigo_titulacion, codigo_asignatura,nombre_tipo_asignatura,
        nombre_asignatura, nombre_asignatura_ingles, curso, ects, semestre, idiomas, guia_aprendizaje, guia_aprendizaje_json)
      VALUES ('$id', '$codigo_titulo', '$codigo_asignatura', '$nombre_tipo_asignatura', '$nombre_asignatura',
        '$nombre_asignatura_ingles', '$curso', '$ects', '$semestre', '$idiomas', '$guia_aprendizaje', '$guia_json')";
      if (mysqli_query($conn, $sql_insert_asignatura))
      else {
        echo "Error: " . $sql_insert_asignatura . mysqli_error($conn);
      }
      //Si se tiene la guia en JSON, se accede a ella para obtener los profesores.
      if (!empty($guia_json)) {
        $ch_profesores = curl_init();
        curl_setopt($ch_profesores, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch_profesores, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch_profesores, CURLOPT_URL, $guia_json);
        $url_profesores = curl_exec($ch_profesores);
        curl_close($ch_profesores);
        $objeto_profesor = json_decode($url_profesores, true);
        $id_profesor = array();
        $es_coordinador = array();
        if ($objeto_profesor){
          //Si hay profesores, se va accediendo a cada uno de ellos.
          foreach ($objeto_profesor["profesores"] as $profesor){
            if ($profesor["nombre"]){
              $nombre_p = str_replace("?", "ñ", $profesor["nombre"]);
            }
            if ($profesor["apellidos"]){
              $apellidos_p = str_replace("?", "ñ", $profesor["apellidos"]);
            }
            if ($profesor["despacho"]){
              $despacho = $profesor["despacho"];
            }
            if ($profesor["email"]){
              $correo_upm = $profesor["email"];
            }
            $correo_fi = "un correo";
            $telefono = "un telefono";
            if ($profesor["coordinador"]) {
              $es_coordinador = '1';
            }
            else {
              $es_coordinador = '0';
            }
            //Se guarda el profesor en BD.
            $sql_asig_prof = "INSERT INTO asignatura_profesor (codigo_asignatura, id_profesor, coordinador, otro_departamento)
            VALUES ('$id', '$correo_upm', '$es_coordinador', '$otro_departamento')";
            if (mysqli_query($conn, $sql_asig_prof))
            else {
              echo "Error: " . $sql_asig_prof . mysqli_error($conn);
            }
            if (!empty($correo_upm)) {
              $sql_profesor_up = ("UPDATE profesores SET despacho = '$despacho', correo_fi = '$correo_fi', telefono = '$telefono' WHERE correo_upm = '$correo_upm' ");
              if (mysqli_query($conn, $sql_profesor_up))
              else {
                echo "Error: " . $sql_profesor_up . mysqli_error($conn);
              }
            }
          }
        }
      }
    }
  }
}
//Se eliminan de la BD los profesores sin id.
$sql_delete_ap = "DELETE FROM asignatura_profesor WHERE id_profesor = ''";
if (mysqli_query($conn, $sql_delete_ap)) {
  $result_delete_ap = mysqli_query($conn, $sql_delete_ap);
}
else {
  echo "Error: " . $sql_delete_ap . mysqli_error($conn);
}
//Se crea la relacion entre profesor y asignatura_profesor.
$sql_alter_ap2 = "ALTER TABLE asignatura_profesor ADD  CONSTRAINT `FOREIGN_KEY_P` FOREIGN KEY (`id_profesor`) REFERENCES profesores (`correo_upm`) ON DELETE CASCADE ON UPDATE CASCADE";
if (mysqli_query($conn, $sql_alter_ap2)) {
      $sql_alter_ap2 = mysqli_query($conn, $sql_alter_ap2);
} else {
      echo "Error: " . $sql_alter_ap2 .  mysqli_error($conn);
}
$sql_asignaturas = "SELECT * FROM asignaturas WHERE curso != '-'";
// Comprobamos la carga
if (mysqli_query($conn, $sql_asignaturas)) {
  $result_asignaturas = mysqli_query($conn, $sql_asignaturas);
}
else {
  echo "Error: " . $sql_asignaturas . mysqli_error($conn);
}
//Se filtra para eliminar las titulaciones sin asignaturas.
while ($row_asignatura = mysqli_fetch_array($result_asignaturas)) {
  $codigo_tit = $row_asignatura["codigo_titulacion"];
  $sql_update = "UPDATE titulaciones SET tiene_asignaturas = '1' WHERE codigo_titulo = '$codigo_tit'";
  if (mysqli_query($conn, $sql_update)) {
    $result_update = mysqli_query($conn, $sql_update);
  }
  else {
    echo "Error: " . $sql_update .  mysqli_error($conn);
  }
}
//Se eliminan dichas titulaciones.
$sql_delete = "DELETE FROM titulaciones WHERE tiene_asignaturas = '0' && codigo_subtipo != 'DOF'";
if (mysqli_query($conn, $sql_delete)) {
  $result_delete = mysqli_query($conn, $sql_delete);
}
else {
  echo "Error: " . $sql_delete .  mysqli_error($conn);
}
//Se eliminan asignaturas de titulaciones antiguas.
$sql_delete_asig = "DELETE FROM asignaturas WHERE codigo_titulacion = '10E2' OR codigo_titulacion = '09E7'";
if (mysqli_query($conn, $sql_delete_asig)) {
  $result_delete_asig = mysqli_query($conn, $sql_delete_asig);
}
else {
  echo "Error: " . $sql_delete_asig .  mysqli_error($conn);
}
//Se filtran las aignaturas multidepartamentales.
$sql_departamento = "SELECT id_profesor, otro_departamento FROM asignatura_profesor WHERE otro_departamento = '1'";
if (mysqli_query($conn, $sql_departamento)) {
  $result_departamento = mysqli_query($conn, $sql_departamento);
}
else {
  echo "Error: " . $sql_departamento .  mysqli_error($conn);
}
//Se filtra para encontrar los profesores que no son del DLSIIS.
while ($row_departamento = mysqli_fetch_array($result_departamento)) {
  $sql_dep = "SELECT id_profesor, otro_departamento FROM asignatura_profesor WHERE otro_departamento = '0'";
  if (mysqli_query($conn, $sql_dep)) {
    $result_dep = mysqli_query($conn, $sql_dep);
  }
  else {
    echo "Error: " . $sql_dep .  mysqli_error($conn);
  }
  $id = $row_departamento["id_profesor"];
  mysqli_data_seek($result_dep, 0);
  while ($row_dep = mysqli_fetch_array($result_dep)) {
    if ($id == $row_dep["id_profesor"]) {
      $sql_update_ap = "UPDATE asignatura_profesor SET otro_departamento = '0' WHERE id_profesor = '$id'";
      if (mysqli_query($conn, $sql_update_ap)) {
        $result_update_ap = mysqli_query($conn, $sql_update_ap);
      }
      else {
        echo "Error: " . $sql_update_ap . mysqli_error($conn);
      }
    }
  }
}
$sql_sel_ap = "SELECT id_profesor, otro_departamento FROM asignatura_profesor";
if (mysqli_query($conn, $sql_sel_ap)) {
  $result_sel_ap = mysqli_query($conn, $sql_sel_ap);
}
else {
  echo "Error: " . $sql_sel_ap .  mysqli_error($conn);
}
while ($row_sel_ap = mysqli_fetch_array($result_sel_ap)) {
  $id = $row_sel_ap["id_profesor"];
  $otro_dep = $row_sel_ap["otro_departamento"];
  $sql_sel_p = "SELECT correo_upm, otro_departamento FROM profesores WHERE correo_upm = '$id' AND otro_departamento = '1'";
  if (mysqli_query($conn, $sql_sel_p)) {
    $result_sel_p = mysqli_query($conn, $sql_sel_p);
  }
  else {
    echo "Error: " . $sql_sel_p . mysqli_error($conn);
  }
  while ($row_sel_p = mysqli_fetch_array($result_sel_p)) {
    $sql_update_p = "UPDATE profesores SET otro_departamento = '$otro_dep' WHERE correo_upm = '$id'";
    if (mysqli_query($conn, $sql_update_p)) {
      $result_update_p = mysqli_query($conn, $sql_update_p);
      mysqli_data_seek($result_update_p, 0);
    }
    else {
      echo "Error: " . $sql_update_p .  mysqli_error($conn);
    }
  }
}

echo "Actualización de BBDD terminada.";

mysqli_close($conn);
?>
