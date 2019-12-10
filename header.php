<?php
$dir = $_SERVER['DOCUMENT_ROOT'];
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="<? $dir ?>/blogdw1/blog/public/styles/css/style.css"
    />

    

    <title>Daciolo</title>

    <?php

    if (!isset($_SESSION)) session_start();

    if (isset($_GET["logout"])) {
      require_once "login.php";

      logout();
    }

    ?>

 </head>

  <body>
    <?php

    $dir = $_SERVER['DOCUMENT_ROOT'];

    require_once $dir . '/blogdw1/menu.php';
    ?>
        <div class="header">
          <h1 class="header__title">DACIBLOGO</h1>
        </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8 mainblog">