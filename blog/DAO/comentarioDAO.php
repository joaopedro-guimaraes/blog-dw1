<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
require_once $dir . '/blogdw1/dataBase.php';
require_once $dir . '/blogdw1/blog/Model/comentario.php';

function insertComentario($comment)
{
    $pdo = conectar();
  // Prepared Statement para evitar SQL injection
    $stmt = $pdo->prepare('INSERT INTO COMENTARIO(AUTOR, TEXTO, IDPOSTAGEM) VALUES (:autor, :texto, :idpost);');

  // Substitui os valores no SQL e já executa
    $stmt->execute(array(
        ':autor' => $comment->getAutor(),
        ':texto' => $comment->getTexto(),
        ':idpost' => $comment->getIdPost()
    ));
}

function updateComentario($post)
{
    $pdo = conectar();
  // Prepared Statement para evitar SQL injection
    $stmt = $pdo->prepare('UPDATE COMENTARIO SET AUTOR = :autor, TEXTO = :texto, IDPOSTAGEM = :idPost WHERE ID = :id;');

  // Substitui os valores no SQL e já executa
    $stmt->execute(array(
        ':autor' => $comment->getAutor(),
        ':texto' => $comment->getTexto(),
        ':idPost' => $comment->getIdPost(),
        ':id' => $comment->getId()
    ));
}

function getComentario($id)
{
    $pdo = conectar();

    $stmt = $pdo->query('SELECT * FROM COMENTARIO WHERE ID=' . $id . " AND DELETADO = FALSE;");

    $select = $stmt->fetch();

    $comment = new Comentario();
    $comment->setId($select['ID']);
    $comment->setAutor($select['AUTOR']);
    $comment->setTexto($select['TEXTO']);
    $comment->setData($select['DATA']);
    $comment->setIdPost($select['IDPOSTAGEM']);

    return $comment;
}

function deleteComentario($id)
{
    $pdo = conectar();
  // Prepared Statement para evitar SQL injection
    $stmt = $pdo->prepare('UPDATE COMENTARIO SET DELETADO = TRUE WHERE ID = :id;');

  // Substitui os valores no SQL e já executa
    $stmt->execute(array(
        ':id' => $id
    ));
}

function readComentarios($id)
{
    $pdo = conectar();

    $stmt = $pdo->query('SELECT * FROM COMENTARIO WHERE IDPOSTAGEM =' . $id . ' AND DELETADO = FALSE;');

    return $stmt;
}

function readUserComentarios($id)
{
    $pdo = conectar();

    $stmt = $pdo->query('SELECT * FROM COMENTARIO WHERE AUTOR = ' . $id . ' AND DELETADO = FALSE;');

    return $stmt;
}

function readPageComents($pc, $idPost)
{
    $total_reg = "3";

    $inicio = $pc - 1;

    $inicio = $inicio * $total_reg;

    $pdo = conectar();

    $stmt = $pdo->query('SELECT * FROM COMENTARIO WHERE DELETADO = FALSE ORDER BY DATA DESC LIMIT ' . $inicio . ', ' . $total_reg . ';');

    $todos = readComentarios($idPost);

    $tr = $todos->rowCount(); // verifica o número total de registros

    $tp = $tr / $total_reg; // verifica o número total de páginas

    return $array = array($stmt, $tp);
}

function readComentsUserPage($pc, $user)
{
    $total_reg = "3";

    $inicio = $pc - 1;

    $inicio = $inicio * $total_reg;

    $pdo = conectar();

    $stmt = $pdo->query('SELECT * FROM COMENTARIO WHERE AUTOR = ' . $user->getId() . ' AND DELETADO = FALSE ORDER BY DATA DESC LIMIT ' . $inicio . ', ' . $total_reg . ';');

    $todos = readUserComentarios($user->getId());

    $tr = $todos->rowCount(); // verifica o número total de registros

    $tp = $tr / $total_reg; // verifica o número total de páginas

    return $array = array($stmt, $tp);
}

?>