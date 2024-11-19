<?php
// BARRA DE NAVEGACION
$dlsiis="Department of Computer Languages and Systems and Software Engineering";
$docencia = "Teaching";
$grado = 'Grade';
$master = 'Master';
$doctorado = 'Doctorate';
$profesorado = 'Professorship';
$buscar = 'Find teacher:';
$pornombre = 'By name';
$porasig = 'By subject';
$mostrartodos = 'Show all';
$buscartutoria = 'Search for tutoring:';
$mostrartutorias = 'Show all tutoring';
$investigacion = 'Investigation';
$grupos = 'Groups';
$lineas = 'Lines';
if ($url_actual){
  $bandera = '<a href="'.$url_actual.'&language=es" title="Change language to Spanish" style="margin-left:18px; color: white;">Español</a>';
}
else {
  $bandera = '<a href="?language=es" title="Change language to Spanish" style="margin-left:18px; color: white;">Español</a>';
}
$inicio_sesion = "log in";
// breadcrumb
$usted = 'You are here:';
// footer
$contacto = 'Contact';
$accesibilidad = 'Accessibility';
$mapaweb = 'Web Map';
$html = 'Valid HTML 5!';
$css = 'Valid CSS 3!';
$wcag = 'Explanation of WCAG 2.1 Level Double-A Conformance';
// Contacto
$contacto_izq = '<dt><a class="titulo2" style="font-weight: 500;line-height: 1.2;">Director</a></dt>
  <dd><a href="Profesor.php?codigo_profesor=joseluis.fuertes">Mr. José Luis Fuertes Castro</a></dd>
  <dd>
    <ul class="lista_sin_estilo" style="margin-left:-20px;">
      <li>Phone: 91 06 72930</li>
      <li>Mail: director.dlsiis@fi.upm.es</li>
    </ul>
  </dd>
<dt><a class="titulo2" style="font-weight: 500;line-height: 1.2;">Deputy Directors</a></dt>
  <dd><a href="Profesor.php?codigo_profesor=aurora.perez">Mrs. Aurora Pérez Pérez</a></dd>
  <dd>
    <ul class="lista_sin_estilo" style="margin-left:-20px;">
      <li>Phone: 91 06 72977</li>
      <li>Mail: aurora@fi.upm.es</li>
    </ul>
  </dd>
  <dd><a href="Profesor.php?codigo_profesor=raul.alonso">Mr. Raúl Alonso Calvo</a></dd>
  <dd>
    <ul class="lista_sin_estilo" style="margin-left:-20px;">
      <li>Phone: 91 06 72932</li>
      <li>Mail: ralonso@fi.upm.es</li>
    </ul>
  </dd>
<dt><a class="titulo2" style="font-weight: 500;line-height: 1.2;">Academic secretary</a></dt>
  <dd><a href="Profesor.php?codigo_profesor=m.jimenez">Mr. Miguel Jiménez Gañán</a></dd>
  <dd>
    <ul class="lista_sin_estilo" style="margin-left:-20px;">
      <li>Phone: 91 06 72995</li>
      <li>Mail: secretario.dlsiis@fi.upm.es</li>
    </ul>
  </dd>
<dt><a class="titulo2" style="font-weight: 500;line-height: 1.2;">Administrative Secretaries</a></dt>
  <dd>Mrs. Ascensión Gutiérrez de la Solana Hernández</dd>
  <dd>
    <ul class="lista_sin_estilo" style="margin-left:-20px;">
      <li>Phone: 91 06 73075</li>
      <li>Mail: choni@fi.upm.es</li>
    </ul>
  </dd>
  <dd>Mrs. Concepción Gant León</dd>
  <dd>
    <ul class="lista_sin_estilo" style="margin-left:-20px;">
      <li>Phone: 91 06 73071</li>
      <li>Mail: cgant@fi.upm.es</li>
    </ul>
  </dd>';
$contacto_der = '<h2>Location</h2>
  <p>We are in:</p>
  <ul class="lista_sin_estilo">
    <li><a href="https://fi.upm.es/?id=inicio&idioma=english" title="Escuela Técnica Superior de Ingenieros Informáticos">Escuela Técnica Superior de Ingenieros Informáticos</a></li>
    <li><a href="http://www.upm.es/&idioma=english" title="Universidad Politécnica de Madrid">Universidad Politécnica de Madrid</a></li>
    <li>28660 - Boadilla del Monte, Madrid (España)</li>
  </ul>
  <a href="http://www.fi.upm.es/?id=comollegar&idioma=english" title="How to get to the  Escuela Técnica Superior de Ingenieros Informáticos?">How to get to the  Escuela Técnica Superior de Ingenieros Informáticos?</a>';
