          <?php
          //HEADER
          $dir = $_SERVER['DOCUMENT_ROOT'];

          require_once $dir . '/blogdw1/header.php';

          //BODY
          require_once "postagem.php";
          require_once "cadastro.php";

          if (isset($_GET["id"])) {
            if (!isset($_GET['page'])) {
              $pc = "1";              
            } else {
              $pc = $_GET["page"];              
            }

            comentarios($_GET["id"], $pc);
          } else
            if (isset($_GET["cadastrar"])) {
            cadastrar();            
          } else
            if (isset($_GET["comment"])) {
            comentar($_GET["comment"]);            
          } else {
            if (!isset($_GET['page'])) {
              $pc = "1";              
            } else {
              $pc = $_GET["page"];              
            }

            posts($pc);
          }

          //FOOTER
          $dir = $_SERVER['DOCUMENT_ROOT'];

          require_once $dir . '/blogdw1/footer.php';
          ?>        
