<?php require_once 'header.php'; ?>
  <body>
  <div class="site-loader"></div>
  <?php 
    # arquivo navbar.php
    require_once 'navbar.php';

    # arquivo carousel.php
    require_once 'carousel.php'; 

    # filtro de pesquisa
    require_once 'filtro.php';

    # galeria de imóveis
    require_once 'galeria-locacao.php';

    # quem somos
    require_once 'quem-somos.php';

    # equipe de corretores
    require_once 'corretores.php';

    # footer
    require_once 'footer.php';
  ?>  
  </body>
</html>