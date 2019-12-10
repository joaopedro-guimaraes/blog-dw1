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

$post = new Post();
$post = getPost($_GET["id"]);
$autor = new Usuario();
$autor = getUsuario($post->getAutor());

?>
<div class="container mt-5">
<form method="post" action="update.php?acao=updatePost">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault01">ID</label>
      <input type="text" class="form-control" id="validationDefault01" name="id" readonly value="<?= $post->getId() ?>" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Titulo</label>
      <input type="text" class="form-control" id="validationDefault02" placeholder="Titulo" name="titulo" value="<?= $post->getTitulo() ?>" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03">Autor</label>
      <input type="text" class="form-control" readonly id="validationDefault03" placeholder="Autor" name="autorNome" value="<?= $autor ?>" required>
      <input type="hidden" name="autor" value="<?= $autor->getId() ?>">
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationDefault03">Texto</label>
      <textarea class="form-control" name="texto" require><?= $post->getTexto() ?></textarea>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationDefault05">Data</label>
      <input type="text" class="form-control" id="validationDefault05" readonly placeholder="Data" name="data" value="<?= $post->getData() ?>" required>
    </div>
  </div>
    <button class="btn btn-primary" type="submit">Enviar</button>
    <a href="update.php?id=<?= $post->getId(), "&acao=post" ?>" class="btn btn-danger">Excluir</a>
    <a href="admin.php?acao=posts" class="btn btn-primary">Voltar</a>
</form>
</div>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>