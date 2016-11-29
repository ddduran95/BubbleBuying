<?php
 //file: view/posts/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $products = $view->getVariable("products");
 $currentuser = $view->getVariable("currentusername");

 $view->setVariable("title", "Products");
?>
<!DOCTYPE html>
<html lang="en">
  <!-- head-->
  <head>
    <title>Buying Bubble</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./iconos/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Maven+Pro" rel="stylesheet">
	<script src="index.js"></script>
  </head>
  <body>

    <article id = "maincontent">
      <div class = "main">
      <?php foreach ($products as $product): ?>

        <a class="btn_producto" href="#">
            <div class="cuadro_producto">
        			<img src="imgs/taza.jpg" height="150" width="150" style="border-top-left-radius:7px;border-top-right-radius:7px">
        			<p class = "precio"> <?=$product->getPrecio() ?></p>
        			<p class = "titulo"> <?=$product->getTitulo() ?></p>
        			<p class = "descripcion"> <?=$product->getDescripcion() ?></p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">
        			         <div class = "categoria"><i class="fa fa-tag"></i> cosas de casa </div>
                    </div>
                </a>
                <a class="btn_vendedor" href="#">
                  <div class = "cuadro_vendedor">
                      <div class = "texto_vendedor">
                        <img src = "imgs/luky.png" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
                      </div>
                      <div class = "texto_vendedor">
                        <strong> <?=$product->getVendedor()->getAlias() ?></strong>
                        <div> 32 productos </div>
                      </div>
                  </div>
                </a>
            </div>
        </a>

    		<?php
    		//show actions ONLY for the author of the post (if logged)

    		if (isset($currentuser) && $currentuser == $product->getAuthor()->getUsername()): ?>

    		  <?php
    		  // 'Delete Button': show it as a link, but do POST in order to preserve
    		  // the good semantic of HTTP
    		  ?>
        <?php endif; ?>
      <?php endforeach; ?>

      </div>
    </article>

  </body>
  </html>
