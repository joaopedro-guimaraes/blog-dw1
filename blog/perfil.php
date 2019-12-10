<?php
        //HEADER
$dir = $_SERVER['DOCUMENT_ROOT'];

if (!isset($_SESSION))
    session_start();

require_once $dir . '/blogdw1/header.php';
require_once $dir . '/blogdw1/blog/Model/usuario.php';
require_once $dir . '/blogdw1/blog/DAO/usuarioDAO.php';
require_once $dir . '/blogdw1/blog/DAO/comentarioDAO.php';
require_once $dir . '/blogdw1/blog/DAO/postagemDAO.php';
$user = new Usuario();
$user = getUsuario($_SESSION['UsuarioID']);

?>
<nav>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="comments-tab" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="true">Meus Comentarios</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="perfil-tab" data-toggle="tab" href="#perfil" role="tab" aria-controls="perfil" aria-selected="false">Perfil</a>
  </li>
</ul>
</nav>

<div class="tab-content" id="myTabContent">

     <div class="tab-pane fade show active" id="comments" role="tabpanel" aria-labelledby="comments-tab">
        <?php
        $pc;
        if (!isset($_GET['page'])) {
            $pc = "1";
        } else {
            $pc = $_GET["page"];
        }

        $select = readComentsUserPage($pc, $user);
        $count = $select[0]->rowCount();
        if ($count > 0) {
            while ($linha = $select[0]->fetch(PDO::FETCH_ASSOC)) {
                $post = new Post();
                $post = getPost($linha['IDPOSTAGEM']);
                ?>
            <br>
            <div class="card container-fluid">
                <div class="card-header">
                    <?php $autor = getUsuario($post->getAutor()); ?>
                    <?= "<b>Autor do post: </b>" . $autor->getNome() ?>
                </div>
                <div class="card-body">
                    <b><h5 class="card-title">Titulo do post:</b> <?= $post->getTitulo() ?></h5>
                    <b><p class="card-text">Seu comentario:</b> <?= $linha['TEXTO'] ?></p>
                    <b><p class="card-text">Data do comentario:</b> <?= $linha['DATA'] ?></p>
                    <a href="/blogdw1/blog/index.php?id=<?= $post->getId() ?>" class="btn btn-primary">Ver Postagem</a>
                </div>
            </div>
                <?php

            }

            $anterior = $pc - 1;
            $proximo = $pc + 1;
            echo "<br><div class='text-center'>";
            if ($pc > 1) {
                echo "<a href='perfil.php?page=" . $anterior . "' class='btn btn-primary m-2'><- Página Anterior</a>";
            }

            echo "<button type='button' class='btn btn-danger'>" . $pc . "</button>";

            if ($pc < $select[1]) {
                echo "<a href='perfil.php?page=" . $proximo . "' class='btn btn-primary m-2'>Próxima Página -></a>";
            }
            echo "</div>";
        } else {
            echo "<h3 class='container-fluid m-5'>Você não comentou em nem uma postagem!</h3>";
        }
        ?>
  </div>

  <div class="tab-pane fade" id="perfil" role="tabpanel" aria-labelledby="perfil-tab">
      <form method="post" action="Admin/gerenciarUsuario.php?action=update" class="p-5">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Nome</label>
      <input type="text" class="form-control" id="validationDefault02" placeholder="Nome" name="nome" value="<?= $user->getNome() ?>" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03">Sobrenome</label>
      <input type="text" class="form-control" id="validationDefault03" placeholder="Sobrenome" name="sobrenome" value="<?= $user->getSobrenome() ?>" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault04">Telefone</label>
      <input type="text" class="form-control" id="validationDefault04" placeholder="Telefone" name="telefone" value="<?= $user->getTelefone() ?>" required>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault05">Login</label>
      <input type="text" class="form-control" readonly id="validationDefault05" placeholder="Login" name="login" value="<?= $user->getLogin() ?>" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault06">Senha</label>
      <input type="password" class="form-control" id="validationDefault06" placeholder="Senha" name="senha" value="<?= $user->getSenha() ?>" required>
    </div>
  </div>
  <br>
    <button class="btn btn-primary" type="submit">Salvar</button>
</form>
  </div>
</div>

<?php
require_once $dir . '/blogdw1/footer.php';
?>