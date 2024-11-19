<?php
// BARRA DE NAVEGACIÓN
$dlsiis = "Departamento de Lenguajes y Sistemas Informáticos e Ingeniería de Software";
$docencia = "Docencia";
$grado = 'Grado';
$master = 'Máster';
$doctorado = 'Doctorado';
$profesorado = 'Profesorado';
$buscar = 'Buscar profesor:';
$pornombre = 'Por nombre';
$porasig = 'Por asignatura';
$mostrartodos = 'Mostrar todos';
$buscartutoria = 'Buscar tutoría:';
$mostrartutorias = 'Mostrar todas las tutorías';
$investigacion = 'Investigación';
$grupos = 'Grupos';
$lineas = 'Líneas';
if ($url_actual){
$bandera = '<a href="'.$url_actual.'&language=en" title="Cambiar idioma a inglés" style="margin-left:18px; color: white;">English</a>';
}
else {
  $bandera = '<a href="?language=en" title="Cambiar idioma a inglés" style="margin-left:18px; color: white;">English</a>';
}
$inicio_sesion = "iniciar sesión";
// breadcrumb
$usted = 'Usted está aquí:';
// footer
$contacto = 'Contacto';
$accesibilidad = 'Accesibilidad';
$mapaweb = 'Mapa Web';
$html = '¡HTML 5 Válido!';
$css = '¡CSS 3 Válido!';
$wcag = 'Explicación de la conformidad WCAG 2.1 Nivel Doble-A';
// Contacto
$contacto_izq = '<dt><a class="titulo2" style="font-weight: 500;line-height: 1.2;">Director</a></dt>
  <dd><a href="Profesor.php?codigo_profesor=joseluis.fuertes">D. José Luis Fuertes Castro</a></dd>
  <dd>
    <ul class="lista_sin_estilo" style="margin-left:-20px;">
      <li>Teléfono: 91 06 72930</li>
      <li>Correo: director.dlsiis@fi.upm.es</li>
    </ul>
  </dd>
<dt><a class="titulo2" style="font-weight: 500;line-height: 1.2;">Subdirectores</a></dt>
  <dd><a href="Profesor.php?codigo_profesor=aurora.perez">Dña. Aurora Pérez Pérez</a></dd>
  <dd>
    <ul class="lista_sin_estilo" style="margin-left:-20px;">
      <li>Teléfono: 91 06 72977</li>
      <li>Correo: aurora@fi.upm.es</li>
    </ul>
  </dd>
  <dd><a href="Profesor.php?codigo_profesor=raul.alonso">D. Raúl Alonso Calvo</a></dd>
  <dd>
    <ul class="lista_sin_estilo" style="margin-left:-20px;">
      <li>Teléfono: 91 06 72932</li>
      <li>Correo: ralonso@fi.upm.es</li>
    </ul>
  </dd>
<dt><a class="titulo2" style="font-weight: 500;line-height: 1.2;">Secretario Académico</a></dt>
  <dd><a href="Profesor.php?codigo_profesor=m.jimenez">D. Miguel Jiménez Gañán</a></dd>
  <dd>
    <ul class="lista_sin_estilo" style="margin-left:-20px;">
      <li>Teléfono: 91 06 72995</li>
      <li>Correo: secretario.dlsiis@fi.upm.es</li>
    </ul>
  </dd>
<dt><a class="titulo2" style="font-weight: 500;line-height: 1.2;">Secretarias Administrativas</a></dt>
  <dd>Dña. Ascensión Gutiérrez de la Solana Hernández</dd>
  <dd>
    <ul class="lista_sin_estilo" style="margin-left:-20px;">
      <li>Teléfono: 91 06 73075</li>
      <li>Correo: choni@fi.upm.es</li>
    </ul>
  </dd>
  <dd>Dña. Concepción Gant León</dd>
  <dd>
    <ul class="lista_sin_estilo" style="margin-left:-20px;">
      <li>Teléfono: 91 06 73071</li>
      <li>Correo: cgant@fi.upm.es</li>
    </ul>
  </dd>';
