        <?php
        $dir = $_SERVER['DOCUMENT_ROOT'];


        if (!isset($_SESSION))
            session_start();



        require_once $dir . '/blogdw1/blog/Model/usuario.php';
        require_once $dir . '/blogdw1/blog/DAO/usuarioDAO.php';
        require_once $dir . '/blogdw1/blog/DAO/comentarioDAO.php';
        require_once $dir . '/blogdw1/blog/DAO/postagemDAO.php';

        $user = new Usuario();
        $user = getUsuario($_SESSION['UsuarioID']);

        $pc;
        if (!isset($_GET['page'])) {
            $pc = "1";
        } else {
            $pc = $_GET["page"];
        }

        $select = readComentsUserPage($pc, $user);
        $count = (int)$select[0]->fetch(PDO::FETCH_ASSOC);
        if ($count == 0) {
            while ($linha = $select[0]->fetch(PDO::FETCH_ASSOC)) {

                $post = new Post();
                $post = getPost($linha['IDPOSTAGEM']);

                ?>
            <div><?= "Titulo da postagem: " . $post->getTitulo() ?></div>
            <div class="card bg-dark border-light text-center ml-5 mt-3 mb-3">
                <div class="card-header bg-light">
                        <?php $autor = getUsuario($linha['AUTOR']); ?>
                        <h4><?= "Autor: " . $autor->getNome() ?></h4>
                </div>
                <div class="card-body bg-light">
                        <ul class="list-unstyled text-white text-muted">
                            <?= $linha['TEXTO'] ?>
                        </ul>
                </div>
                <div class="card-footer bg-light">
                        <ul class="list-unstyled text-white text-muted">
                            <b><?= "Postado em: ", $linha['DATA'] ?></b>
                        </ul>
                </div>
            </div>
                <?php

            }

            $anterior = $pc - 1;
            $proximo = $pc + 1;
            echo "<div class='text-center'>";
            if ($pc > 1) {
                echo "<a href='perfil.php#comments?&page=" . $anterior . "' class='btn btn-primary m-2'><- Página Anterior</a>";
            }

            echo "<button type='button' class='btn btn-danger'>" . $pc . "</button>";

            if ($pc < $select[1]) {
                echo "<a href='perfil.php#comments?page=" . $proximo . "' class='btn btn-primary m-2'>Próxima Página -></a>";
            }
            echo "</div>";
        } else {
            echo "Você não comentou em nem uma postagem!";
        }
        ?>