    <?php
    $dir = $_SERVER['DOCUMENT_ROOT'];

    if (!isset($_SESSION)) session_start();

    if (isset($_GET["logout"])) {
      require_once $dir . "/blogdw1/blog/login.php";

      logout();
    }
    ?>
    <div class="fixed-top">
      <nav
        class="navbar navbar-expand-lg navbar-dark bg-dark"
      >
        <a class="navbar-brand" href="<? $dir ?>/blogdw1/index.php">Daciblogo
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
              <a class="nav-link" href="<? $dir ?>/blogdw1/conheca.php">Conheça Daciolo<span class="sr-only">(current)</span></a
              >
            </li>
            <li class="nav-item"><a class="nav-link" href="<? $dir ?>/blogdw1/eventos/index.php">Eventos</a></li>
            <li class="nav-item  dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                Planos illuminati
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<? $dir ?>/blogdw1/ursal.php">Ursal</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Maçonaria</a>
              </div>
            </li>

            <li class="nav-item "><a class="nav-link" href="#">Contato</a></li>
            <li class="nav-item "><a class="nav-link" href="<? $dir ?>/blogdw1/blog/index.php">Blog</a></li>

            <?php

            if (!isset($_SESSION['UsuarioID'])) {
              session_destroy();
              ?>

              <li class="nav-item  dropdown">
              <a
                class="nav-link dropdown-toggle"
                href="#"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                Entrar
              </a>
              <div id="formLogin" class="dropdown-menu">
                <form class="px-4 py-3 " method="post" action="<? $dir ?>/blogdw1/blog/login.php">
                  <div class="form-group">
                    <label for="login"
                      >Login</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="login"
                      placeholder="Login"
                      name="login"/>
                  </div>
                  <div class="form-group">
                    <label for="senha">Senha</label>
                    <input
                      type="password"
                      class="form-control"
                      id="senha"
                      placeholder="Senha"
                      name="senha"/>
                  </div>
                  <div class="form-check">
                    <input
                      type="checkbox"
                      class="form-check-input"
                      id="dropdownCheck"
                    />
                    <label class="form-check-label" for="dropdownCheck">
                      Lembrar
                    </label>
                  </div>
                  <button type="submit" class="btn btn-primary">Entrar</button>
                </form>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<? $dir ?>/blogdw1/blog/index.php?cadastrar=true"
                  >Cadastrar</a
                >
              </div>
            </li>

            <?php

          } else
            if (isset($_SESSION['UsuarioID'])) {
            if ($_SESSION['UsuarioAdmin'] == 1) {
              ?>
                <li class="nav-item "><a class="nav-link" href="<? $dir ?>/blogdw1/blog/Admin/admin.php">Painel Admin</a></li>
                <li class="nav-item "><a class="nav-link" href="<? $dir ?>/blogdw1/blog/perfil.php">Perfil</a></li>
              <?php

            } else {
              ?>
                <li class="nav-item "><a class="nav-link" href="<? $dir ?>/blogdw1/blog/perfil.php">Perfil</a></li>
              <?php

            }
            ?>
              <li class="nav-item "><a class="nav-link" href="<? $dir ?>/blogdw1/index.php?logout=true">Sair</a></li>
            <?php

          }
          ?>

          </ul>
          <form class="form-inline my-2 my-lg-0" method="post" action="<? $dir ?>/blogdw1/blog/pesquisa.php">
            <input
              class="form-control mr-sm-2"
              type="search"
              id="tituloDaPostagem"
              name="tituloDaPostagem"
              placeholder="Busque a Deus"
              aria-label="Search"
            />
            <button class="btn btn-outline-info my-2 my-sm-0" type="submit">
            Procurar versículo              
            </button>
          </form>
        </div>
        </nav>
                                <?php 
                                if (isset($_GET["msg"])) {
                                  echo "<div class='alert alert-danger text-center alert-dismissible fade show' role='alert'>" . $_GET["msg"];
                                  echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" . "</div>";
                                }

                                if (isset($_GET["msg2"])) {
                                  echo "<div class='alert alert-primary text-center alert-dismissible fade show' role='alert'>" . $_GET["msg2"];
                                  echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" . "</div>";
                                }

                                if (isset($_GET["msg3"])) {
                                  echo "<div class='alert alert-danger text-center alert-dismissible fade show' role='alert'>" . $_GET["msg3"];
                                  echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" . "</div>";
                                }

                                if (isset($_GET["msg4"])) {
                                  echo "<div class='alert alert-primary text-center alert-dismissible fade show' role='alert'>" . $_GET["msg4"];
                                  echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" . "</div>";
                                }

                                if (isset($_GET["msg5"])) {
                                  echo "<div class='alert alert-primary text-center alert-dismissible fade show' role='alert'>" . $_GET["msg5"];
                                  echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" . "</div>";
                                }
                                ?>

                                
  </div>