<?php

// Constantes do servidor e do banco de dados
define('S_SERVIDOR', 'localhost');
define('BD_USUARIO', 'root');
define('BD_SENHA', '');
define('BD_BASEDEDADOS', 'BLOGDW1');

// Link explicando certinho o que é PDO e como usar: https://www.devmedia.com.br/crud-com-php-pdo/28873

function conectar()
{
  $pdo = null;
  try {
    // Criando objeto PDO
    $pdo = new PDO('mysql:host=' . S_SERVIDOR . ';dbname=' . BD_BASEDEDADOS, BD_USUARIO, BD_SENHA);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
  finally {
    return $pdo;
  }
}

// Exemplo de uso
/*
try {
  // Criando um objeto PDO
  $pdo = new PDO('mysql:host='.S_SERVIDOR.';dbname='.BD_BASEDEDADOS, BD_USUARIO, BD_SENHA);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Prepared Statement para evitar SQL injection
  $stmt = $pdo->prepare('UPDATE USUARIO SET NOME = :nome, SOBRENOME = :sobrenome WHERE id = 1');

  // Substitui os valores no SQL e já executa
  $stmt->execute(array(
    ':nome' => 'Cabo',
    ':sobrenome' => 'Daciolo'
  ));

  // Numero de linhas percorridas no banco
  echo $stmt->rowCount();
} catch(PDOException $e) {
  echo 'Error: '. $e->getMessage();
}

 */

?>