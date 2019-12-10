<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Olá, mundo!</title>
  </head>
  <body>
<?php

$dir = $_SERVER['DOCUMENT_ROOT'];
require_once $dir . "/blogdw1/blog/DAO/postagemDAO.php";
require_once $dir . "/blogdw1/blog/DAO/usuarioDAO.php";

$user = new Usuario();
$user = getUsuario($_GET["id"]);

?>
<div class="container mt-5">
<form method="post" action="update.php?acao=updateUser">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">ID</label>
      <input type="text" class="form-control" id="validationDefault01" name="id" name="id" readonly value="<?= $user->getId() ?>" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Nome</label>
      <input type="text" class="form-control" id="validationDefault02" placeholder="Nome" name="nome" value="<?= $user->getNome() ?>" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03">Sobrenome</label>
      <input type="text" class="form-control" id="validationDefault03" placeholder="Sobrenome" name="sobrenome" value="<?= $user->getSobrenome() ?>" required>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault03">Telefone</label>
      <input type="text" class="form-control" id="validationDefault03" placeholder="Telefone" name="telefone" value="<?= $user->getTelefone() ?>" required>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationDefault05">Login</label>
      <input type="text" class="form-control" id="validationDefault05" readonly placeholder="Login" name="login" value="<?= $user->getLogin() ?>" required>
    </div>
        <div class="col-md-3 mb-3">
      <label for="validationDefault05">Senha</label>
      <input type="password" class="form-control" id="validationDefault05" placeholder="Senha" name="senha" value="<?= $user->getSenha() ?>" required>
    </div>
  </div>

  <div class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input" name="admin" id="admin" <?= $user->getAdmin() == 1 ? "checked" : false ?>>
    <label class="custom-control-label" for="admin">Admin</label>
  </div>

  <br>

    <button class="btn btn-primary" type="submit">Enviar</button>
    <a href="update.php?id=<?= $user->getId(), "&acao=user" ?>" class="btn btn-danger">Excluir</a>
    <a href="admin.php?acao=users" class="btn btn-primary">Voltar</a>
</form>
</div>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>