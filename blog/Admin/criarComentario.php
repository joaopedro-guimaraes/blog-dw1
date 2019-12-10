<?php

if (!isset($_SESSION))
    session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dir = $_SERVER['DOCUMENT_ROOT'];
    require_once $dir . "/blogdw1/blog/DAO/comentarioDAO.php";
    require_once $dir . "/blogdw1/blog/Model/comentario.php";

    $comment = new Comentario();
    $comment->setAutor($_SESSION['UsuarioID']);
    $comment->setTexto($_POST["texto"]);
    $comment->setIdPost($_POST["idPost"]);
    insertComentario($comment);
    header("Location:../index.php?id=" . $_POST["idPost"]);
}
?>