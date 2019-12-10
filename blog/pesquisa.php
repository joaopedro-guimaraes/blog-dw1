<?php
          //HEADER
          $dir = $_SERVER['DOCUMENT_ROOT'];

          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $titulo = $_POST["tituloDaPostagem"];
        }            
            require_once $dir . '/blogdw1/header.php';
            require_once "postagem.php";

            if (isset($_GET["id"])) {
              if (!isset($_GET['page'])) {
                $paginaAtual = "1";                
              } else {
                $paginaAtual = $_GET["page"];                
              }            
              comentarios($_GET["id"], $paginaAtual);
            } else
              if (isset($_GET["cadastrar"])) {
              cadastrar();              
            } else
              if (isset($_GET["comment"])) {
              comentar($_GET["comment"]);              
            } else {
              if (!isset($_GET['page'])) {
                $paginaAtual = "1";                
              } else {
                $paginaAtual = $_GET["page"];                
              } 
              
              postsPesquisados($paginaAtual, $titulo);
            }        
        
        //FOOTER
        $dir = $_SERVER['DOCUMENT_ROOT'];
        require_once $dir . '/blogdw1/footer.php';
        
          ?>        
