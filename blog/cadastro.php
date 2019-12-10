<?php

function cadastrar()
{
  ?>
<div class="container">

<div class="card bg-white border-light text-center ml-5 mt-3 mb-3">
      <h4>Cadastro de Usuario</h4>
<form method="post" action="Admin/gerenciarUsuario.php?action=create" class="p-5">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault02">Nome</label>
      <input type="text" class="form-control" id="validationDefault02" placeholder="Nome" name="nome" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault03">Sobrenome</label>
      <input type="text" class="form-control" id="validationDefault03" placeholder="Sobrenome" name="sobrenome" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault04">Telefone</label>
      <input type="text" class="form-control" id="validationDefault04" placeholder="Telefone" name="telefone" required>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault05">Login</label>
      <input type="text" class="form-control" id="validationDefault05" placeholder="Login" name="login" required>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefault06">Senha</label>
      <input type="password" class="form-control" id="validationDefault06" placeholder="Senha" name="senha" required>
    </div>
  </div>
  <br>
    <button class="btn btn-primary" type="submit">Cadastrar</button>
    <button class="btn btn-primary" type="reset">Limpar</button>
</form>
</div>
</div>

<?php 
}

?>