<?php
if (!isset($_SESSION)) session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dir = $_SERVER['DOCUMENT_ROOT'];
    require_once $dir . "/blogdw1/blog/DAO/usuarioDAO.php";
    $msg4 = "Cadastrado com sucesso!";
    $msg5 = "Perfil atualizado com sucesso!";

    if ($_GET['action'] == 'create') {
        $user = new Usuario();
        $user->setNome($_POST["nome"]);
        $user->setSobrenome($_POST["sobrenome"]);
        $user->setTelefone($_POST["telefone"]);
        $user->setLogin($_POST["login"]);
        $user->setSenha($_POST["senha"]);
        insertUsuario($user);
        header("Location:../index.php?msg4=" . $msg4);

    }
    if ($_GET['action'] == 'update') {
        $user = new Usuario();
        $user->setId($_SESSION["UsuarioID"]);
        $user->setNome($_POST["nome"]);
        $user->setSobrenome($_POST["sobrenome"]);
        $user->setTelefone($_POST["telefone"]);
        $user->setLogin($_POST["login"]);
        $user->setSenha($_POST["senha"]);
        $user->setAdmin($_SESSION["UsuarioAdmin"]);
        updateUsuario($user);
        header("Location:../perfil.php?msg5=" . $msg5);
    }
}
?>