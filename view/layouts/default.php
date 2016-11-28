<?php
 //file: view/layouts/default.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $currentuser = $view->getVariable("currentusername");

?><!DOCTYPE html>
<html>
  <head>
    <title><?= $view->getVariable("title", "no title") ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./iconos/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Josefin+Sans|Maven+Pro">
    <script src="index.js"></script>
    <?= $view->getFragment("css") ?>
    <?= $view->getFragment("javascript") ?>
  </head>
  <body>
    <!-- header -->
    <header>
      <div class="logo"></div>
      <div class = "bloque_header" >
        <a class= "btn_buscar" href="#"><i class="fa fa-search"></i></a>
        <input type="text" class = "buscar" placeholder= <?=i18n("search") ?>>
      </div>
      <div class = "bloque_header" >
          <!-- Boton si esta logeuado -->
      	<?php
        if (isset($_SESSION["currentuser"])):
      	// = sprintf(i18n("Hello %s"), $currentuser)
        ?>
      	  <a class = "entrar" href="index.php?controller=users&amp;action=logout"> <?= i18n("Logout") ?> </a>
          <!-- Boton si NO esta logeuado -->
      	<?php else: ?>
      	  <a class = "entrar" href="index.php?controller=users&amp;action=login"><?= i18n("Login") ?></a>
        <?php endif; ?>

          <div class="dropdown">
              <i class="fa fa-globe	 fa-2x dropbtn" aria-hidden="false"> </i>
              <div class="dropdown-content">
                 <a href="index.php?controller=language&amp;action=change&amp;lang=es"><?= i18n("Spanish") ?></a>
                <a href="index.php?controller=language&amp;action=change&amp;lang=en"><?= i18n("English") ?></a>
              </div>
          </div>
      </div>
    </header>
      <div id="flash">
	  <?= $view->popFlash() ?>
      </div>
      <?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
  </body>
</html>
