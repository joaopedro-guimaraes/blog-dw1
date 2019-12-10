<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Painel Admin</title>
    <?php   // A sessão precisa ser iniciada em cada página diferente
    if (!isset($_SESSION)) session_start();
    $admin = true;

      // Verifica se não há a variável da sessão que identifica o usuário
    if (!isset($_SESSION['UsuarioID']) or ($_SESSION['UsuarioAdmin'] == !$admin)) {
      // Destrói a sessão por segurança
      session_destroy();
      // Redireciona o visitante de volta pro login
      header("Location: ../index.php");
      exit;
    }
    ?>
  </head>
  <body>
    
<div class="list-group">
  <a href="admin.php" class="list-group-item list-group-item-action active">
    Painel admin
  </a>
  <a href="admin.php?acao=posts" class="list-group-item list-group-item-action btn-primary">Gerenciar Postagens</a>
  <a href="admin.php?acao=users" class="list-group-item list-group-item-action btn-primary">Gerenciar Usuarios</a>
  <a href="admin.php?acao=eventos" class="list-group-item list-group-item-action  btn-primary">Gerenciar Eventos</a>
  <a href="../index.php" class="list-group-item list-group-item-action btn-danger">Voltar</a>
</div>
<br>
<?php
$dir = getcwd();

if (isset($_GET["acao"])) {
  $acao = $_GET["acao"];

  $dir = $_SERVER['DOCUMENT_ROOT'];

  require_once $dir . '/blogdw1/blog/DAO/postagemDAO.php';
  require_once $dir . '/blogdw1/blog/DAO/usuarioDAO.php';
  require_once $dir . '/blogdw1/eventos/DAO/eventoDAO.php';
  require_once $dir . '/blogdw1/blog/Model/usuario.php';

  if ($acao == "posts") {
    echo "<h3>Gerênciar Postagens</h3>";
    $select = readPost();

    echo "<a href='criarPost.php' class='btn btn-danger m-2 mb-4'>Criar Postagem</a>";
    while ($linha = $select->fetch(PDO::FETCH_ASSOC)) {
      ?>
      <div class="list-group">
        <a href="editPost.php?id=<?= $linha['ID'] ?>" class="list-group-item list-group-item-action flex-column align-items-start active">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1"><?= $linha['TITULO'] ?></h5>
            <small><?= $linha['DATA'] ?></small>
          </div>
          <?php $autor = getUsuario($linha['AUTOR']); ?>
          <small><?= "Autor: ", $autor->getNome() ?></small>
        </a>
        <br>
      </div>
      <br>
            <?php

          }
        } else if ($acao == "users") {
          echo "<h3>Gerênciar Usuarios</h3>";
          $select = listarUsuario();
          while ($linha = $select->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="list-group">
              <a href="editUser.php?id=<?= $linha['ID'] ?>" class="list-group-item list-group-item-action flex-column align-items-start active">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1"><?= $linha['NOME'], " ", $linha['SOBRENOME'] ?></h5>
                  <small><?= "Login: ", $linha['LOGIN'] ?></small>
                </div>
                <small><?= "Telefone: ", $linha['TELEFONE'] ?></small>
              </a>
              <br>
            </div>
            <br>
            <?php

          }
        } else if ($acao == "eventos") {
          echo "<h3>Gerênciar Eventos</h3>";
          $select = readEventos();

          echo "<a href='criarEvento.php' class='btn btn-danger m-2 mb-4'>Criar Evento</a>";

          while ($linha = $select->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="list-group">
              <a href="editEvento.php?id=<?= $linha['ID'] ?>" class="list-group-item list-group-item-action flex-column align-items-start active">
                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1"><?= utf8_encode($linha['NOME']) ?></h5>
                  <small><?= "Data: ", $linha['DATA'] ?></small>
                </div>
                <small><?= "Descrição: ", utf8_decode($linha['DESCRICAO']) ?></small>
              </a>
              <br>
            </div>
            <br>
            <?php

          }
        }
      } ?>



    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>