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
    <title>DLSIIS - Profesorado</title>
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
            <li class="nav-item dropdown">
              <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" style="color:#B3BCC3;" id="bd-versions1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $docencia; ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="bd-versions1">
                <a class="dropdown-item" href="Grado.php"><?php echo $grado; ?></a>
                <a class="dropdown-item" href="Master.php"><?php echo $master; ?></a>
                <a class="dropdown-item" href="Doctorado.php"><?php echo $doctorado; ?></a>
              </div>
            </li>
            <li class="nav-item dropdown active">
              <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
    <?php
      $correo_upm = $_GET["codigo_profesor"]."@upm.es";
      require_once ('loginBD.php');
      $sql_profesor = $conn->prepare("SELECT * FROM profesores where correo_upm = ? ");
      $sql_profesor->bind_param('s', $correo_upm);
      $sql_profesor->execute();
      $result_profesor = $sql_profesor->get_result();

      while ($row_profesor = mysqli_fetch_array($result_profesor)) {
        $nombre = utf8_encode($row_profesor["nombre"]." ".$row_profesor["apellidos"]);
      }
    ?>
    <nav aria-label="breadcrumb">
      <ol class="migas_de_pan breadcrumb" style="background-color: #FFFEF7;">
        <li style="padding-right: 4px;"><?php echo $usted; ?></li>
        <li class="breadcrumb-item active" aria-current="page"><abbr title="<?php echo $dlsiis; ?>">DLSIIS</abbr></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $nombre; ?></li>
      </ol>
    </nav>
    <div class="row container" style="max-width: none;padding-left: 25px;padding-right: 25px;margin-left: auto;margin-right: auto;">
      <?php
      mysqli_data_seek($result_profesor, 0);
      while ($row_profesor = mysqli_fetch_array($result_profesor)) {
        echo '<h1 class="titulo1" style="margin-left:23px;">'.$nombre.'</h1>';
        echo '<dl class="lista_definicion">';
        if (!empty($row_profesor["despacho"])) {
          echo '<dt class="atributo">'.$despacho.':</dt><dd class="atributo_2">'.$row_profesor["despacho"].'</dd>';
        }
        echo '<dt class="atributo">'.$correo.':</dt><dd class="atributo_2">'.$row_profesor["correo_upm"].'</dd>';
        echo '<dt><a class="titulo2" style="font-weight: 500;line-height: 1.2;">'.$asig_prof.'</a></dt>';
        echo '<dd><ul class="lista_asig_prof">';

        $sql_asignaturas = $conn->prepare("SELECT codigo_asignatura FROM asignatura_profesor where id_profesor = ? ");
        $sql_asignaturas->bind_param('s', $correo_upm);
        $sql_asignaturas->execute();
        $result_asignaturas = $sql_asignaturas->get_result();

        while ($row_asignaturas = mysqli_fetch_array($result_asignaturas)) {
          $codigo_asignatura = $row_asignaturas["codigo_asignatura"];
					if ($idioma == 'en'){
						$sql_asignatura = "SELECT * FROM asignaturas where id = '$codigo_asignatura' ORDER BY `asignaturas`.`nombre_asignatura_ingles` ASC";
					}
					else {
						$sql_asignatura = "SELECT * FROM asignaturas where id = '$codigo_asignatura' ORDER BY `asignaturas`.`nombre_asignatura` ASC";
					}
          if (mysqli_query($conn, $sql_asignatura)) {
            $result_asignatura = mysqli_query($conn, $sql_asignatura);
          }
          else {
            echo "Error: ".$sql_asignatura ."<br>".mysqli_error($conn);
          }
          mysqli_data_seek($result_asignatura, 0);
          while ($row_asignatura = mysqli_fetch_array($result_asignatura)) {
            $codigo_titulo = $row_asignatura["codigo_titulacion"];
						if ($idioma == 'en') {
							$nombre_asignatura = $row_asignatura["nombre_asignatura_ingles"];
	            $sql_titulos = "SELECT nombre_ingles FROM titulo_espanol_ingles WHERE codigo_titulo = '$codigo_titulo'";
						}
            else {
							$nombre_asignatura = $row_asignatura["nombre_asignatura"];
	            $sql_titulos = "SELECT nombre_espanol FROM titulo_espanol_ingles WHERE codigo_titulo = '$codigo_titulo'";
						}
            if (mysqli_query($conn, $sql_titulos)) {
              $result_titulos = mysqli_query($conn, $sql_titulos);
            }
            else {
              echo "Error: ".$sql_titulos ."<br>".mysqli_error($conn);
            }
            mysqli_data_seek($result_titulos, 0);
            while ($row_titulos =mysqli_fetch_array($result_titulos)) {
							if ($idioma == 'en') {
								echo '<li class="lista_profesores">
	                      <a href="Asignatura.php?codigo_tit_asig='.$row_asignatura["id"].'&id_tit='.$row_asignatura["codigo_titulacion"].'&tipo_tit=">'.$nombre_asignatura.' ('.utf8_encode($row_titulos["nombre_ingles"]).')</a>
	                    </li>';
							}
              else {
								echo '<li class="lista_profesores">
	                      <a href="Asignatura.php?codigo_tit_asig='.$row_asignatura["id"].'&id_tit='.$row_asignatura["codigo_titulacion"].'&tipo_tit=">'.$nombre_asignatura.' ('.utf8_encode($row_titulos["nombre_espanol"]).')</a>
	                    </li>';
							}
            }
          }
        }
        echo "</ul>";
      }
      echo "</dd></dl>";
      mysqli_free_result($result_profesor);
      mysqli_free_result($result_asignaturas);
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
