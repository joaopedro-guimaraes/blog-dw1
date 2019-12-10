<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
require_once $dir . '/blogdw1/dataBase.php';
require_once $dir . '/blogdw1/blog/Model/post.php';

function insertPost($post)
{
  $pdo = conectar();
  // Prepared Statement para evitar SQL injection
  $stmt = $pdo->prepare('INSERT INTO POSTAGEM(TITULO, TEXTO, AUTOR) VALUES(:titulo, :texto, :autor);');

  // Substitui os valores no SQL e já executa
  $stmt->execute(array(
    ':titulo' => $post->getTitulo(),
    ':texto' => $post->getTexto(),
    ':autor' => $post->getAutor()
  ));
}

function updatePost($post)
{
  $pdo = conectar();
  // Prepared Statement para evitar SQL injection
  $stmt = $pdo->prepare('UPDATE POSTAGEM SET TITULO = :titulo, TEXTO = :texto, AUTOR = :autor WHERE ID = :id;');

  // Substitui os valores no SQL e já executa
  $stmt->execute(array(
    ':titulo' => $post->getTitulo(),
    ':texto' => $post->getTexto(),
    ':autor' => $post->getAutor(),
    ':id' => $post->getId()
  ));
}

function getPost($id)
{
  $pdo = conectar();

  $stmt = $pdo->query('SELECT * FROM POSTAGEM WHERE ID=' . $id . " AND DELETADO = FALSE;");

  $select = $stmt->fetch();

  $post = new Post();
  $post->setId($select['ID']);
  $post->setTitulo($select['TITULO']);
  $post->setAutor($select['AUTOR']);
  $post->setTexto($select['TEXTO']);
  $post->setData($select['DATA']);

  return $post;
}


function readPost()
{
  $pdo = conectar();

  $stmt = $pdo->query('SELECT * FROM POSTAGEM WHERE DELETADO = FALSE ORDER BY DATA DESC;');

  return $stmt;
}

function readPagePosts($pc)
{
  $total_reg = "3";

  $inicio = $pc - 1;

  $inicio = $inicio * $total_reg;

  $pdo = conectar();

  $stmt = $pdo->query('SELECT * FROM POSTAGEM WHERE DELETADO = FALSE ORDER BY DATA DESC LIMIT ' . $inicio . ', ' . $total_reg . ';');

  $todos = readPost();

  $tr = $todos->rowCount(); // verifica o número total de registros

  $tp = $tr / $total_reg; // verifica o número total de páginas

  return $array = array($stmt, $tp);
}

function readPagePostsWanted($pc, $title)
{
  $total_reg = "3";

  $inicio = $pc - 1;

  $inicio = $inicio * $total_reg;
  
  $pdo = conectar();  
  $stmt = $pdo->query("SELECT * FROM POSTAGEM WHERE UPPER(TITULO) LIKE '%"  . strtoupper($title)  . "%' AND DELETADO = FALSE ORDER BY DATA DESC LIMIT " . $inicio . ', ' . $total_reg . ';');
   
  $tp = $stmt->rowCount() / $total_reg; // verifica o número total de páginas

  return $array = array($stmt, $tp);
}

function deletePost($post)
{
  $pdo = conectar();
  // Prepared Statement para evitar SQL injection
  $stmt = $pdo->prepare('UPDATE POSTAGEM SET DELETADO = TRUE WHERE ID = :id;');

  // Substitui os valores no SQL e já executa
  $stmt->execute(array(
    ':id' => $post
  ));
}



?>