$contacto_der = '<h2>Localización</h2>
<p>Estamos en:</p>
<ul class="lista_sin_estilo">
  <li><a href="https://fi.upm.es/?id=inicio&idioma=castellano" title="Escuela Técnica Superior de Ingenieros Informáticos">Escuela Técnica Superior de Ingenieros Informáticos</a></li>
  <li><a href="http://www.upm.es/&idioma=castellano" title="Universidad Politécnica de Madrid">Universidad Politécnica de Madrid</a></li>
  <li>28660 - Boadilla del Monte, Madrid (España)</li>
</ul>
<a href="http://www.fi.upm.es/?id=comollegar&idioma=castellano" title="¿Cómo llegar a la Escuela Técnica Superior de Ingenieros Informáticos?">¿Cómo llegar a la Escuela Técnica Superior de Ingenieros Informáticos?</a>';
$campus = 'Foto aérea del Campus de Montegancedo';
//Accesibilidad
$cont_acs = '<p>De acuerdo con las leyes vigentes, la Web del
  <a href="index.php" title="Departamento de Lenguajes y Sistemas Informáticos e Ingeniería de Software">Departamento de Lenguajes y Sistemas Informáticos e Ingeniería de Software</a>
   tiene que ser accesible a personas con discapacidad. Por ello, se han dedicado todos los esfuerzos en desarrollar un sitio con un alto nivel de accesibilidad y, de esta manera, no discriminar a ninguna persona.
   Para conseguirlo se han seguido las normas técnicas y recomendaciones siguientes:
 </p>
<ul>
  <li><strong><a href="http://www.aenor.es/aenor/normas/normas/fichanorma.asp?tipo=N&codigo=N0049614" title="UNE 139803:2004"><abbr title="Una Norma Española">UNE</abbr>139803:20</a></strong> de
    <a href="http://www.aenor.es/"><abbr title="Asociación Española de Normalización y Certificación">AENOR</abbr></a>: Esta norma, titulada "Requisitos de Accesibilidad para Contenidos en la Web"
    recoge las características que ha de cumplir la información y otros contenidos disponibles mediante tecnologías web en Internet, intranets y cualquier tipo de redes informáticas, para que puedan
    ser utilizados por la mayor parte de las personas, incluyendo personas con discapacidad y personas de edad avanzada, bien de forma autónoma o mediante los productos de apoyo pertinentes.
    Se aplica a los contenidos web a los que se accede mediante programas informáticos llamados aplicaciones de usuario (siendo los más habituales los llamados navegadores web), independientemente
    de cómo se hayan generado esos contenidos. Se establecen tres niveles en los requisitos de accesibilidad para contenidos web, considerándose que un sitio es accesible si cumple con los requisitos de nivel A y AA.
  </li>
  <li><strong><a href="https://www.w3.org/TR/WCAG21/" title="WCAG 2.1"><abbr title="Web Content Accesibility Guidelines" lang="en">WCAG</abbr> 2.1</a></strong> de
    <a href="http://www.w3.org/WAI/" title="WAI"><abbr lang="en" title="Web Accessibility Initiative">WAI</abbr></a> del
    <a href="http://www.w3.org/"><abbr title="World Wide Web Consortium" lang="en">W3C</abbr></a>: Las "Pautas de Accesibilidad para el Contenido Web" (<span class="ingles" lang="en">Web Content Accesibility Guidelines</span>)
    es una recomendación de 2018 de la "Iniciativa para la Accesibilidad Web" (<span class="ingles" lang="en">Web Accessibility Initiative</span>)perteneciente al "Consorcio de la Web"  (<span class="ingles" lang="en">World Wide Web Consortium</span>)
    que presenta los criterios que deben cumplir los contenidos de una Web para ser accesibles a personas con discapacidad. Está formada por 4 principios que se distribuyen en 12 pautas, cada una formada por varios criterios de conformidad.
    Estos criterios están asociados a un nivel de conformidad, que viene representado por las letras A, AA y AAA (de mayor a menor exigencia).
  </li>
</ul>
<p>Este sitio tiene la intención de ser accesible para todos. Si alguien encuentra alguna dificultad para acceder a cualquier aspecto de su contenido, le rogamos que colabore, comunicándoselo al
  <a href="mailto:director.dlsiis@fi.upm.es" title="Web Máster">WebMáster</a>.
