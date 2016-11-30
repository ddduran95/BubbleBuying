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
        			<img src="imgs/producto/<?=$product->getPhoto() ?>" height="150" width="150" style="border-top-left-radius:7px;border-top-right-radius:7px">
        			<p class = "precio"> <?=$product->getPrize() ?>€</p>
        			<p class = "titulo"> <?=$product->getTitle() ?></p>
        			<p class = "descripcion"> <?php echo substr($product->getDescription(),0,24); ?>...</p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">
        			         <div class = "categoria"><i class="fa fa-tag"></i> cosas de casa </div>
                    </div>
                </a>
                <a class="btn_vendedor" href="#">
                  <div class = "cuadro_vendedor">
                      <div class = "texto_vendedor">
                        <?php if ($product->getSeller()->getPhoto() == NULL){ ?>
                          <img src = "imgs/perfil/predeterminado.jpg" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
                        <?php }else{ ?>
                          <img src = "imgs/perfil/<?=$product->getSeller()->getPhoto() ?>" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
                        <?php } ?>
                      </div>
                      <div class = "texto_vendedor">
                        <strong> <?=$product->getSeller()->getAlias() ?></strong>
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
