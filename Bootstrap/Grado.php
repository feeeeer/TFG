<!DOCTYPE html>
<?php
session_start();
if (@$_GET["language"]) {
	switch ($_GET["language"]) {
		case 'es':
      $_SESSION["language"]=$_GET["language"];
		  break;
		case 'en':
			$_SESSION["language"]=$_GET["language"];
			break;
		default:
			$_SESSION["language"]="es";
			break;
	}
}
else if (!$_SESSION["language"]) {
  $_SESSION["language"]="es";
}
$idioma = $_SESSION["language"];
include("".$idioma.".php");
?>
<html lang="<?php echo $idioma;?>">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="author" content="Sergio Vega Adrián" />
    <link href = "css/Style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>DLSIIS - Docencia</title>
  </head>
  <body style="background-color: #FFFEF7;">
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top" style="background-color: #00355A;">
      <div class="mr-auto">
        <a class="navbar-brand" href="https://www.upm.es/" title="www.upm.es">
          <img src="Pictures/UPM.png" width="30" height="30" alt="LogoUPM">
        </a>
        <a class="navbar-brand" href="https://www.fi.upm.es/" title="www.fi.upm.es">
            <img src="Pictures/FI.png" width="30" height="30" alt="LogoFI">
        </a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Navbar links -->
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <div class="navbar-nav-scroll">
          <ul class="navbar-nav">
            <li class="nav-item" style="color:#B3BCC3;">
              <a class="nav-link" href="index.php"><abbr title="<?php echo $dlsiis; ?>">DLSIIS</abbr></a>
            </li>
            <li class="nav-item dropdown active">
              <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $docencia; ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="bd-versions1">
                <a class="dropdown-item" href="Grado.php"><?php echo $grado; ?></a>
                <a class="dropdown-item" href="Master.php"><?php echo $master; ?></a>
                <a class="dropdown-item" href="Doctorado.php"><?php echo $doctorado; ?></a>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" style="color:#B3BCC3;" id="bd-versions2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $profesorado; ?>
              </a>
              <div class="dropdown-menu" style="min-width: 180px;" aria-labelledby="bd-versions2">
                <a class="dropdown-item-text"><?php echo $buscar; ?></a>
                <a class="dropdown-item" href="Buscarpornombre.php">- <?php echo $pornombre; ?></a>
                <a class="dropdown-item" href="Buscarporasignatura.php">- <?php echo $porasig; ?></a>
                <a class="dropdown-item" href="Todoslosprofesores.php">- <?php echo $mostrartodos; ?></a>
                <!--div class="dropdown-divider"></div>
                <a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Tutorías generales</a-->
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" style="color:#B3BCC3;" id="bd-versions3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $investigacion; ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="bd-versions3">
                <a class="dropdown-item" href="Grupos.php"><?php echo $grupos; ?></a>
                <!--a class="dropdown-item" href="Lineas.php"><?php echo $lineas; ?></a-->
              </div>
            </li>
          </ul>
        </div>
        <ul class="navbar-nav ml-md-auto">
          <li><div class="mr-auto" style="display: inline-flex; padding-top: 6px;">
						<!--a href="#" style="color:#FFFEF7; font-size: 12px; text-decoration-line: underline;"><?php echo $inicio_sesion; ?></a>
						<br-->
             <?php echo $bandera; ?>
          </div></li>
        </ul>
      </div>
    </nav>
    <br>
    <br>
    <nav aria-label="breadcrumb">
      <ol class="migas_de_pan breadcrumb" style="background-color: #FFFEF7;">
        <li style="padding-right: 4px;"><?php echo $usted; ?></li>
        <li class="breadcrumb-item active" aria-current="page"><abbr title="<?php echo $dlsiis; ?>">DLSIIS</abbr></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $grado; ?></li>
      </ol>
    </nav>
    <div class="container-fluid">
      <h1 class="titulo1" style="margin-left:32px;"><?php echo $grado; ?>s</h1>
      <?php
      require_once ('loginBD.php');
      // Cargamos los titulos de Grado ordenados alfabeticamente
      $sql_titulos = "SELECT * FROM titulaciones where codigo_subtipo='GRA' ORDER BY `titulaciones`.`nombre` ASC";
      // Comprobamos la carga
      if (mysqli_query($conn, $sql_titulos)) {
        $result_titulos = mysqli_query($conn, $sql_titulos);
      }
      else {
        echo "Error: ".$sql_titulos ."<br>".mysqli_error($conn);
      }
      $sql_titulo_espanol = "SELECT * FROM titulo_espanol_ingles";
      if (mysqli_query($conn, $sql_titulo_espanol)) {
        $result_titulo_espanol = mysqli_query($conn, $sql_titulo_espanol);
      }
      else {
        echo "Error: ".$sql_titulo_espanol ."<br>".mysqli_error($conn);
      }
      $sql_asignaturas = "SELECT * FROM asignaturas ORDER BY `asignaturas`.`nombre_asignatura` ASC";
      // Comprobamos la carga
      if (mysqli_query($conn, $sql_asignaturas)) {
        $result_asignaturas = mysqli_query($conn, $sql_asignaturas);
      }
      else {
        echo "Error: " . $sql_asignaturas . "<br>" . mysqli_error($conn);
      }
      // Definimos variable para crear las listas
      $list = 0;
      // Definimos variable para guardar el codigo de cada titulacion
      $arrayCodigo = array();
      $arrayUrl = array();
      $arrayNombre = array();
      echo '<ul class="lista_titulos">';
      // Recorremos por filas la consulta a la BBDD y pintamos
      while ($row_titulos =mysqli_fetch_array($result_titulos)) {
        echo '<li>';
        // Colocamos el puntero en la posicion 0
        mysqli_data_seek($result_titulo_espanol, 0);
        // Recorremos por filas filtrando por codigo y guardamos el url del titulo
        while ($row_titulo_espanol =mysqli_fetch_array($result_titulo_espanol)) {
          if ($row_titulos['codigo_titulo'] == $row_titulo_espanol['codigo_titulo']){
						if ($idioma == "en") {
							$arrayUrl[$list] = $row_titulo_espanol['url_ingles'];
							$arrayNombre[$list] = utf8_encode($row_titulo_espanol['nombre_ingles']);
						}
						else {
							$arrayUrl[$list] = $row_titulo_espanol['url_espanol'];
							$arrayNombre[$list] = utf8_encode($row_titulo_espanol['nombre_espanol']);
						}
          }
        }
        echo '<div class="col-12" style="width:100%;" role="tablist">
                <a class="list-group-item list-group-item-action" id="list-'.$list.'-list"
                data-toggle="collapse" href="#list-'.$list.'" role="button">
                '.$arrayNombre[$list].'
                </a>
              </div>';
        $arrayCodigo[] = $row_titulos['codigo_titulo'];
        echo '<div class="col-12 collapse" style="padding-left:30px;" id="list-'.$list.'" role="tabpanel" aria-labelledby="list-'.$list.'-list">';
        echo '<a>'.$pagina_oficial.'</a><a href="'.$arrayUrl[$list].'">'.$arrayNombre[$list].'</a><br>';
        echo '<a>'.$las_asig.'</a><br>';
        // Colocamos el puntero en la posicion 0
        mysqli_data_seek($result_asignaturas, 0);
        // Recorremos por filas la consulta a la BBDD
        echo '<ul class="lista_sin_estilo">';
        while ($row_asignaturas =mysqli_fetch_array($result_asignaturas)) {
          // Si ambos codigos coinciden, pintamos
          if($arrayCodigo[$list] == $row_asignaturas["codigo_titulacion"] && $row_asignaturas["nombre_tipo_asignatura"] != "-"){
						if ($idioma == "es") {$nomb_asig = $row_asignaturas["nombre_asignatura"];}
						else {$nomb_asig = $row_asignaturas["nombre_asignatura_ingles"];}
            echo '<li class="linea_asignatura">
                    <a href="Asignatura.php?codigo_tit_asig='.$row_asignaturas["id"].'&id_tit='.$row_asignaturas["codigo_titulacion"].'&tipo_tit=Grado">'.$nomb_asig.'</a><br>
                  </li>';
          }
        }
        echo '</ul>';
        $list++;
        echo '</div>';
      }
      echo '</ul>';
      mysqli_free_result($result_asignaturas);
      mysqli_free_result($result_titulo_espanol);
      mysqli_free_result($result_titulos);
      //Cerramos la conexion con la BBDD
      mysqli_close($conn);
      ?>
    </div>
    <br><br>
    <?php include ("footer.php"); ?>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
 </html>
