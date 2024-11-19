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
$url_actual = $_SERVER["REQUEST_URI"];
include("".$idioma.".php");?>
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
						 <?php
            	echo $bandera; ?>
          </div></li>
        </ul>
      </div>
    </nav>
    <br>
    <br>
    <?php
		//Funcion para quitar los acentos y que Máster sea Master para poder poner un enlace a Master.php.
			function quitar_tildes($cadena) {
				$no_permitidas= array ("á","é","í","ó","ú","Á","É","Í","Ó","Ú","ñ","À","Ã","Ì","Ò","Ù","Ã™","Ã ","Ã¨","Ã¬","Ã²",
				"Ã¹","ç","Ç","Ã¢","ê","Ã®","Ã´","Ã»","Ã‚","ÃŠ","ÃŽ","Ã”","Ã›","ü","Ã¶","Ã–","Ã¯","Ã¤","«","Ò","Ã","Ã„","Ã‹");
				$permitidas= array ("a","e","i","o","u","A","E","I","O","U","n","N","A","E","I","O","U","a","e","i","o","u","c",
				"C","a","e","i","o","u","A","E","I","O","U","u","o","O","i","a","e","U","I","A","E");
				$texto = str_replace($no_permitidas, $permitidas ,$cadena);
				return $texto;
				}
      $url = "";
      if (!empty($_GET["tipo_tit"])) {
        $tipo_titulacion = $_GET["tipo_tit"];
        $url = quitar_tildes($tipo_titulacion);
      }
      if ($tipo_titulacion != "Grado" and $tipo_titulacion != "Máster") {
        $url = "";
			}
			else{
				if ($tipo_titulacion == 'Grado' && $idioma == 'en'){
					$tipo_titulacion = 'Grade';
				}
				else if ($tipo_titulacion == 'Máster' && $idioma == 'en'){
					$tipo_titulacion = 'Master';
				}
      }
      $id_actual = $_GET["codigo_tit_asig"];
      $codigo_actual = $_GET["id_tit"];
      require_once ('loginBD.php');
      $sql_asignatura = $conn->prepare("SELECT * FROM asignaturas where id = ? ");
      $sql_asignatura->bind_param('s', $id_actual);
      $sql_asignatura->execute();
      $result_asignatura = $sql_asignatura->get_result();

      while ($row_asignatura =mysqli_fetch_array($result_asignatura)) {
				if ($idioma == 'en'){$nombre_asig = $row_asignatura["nombre_asignatura_ingles"];}
				else{$nombre_asig = $row_asignatura["nombre_asignatura"];}
      }
    ?>
    <nav aria-label="breadcrumb">
      <ol class="migas_de_pan breadcrumb" style="background-color: #FFFEF7;">
        <li style="padding-right: 4px;"><?php echo $usted; ?></li>
        <li class="breadcrumb-item active" aria-current="page"><abbr title="<?php echo $dlsiis; ?>">DLSIIS</abbr></li>
        <?php
          if (!empty($url)) {
            echo '<li class="breadcrumb-item"><a href="'.$url.'.php">'.$tipo_titulacion.'</a></li>';
          }
        ?>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $nombre_asig;?></li>
      </ol>
    </nav>
    <div class="row container" style="max-width: none;padding-left: 25px;padding-right: 25px;margin-left: auto;margin-right: auto;">
      <?php
        $sql_tit = $conn->prepare("SELECT * FROM titulo_espanol_ingles where codigo_titulo = ? ");
        $sql_tit->bind_param('s', $codigo_actual);
        $sql_tit->execute();
        $result_tit = $sql_tit->get_result();

        while ($row_tit =mysqli_fetch_array($result_tit)) {
					if ($idioma == 'en') {
						$nombre_tit = utf8_encode($row_tit["nombre_ingles"]);
					}
					else {
						$nombre_tit = utf8_encode($row_tit["nombre_espanol"]);
					}
        }

        mysqli_data_seek($result_asignatura, 0);
        while ($row_asignatura = mysqli_fetch_array($result_asignatura)) {
					if ($idioma == 'en') {
						if ($row_asignatura["nombre_tipo_asignatura"] == "Básica"){$tipo_asignatura = "Basic";}
						else if ($row_asignatura["nombre_tipo_asignatura"] == "Obligatoria"){$tipo_asignatura = "Mandatory";}
						else if ($row_asignatura["nombre_tipo_asignatura"] == "Optativa"){$tipo_asignatura = "Optional";}
						else if ($row_asignatura["nombre_tipo_asignatura"] == "Proyecto fin de master"){$tipo_asignatura = "Master Thesis project";}
						else if ($row_asignatura["nombre_tipo_asignatura"] == "Prácticas externas"){$tipo_asignatura = "External internships";}
						else {$tipo_asignatura ="Training credits";}
						if ($row_asignatura["semestre"] == "Anual"){$curso_semestre = "Yearly";}
						else if ($row_asignatura["semestre"] == "Anual, Segundo Semestre"){$curso_semestre = "Yearly, Second Semester";}
						else if ($row_asignatura["semestre"] == "Indefinida dentro del curso académico"){$curso_semestre = "Indefinite within the academic year";}
						else if ($row_asignatura["semestre"] == "Primer Semestre"){$curso_semestre = "First Semester";}
						else if ($row_asignatura["semestre"] == "Primer Semestre, Segundo Semestre"){$curso_semestre = "First Semester, Second Semester";}
						else if ($row_asignatura["semestre"] == "Segundo Semestre"){$curso_semestre = "Second Semester";}
						else {$curso_semestre = "";}
						if ($row_asignatura["idiomas"] == "Castellano, Inglés"){$idioma_asig = "Spanish, English";}
						else if ($row_asignatura["idiomas"] == "Inglés"){$idioma_asig = "English";}
						else {$idioma_asig = "Spanish";}
          	echo '<h1 class="titulo1" style="margin-left:23px;">'.$row_asignatura["nombre_asignatura_ingles"].'</h1>';
          	echo '<dl class="lista_definicion">';
          	echo '<dt class="atributo">Title:</dt><dd class="atributo_2">'.$nombre_tit.'</dd>';
          	echo '<dt class="atributo">Type of subject:</dt><dd class="atributo_2">'.$tipo_asignatura.'</dd>';
          	$creditos = str_replace(".0", "", $row_asignatura["ects"]);
          	echo '<dt class="atributo">Number of credits:</dt><dd class="atributo_2">'.$creditos.' <abbr title="European Credit Transfer System">ECTS</abbr></dd>';
          	echo '<dt class="atributo">Teaching year:</dt><dd class="atributo_2">Year '.$row_asignatura["curso"].' ('.$curso_semestre.')</dd>';
          	echo '<dt class="atributo">Teaching language:</dt><dd class="atributo_2">'.$idioma_asig.'</dd>';
          	$url_guia = $row_asignatura["guia_aprendizaje"];
          	echo '<dt class="atributo">More information:</dt><dd class="atributo_2"><a href="'.$url_guia.'" target="_blank">Learning guide</a></dd>';
					}
					else {
						echo '<h1 class="titulo1" style="margin-left:23px;">'.$row_asignatura["nombre_asignatura"].'</h1>';
	          echo '<dl class="lista_definicion">';
	          echo '<dt class="atributo">Titulación:</dt><dd class="atributo_2">'.$nombre_tit.'</dd>';
	          echo '<dt class="atributo">Tipo de asignatura:</dt><dd class="atributo_2">'.$row_asignatura["nombre_tipo_asignatura"].'</dd>';
	          $creditos = str_replace(".0", "", $row_asignatura["ects"]);
	          echo '<dt class="atributo">Número de créditos:</dt><dd class="atributo_2">'.$creditos.' <abbr title="European Credit Transfer System">ECTS</abbr></dd>';
	          echo '<dt class="atributo">Curso de impartición:</dt><dd class="atributo_2">Curso '.$row_asignatura["curso"].'º ('.$row_asignatura["semestre"].')</dd>';
	          echo '<dt class="atributo">Idioma de impartición:</dt><dd class="atributo_2">'.$row_asignatura["idiomas"].'</dd>';
	          $url_guia = $row_asignatura["guia_aprendizaje"];
	          echo '<dt class="atributo">Más información:</dt><dd class="atributo_2"><a href="'.$url_guia.'" target="_blank">Guía de aprendizaje</a></dd>';
					}
				}
        echo '<dt><a class="titulo2" style="font-weight: 500;line-height: 1.2;">'.$profesorado.'</a></dt>';
        echo '<dd><ul class="lista_prof_asig">';

        $sql_profesores = $conn->prepare("SELECT id_profesor, coordinador FROM asignatura_profesor where codigo_asignatura = ? ORDER BY `asignatura_profesor`.`id_profesor` ASC");
        $sql_profesores->bind_param('s', $id_actual);
        $sql_profesores->execute();
        $result_profesores = $sql_profesores->get_result();

        while ($row_profesores = mysqli_fetch_array($result_profesores)) {
          $id = $row_profesores["id_profesor"];
          if ($row_profesores["coordinador"]) {
						if ($idioma == 'en'){$es_coordinador = " (Coordinator)";}
						else{$es_coordinador = " (Coordinador)";}
          }
          else{
            $es_coordinador = "";
          }
          $sql_profesor = "SELECT nombre, apellidos, correo_upm, otro_departamento FROM profesores where correo_upm = '$id' ORDER BY nombre, apellidos ASC";
          if (mysqli_query($conn, $sql_profesor)) {
            $result_profesor = mysqli_query($conn, $sql_profesor);
          }
          else {
            echo "Error: ".$sql_profesor ."<br>".mysqli_error($conn);
          }
          $cont = 0;
          mysqli_data_seek($result_profesor, 0);
          while ($row_profesor = mysqli_fetch_array($result_profesor)) {
            $id_url_profesor = str_replace("@upm.es", "", $id);
            echo '<li class="lista_sin_estilo">';
            if ($row_profesor["otro_departamento"] == 1) {
              echo '<a class="lista_busqueda">'.utf8_encode($row_profesor["nombre"])." ".utf8_encode($row_profesor["apellidos"]).'</a>'.$es_coordinador;
            }
            else {
              echo '<a class="lista_busqueda" href="Profesor.php?codigo_profesor='.$id_url_profesor.'">'.utf8_encode($row_profesor["nombre"])." ".utf8_encode($row_profesor["apellidos"]).'</a>'.$es_coordinador;
            }
            echo  '</li>';
            $cont++;
          }
        }
        if ($cont == 0) {
          echo '<li class="lista_sin_estilo">
                  <p>'.$inf_prof.'.</p>
                </li>';
        }
        echo '</ul>';
        echo "</dd></dl>";
        mysqli_free_result($result_tit);
        mysqli_free_result($result_asignatura);
        mysqli_free_result($result_profesores);
        mysqli_free_result($result_profesor);

        //Cerramos la conexion con la BBDD
        mysqli_close($conn);

      ?>
    </div>
    <?php include ("footer.php"); ?>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	</body>
 </html>
