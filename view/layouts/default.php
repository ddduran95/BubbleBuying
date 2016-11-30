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
    <nav id="mainnavigation">
        <ul>
          <li> <a class="btn_menu prioridad_1" href="#"><i class="fa fa-user"></i> Mi Perfil</a></li>
    			<li> <a class="btn_menu prioridad_1" href="index.php?controller=products&amp;action=view"><i class="fa fa-archive"></i> Mis Productos</a></li>
    			<li> <a class="btn_menu prioridad_1" href="index.php?controller=products&amp;action=add"><i class="fa fa-arrow-up"></i> Subir Producto</a></li>
    			<li> <a class="btn_menu prioridad_1" href="#"><i class="fa fa-comments"></i> Mis Chats</a></li>
    			<li id="categoriasmenuitem"><a class= "btn_menu prioridad_1" href="#"><i class="fa fa-chevron-down"></i> Categorías</a>
				<ul>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-laptop"></i> Tecnologia </a></li>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-book"></i> Libros </a></li>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-home"></i> Cosas de casa </a></li>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-gamepad"></i> Consolas </a></li>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-child"></i> Niños </a></li>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-plug "></i> Electrodomesticos </a></li>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-suitcase "></i> Ropa </a></li>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-car "></i> Motor </a></li>
					<li><a class= "btn_menu prioridad_2" href="#"><i class="fa fa-futbol-o "></i> Deporte </a></li>
				</ul>
			</li>
		</ul>
    </nav>
      <div id="flash">
	  <?= $view->popFlash() ?>
      </div>
      <?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
  </body>
</html>
