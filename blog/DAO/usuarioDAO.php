<?php

$dir = $_SERVER['DOCUMENT_ROOT'];
require_once $dir . '/blogdw1/dataBase.php';
require_once $dir . '/blogdw1/blog/Model/usuario.php';

function insertUsuario($usuario)
{
    $pdo = conectar();
  // Prepared Statement para evitar SQL injection
    $stmt = $pdo->prepare('INSERT INTO USUARIO (NOME, SOBRENOME, TELEFONE, LOGIN, SENHA) 
    VALUES (:nome, :sobrenome, :telefone, :login, :senha);');

  // Substitui os valores no SQL e já executa
    $stmt->execute(array(
        ':nome' => $usuario->getNome(),
        ':sobrenome' => $usuario->getSobrenome(),
        ':telefone' => $usuario->getTelefone(),
        ':login' => $usuario->getLogin(),
        ':senha' => $usuario->getSenha()
    ));
}

function updateUsuario($usuario)
{
    $pdo = conectar();
  // Prepared Statement para evitar SQL injection
    $stmt = $pdo->prepare('UPDATE USUARIO SET NOME = :nome, 
                                SOBRENOME = :sobrenome, 
                                TELEFONE = :telefone, 
                                LOGIN = :login, 
                                SENHA = :senha, 
                                ADMIN = :admin
                                 WHERE ID = :id;');

  // Substitui os valores no SQL e já executa
    $stmt->execute(array(
        ':id' => $usuario->getId(),
        ':nome' => $usuario->getNome(),
        ':sobrenome' => $usuario->getSobrenome(),
        ':telefone' => $usuario->getTelefone(),
        ':login' => $usuario->getLogin(),
        ':senha' => $usuario->getSenha(),
        ':admin' => $usuario->getAdmin()
    ));
}

function deleteUsuario($user)
{
    $pdo = conectar();
  // Prepared Statement para evitar SQL injection
    $stmt = $pdo->prepare('UPDATE USUARIO SET DELETADO = TRUE WHERE ID = :id;');

  // Substitui os valores no SQL e já executa
    $stmt->execute(array(
        ':id' => $user
    ));
}

function listarUsuario()
{
    $pdo = conectar();

    $stmt = $pdo->query('SELECT * FROM USUARIO WHERE DELETADO = FALSE ORDER BY ID DESC;');

    return $stmt;
}

function getUsuario($id)
{
    $pdo = conectar();
    $select = $pdo->query("SELECT * FROM USUARIO WHERE ID = " . $id . " AND DELETADO = FALSE;");

    $select = $select->fetch();

    $usuario = new Usuario();
    $usuario->setId($select['ID']);
    $usuario->setNome($select['NOME']);
    $usuario->setSobrenome($select['SOBRENOME']);
    $usuario->setTelefone($select['TELEFONE']);
    $usuario->setLogin($select['LOGIN']);
    $usuario->setSenha($select['SENHA']);
    $admin = $select['ADMIN'];
    $admin = $admin == 1 ? $usuario->setAdmin(true) : $usuario->setAdmin(false);

    return $usuario;
}

function verificaLogin($login, $senha)
{
    $pdo = conectar();
    $select = $pdo->query("SELECT * FROM USUARIO WHERE LOGIN = '" . $login . "' AND SENHA = '" . $senha . "' AND  DELETADO = FALSE;");

    $select = $select->fetch();
    if (!$select) {
        return false;
    } else {
        $usuario = new Usuario();
        $usuario->setId($select['ID']);
        $usuario->setNome($select['NOME']);
        $usuario->setSobrenome($select['SOBRENOME']);
        $usuario->setTelefone($select['TELEFONE']);
        $usuario->setLogin($select['LOGIN']);
        $usuario->setSenha($select['SENHA']);
        $usuario->setAdmin($select['ADMIN']);

        return $usuario;
    }
}
?>