</p>';
// Mapa Web
$buscar_nombre = 'Buscar por nombre';
$buscar_asig = 'Buscar por asignatura';
$mostrar_todos = 'Mostrar todos los profesores';
// Home
$contenido = '<p>
El Departamento de Lenguajes y Sistemas Informáticos e Ingeniería de Software agrupa a profesores de las áreas de conocimiento de:</p>
<ul>
  <li>Ciencias de la Computación e Inteligencia Artificial</li>
  <li>Lenguajes y Sistemas Informáticos</li>
  <li>Tecnologías del Medio Ambiente</li>
</ul>
<p>
La Escuela Técnica Superior de Ingenieros Informáticos (antes llamada Facultad de Informática) de la Universidad Politécnica de Madrid es pionera en España y
es el centro universitario con mayor experiencia y prestigio en la enseñanza de la Ingeniería Informática superior en nuestro país. Está situada en un entorno natural,
que posibilita una vida universitaria dinámica, que se refleja en la realización de numerosos eventos y actividades, tanto de carácter científico-técnico como de carácter cultural o de divulgación.
</p>';
$caption= '
<caption style="text-align: center; caption-side: top; color: black;">
  Tablón de Avisos
  <details>
    <summary>Más información:</summary>
    <p style="font-size: 14px;">Tabla con los últimos avisos publicados por el Departamento de Lenguajes y Sistemas Informáticos e Ingeniería de Software. Se muestra un aviso por cada fila ordenados de más modernos a más antiguos. Cada aviso está compuesto por la Fecha de última modificación del aviso y por el Texto del aviso.</p>
  </details>
</caption>';
$aviso = "Aviso";
$caption_calendar= '
<caption style="text-align: center; caption-side: top; color: black;">
  Calendario de eventos
  <details>
    <summary>Más información:</summary>
    <p style="font-size: 14px;">Calendario de eventos relacionados con el Departamento de Lenguajes y Sistemas Informáticos e Ingeniería de Software. Se muestra un evento por cada fila ordenados de más modernos a más antiguos. Cada evento está compuesto por la Fecha de última modificación del evento y por el Texto del evento.</p>
  </details>
</caption>';
$evento = "Evento";
$fecha = "Fecha";
// Grados
$pagina_oficial = 'Página Web oficial del ';
$las_asig = 'Las asignaturas:';
$masteres = 'Másteres';
// Asignatura
$inf_prof = 'No se tiene información del profesorado';
// Mostrar Todos
$todos = 'Todos los profesores';
// Buscar por nombre
$por_nomb = 'Buscar profesor por nombre';
$boton_buscar = 'Buscar';
$escribir_nom = 'Escribir nombre profesor';
$sin_res = 'No se han encontrado resultados.';
// Buscar por asignautra
$por_asig = 'Buscar profesor por asignatura';
$escribir_asig = 'Escribir nombre asignatura';
// Profesor
$despacho = 'Despacho';
$correo = 'Correo';
$asig_prof = 'Asignaturas que imparte';
// Grupos investigacion
$grupo_inv = 'Grupos de investigación';
$grupo_dep = 'Grupos de Investigación del departamento';
$grupos_investigacion = '
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=326">
    Computación lógica, Lenguajes, Implementación y Paralelismo (CLIP)
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=314">
    Ingeniería del Software
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=545">
    Interacción Persona Ordenador y Sistemas Interactivos Avanzados
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=322">
    Grupo de Informática Biomédica (GIB)
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=315">
    Grupo de investigación en Información y Computación Cuántica (GIICC)
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=312">
    Grupo de Investigación en Tecnología Informática y de las Comunicaciones: CETTICO
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=266">
    Grupo de Simulación Numérica en Ciencias e Ingeniería
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=313">
    Laboratorio de sistemas distribuidos (LSD)
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=413">
    Minería de Datos y Simulación (MIDAS)
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=324">
    SEMEPRO: Seguridad y Mejora de Procesos
  </a>
</li>';
?>
