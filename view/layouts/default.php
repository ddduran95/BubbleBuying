<?php
 //file: view/layouts/default.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $currentuser = $view->getVariable("currentusername");

?>
<!DOCTYPE html>
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
      <a class="logo" href="index.php?controller=products&amp;action=index"></a>
      <form name = "searching" class = "bloque_header" action="index.php?controller=products&amp;action=index" method="POST">
        <a class= "btn_buscar" onclick="searching.submit()"><i class="fa fa-search"></i></a>
        <input name="search" type="text" class = "buscar" placeholder= <?=i18n("search") ?>>
      </form>
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
          <?php
          if (isset($_SESSION["currentuser"])):
          ?>
          <li> <a class="btn_menu prioridad_1" href="index.php?controller=users&amp;action=view"><i class="fa fa-user"></i> <?= i18n("My Profile") ?></a></li>
    			<li> <a class="btn_menu prioridad_1" href="index.php?controller=products&amp;action=viewMyProducts"><i class="fa fa-archive"></i> <?= i18n("My Products") ?></a></li>
    			<li> <a class="btn_menu prioridad_1" href="index.php?controller=products&amp;action=add"><i class="fa fa-arrow-up"></i> <?= i18n("New Product") ?></a></li>
    			<li> <a class="btn_menu prioridad_1" href="#"><i class="fa fa-comments"></i> <?= i18n("My Chats") ?></a></li>
          <?php
        endif;
          ?>
    			<li id="categoriasmenuitem"><a class= "btn_menu prioridad_1" href="#"><i class="fa fa-chevron-down"></i> <?= i18n("Categories") ?></a>

				<ul>
					<li><a class= "btn_menu prioridad_2" href="index.php?controller=products&amp;action=index&amp;category=Tecnologia"><i class="fa fa-laptop"></i> <?= i18n("Tecnology") ?> </a></li>
					<li><a class= "btn_menu prioridad_2" href="index.php?controller=products&amp;action=index&amp;category=Libros"><i class="fa fa-book"></i> <?= i18n("Books") ?> </a></li>
					<li><a class= "btn_menu prioridad_2" href="index.php?controller=products&amp;action=index&amp;category=Cosas de casa"><i class="fa fa-home"></i> <?= i18n("Home") ?> </a></li>
					<li><a class= "btn_menu prioridad_2" href="index.php?controller=products&amp;action=index&amp;category=Videojuegos"><i class="fa fa-gamepad"></i> <?= i18n("Videogames") ?> </a></li>
					<li><a class= "btn_menu prioridad_2" href="index.php?controller=products&amp;action=index&amp;category=Niños"><i class="fa fa-child"></i> <?= i18n("Children") ?> </a></li>
					<li><a class= "btn_menu prioridad_2" href="index.php?controller=products&amp;action=index&amp;category=Electrodomesticos"><i class="fa fa-plug "></i> <?= i18n("Home Appliances") ?> </a></li>
					<li><a class= "btn_menu prioridad_2" href="index.php?controller=products&amp;action=index&amp;category=Ropa"><i class="fa fa-suitcase "></i> <?= i18n("Clothing") ?> </a></li>
					<li><a class= "btn_menu prioridad_2" href="index.php?controller=products&amp;action=index&amp;category=Motor"><i class="fa fa-car "></i> <?= i18n("Motor") ?> </a></li>
					<li><a class= "btn_menu prioridad_2" href="index.php?controller=products&amp;action=index&amp;category=Deporte"><i class="fa fa-futbol-o "></i> <?= i18n("Sport") ?> </a></li>
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
