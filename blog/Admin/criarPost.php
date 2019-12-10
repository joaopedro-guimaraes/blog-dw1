<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Olá, mundo!</title>

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
<div class="container">
        <div class="card bg-white border-light text-center ml-5 mt-3 mb-3">
        <h4 class="text-center">Criar Postagem</h4>
        <form method="post" action="update.php?acao=criarPost" class="p-5 text-center">
            <div class="form-row">
                <div class="col-md-12 mb-3 text-center">
                    <label for="validationDefault02">Autor</label>
                    <input type="text" class="form-control text-center" id="validationDefault02" readonly placeholder="Autor" value="<?= $_SESSION["UsuarioNome"] ?>" name="autor" required>
                </div>
                <div class="col-md-12 mb-3 text-center">
                    <label for="validationDefault02">Titulo</label>
                    <input type="text" class="form-control text-center" id="validationDefault02" placeholder="Titulo" name="titulo" required>
                </div>
            </div>
        <div class="form-row">
            <div class="col-md-12 mb-3 text-center">
                <label for="validationDefault05">Texto</label>
                <textarea class="form-control" id="validationDefault05" placeholder="Texto" name="texto" required></textarea>
            </div>
        </div>
        <br>
        <button class="btn btn-primary" type="submit">Postar</button>
        <button class="btn btn-primary" type="reset">Limpar</button>
        <a href='admin.php?acao=posts' class='btn btn-primary'>Voltar</a>
        </form>
        </div>
    </div>

        <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>