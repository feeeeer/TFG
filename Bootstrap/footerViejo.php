<footer id="sticky-footer" class="footer py-4 text-white-50">
  <div class="container-sm d-flex">
    <div class="mr-auto d-flex flex-column">
      <a href="Contacto.php" style="color: black; text-decoration-line: underline;"><?php echo $contacto;?></a>
      <a href="Accesibilidad.php" style="color: black; text-decoration-line: underline;"><?php echo $accesibilidad;?></a>
      <a href="Mapaweb.php" style="color: black; text-decoration-line: underline;"><?php echo $mapaweb;?></a>
    </div>
    <div class="ml-auto d-flex align-items-end">

      <a title="HTML 5 Válido" href="http://validator.w3.org/check?uri=referer">
        <img height="28" width="77"
             src="Pictures/valid-html5.png" title="<?php echo $html;?>" alt="W3C HTML 5 Válido">
      </a>
      <a href="http://jigsaw.w3.org/css-validator/uri=https://www.dlsiis.fi.upm.es/" title="¡CSS Válido!">
        <img height="28" width="77"
             src="Pictures/vcss.png" title="<?php echo $css;?>" alt="¡CSS Válido!">
      </a>
      <a href="https://www.w3.org/WAI/WCAG2AA-Conformance" title="<?php echo $wcag;?>">
        <img height="28" width="77"
             src="https://www.w3.org/WAI/WCAG21/wcag2.1AA-v.png"
             alt="Level Double-A conformance, W3C WAI Web Content Accessibility Guidelines 2.1">
      </a>
    </div>
  </div>
</footer>
