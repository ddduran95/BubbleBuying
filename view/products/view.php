<?php
 //file: view/posts/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $products = $view->getVariable("products");
 $currentuser = $view->getVariable("currentusername");

 $view->setVariable("title", "Products");
?>

<html lang="en">
  <body>

    <article id = "maincontent">
      <div class = "main">
      <?php foreach ($products as $product): ?>

        <a class="btn_producto" href="#">
            <div class="cuadro_producto">
        			<img class="img-product" src="imgs/producto/<?=$product->getPhoto() ?>">
        			<p class = "precio"> <?=$product->getPrize() ?>€</p>
        			<p class = "titulo"> <?=$product->getTitle() ?></p>
        			<p class = "descripcion"> <?php echo substr($product->getDescription(),0,24); ?>...</p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">
        			         <div class = "categoria"><i class="fa fa-tag"></i> cosas de casa </div>
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