$campus = 'Aerial photo of the Campus de Montegancedo';
//Accesibilidad
$cont_acs = '<p>By law, the
  <a href="index.php" title="Department of Computer Languages and Systems and Software Engineering">Department of Computer Languages and Systems and Software Engineering</a>
   website must be accessible for people with disabilities. On this ground, every effort has been made to develop a highly accessible website so as not to discriminate against anybody. To do this, we have adhered to the following technical standards and guidelines:
 </p>
  <ul>
    <li><strong><a href="http://www.aenor.es/aenor/normas/normas/fichanorma.asp?tipo=N&codigo=N0049614" title="UNE 139803:2012" hreflang="es"><abbr title="A Spanish standard">UNE</abbr> 139803:2012</a></strong> by <a href="http://www.aenor.es/" hreflang="es" title="AENOR"><abbr title="Spanish Standardization and Certification Association">AENOR</abbr></a>: This standard, titled "Accessibility Requirements for Web Contents", sets out the requirements that contents available over the Internet and other types of computer networks have to meet for most people, including people with disabilities and elderly people, to be able to use them either unassisted or by means of the respective assistive technologies. It applies to any type of content available over computer networks, especially web contents that are accessed using computer programs called uer applications (the most common of which are called web browsers), independently how the contents have been produced. Accessibility requirements for web contents are divided into three levels, and a site is considered to be accessbile if it conforms to level A and AA requirements.</li>
    <li><strong><a href="https://www.w3.org/TR/WCAG21/" title="WCAG 2.1"><abbr title="Web Content Accessibility Guidelines" lang="en">WCAG</abbr> 2.1</a></strong> by <a href="http://www.w3.org/" title="W3C"><abbr title="World Wide Web Consortium" lang="en">W3C</abbr></a> <a href="http://www.w3.org/WAI/" title="WAI"><abbr lang="en" title="Web Accessibility Initiative">WAI</abbr></a>: The Web Content Accessibility Guidelines are recommendations published in 2018 by the World Wide Web Consortium Web Accessibility Initiative. They set out the requirements for web contents to be accessible for people with disabilities. The document is composed of four general principles, under which there are 12 guidelines, each composed of several success criteria. These success criteria are associated with three conformance levels represented by letters A, AA and AAA (which are increasingly demanding).</li>
  </ul>
<p>This site is intended to be accessible for all. If you have any difficulty accessing any of its content, please cooperate and contact the <a href="mailto:direcor.dlsiis@fi.upm.es" title="Website master">Webmaster</a>.</p>';
// Mapa Web
$buscar_nombre = 'Search by name';
$buscar_asig = 'Search by subject';
$mostrar_todos = 'Show all the teachers';
// Home
$contenido = '<p>
The Department of Computer Languages and Systems and Software Engineering groups teachers from the areas of knowledge of:</p>
<ul>
  <li>Computer Science and Artificial Intelligence</li>
  <li>Computer Languages ​​and Systems</li>
  <li>Environmental Technologies</li>
</ul>
<p>
The Escuela Técnica Superior de Ingenieros Informáticos (before named Facultad de Informática) of the Universidad Politécnica de Madrid is a pioneer in Spain and
It is the university center with the most experience and prestige in the teaching of higher Computer Engineering in our country. It is located in a natural environment,
that enables a dynamic university life, which is reflected in the realization of numerous events and activities, both scientific-technical and cultural or outreach.
</p>';
$caption= '
<caption style="text-align: center; caption-side: top; color: black;">
  Notice Board
  <details>
    <summary>More information:</summary>
    <p style="font-size: 14px;">Table with last announcements related to the Department of Computer Languages and Systems and Software Engineering. Each announcement is shown in each row. Rows provide the announcement publication date and the announcement content.</p>
  </details>
</caption>';
$aviso = "Notice";
$caption_calendar= '
<caption style="text-align: center; caption-side: top; color: black;">
  Calendar of events
  <details>
    <summary>More information:</summary>
    <p style="font-size: 14px;">Calendar of events related to the Department of Computer Languages and Systems and Software Engineering. One event is shown for each row ordered from the most recent to the oldest. Each event is composed by the Date of last modification of the event and by the Text of the event.</p>
  </details>
</caption>';
$evento = "Event";
$fecha = "Date";
// Grados
$pagina_oficial = 'Official website of the ';
$las_asig = 'The subjects:';
$masteres = 'Masters';
// Asignatura
$inf_prof = 'No information on teachers';
// Mostrar Todos
$todos = 'All the teachers';
// Buscar por nombre
$por_nomb = 'Search teacher by name';
$boton_buscar = 'Search';
$escribir_nom = "Write teacher's name";
$sin_res = 'No results found.';
// Buscar por asignautra
$por_asig = 'Search teacher by subject';
$escribir_asig = "Write subject's name";
// Profesor
$despacho = 'Office';
$correo = 'Mail';
$asig_prof = 'Subjects taught';
// Grupos investigacion
$grupo_inv = 'Research groups';
$grupo_dep = 'Research groups of the department';
$grupos_investigacion = '
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=322">
    Biomedical informatics group (GIB)
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=326">
    Computational logic, languages, implementation and parallelism (CLIP)
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=413">
    Data Mining and Simulation (MIDAS)
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=313">
    Distributed systems labs (LSD)
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=545">
    Human Computer Interaction and Advanced Interactive Systems
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=312">
    Information and communications technology research group: CETTICO
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=315">
    Information and quantum computation research group (GIICC)
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=266">
    Numerical simulation in science and engineering research group
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=324">
    SEMEPRO: Safety and process improvement
  </a>
</li>
<li>
  <a href="http://www.upm.es/observatorio/vi/index.jsp?pageac=grupo.jsp&idGrupo=314">
    Software engineering
  </a>
</li>';
?>
