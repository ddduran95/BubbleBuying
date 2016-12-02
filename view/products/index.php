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

        <a class="btn_producto" href="index.php?controller=products&amp;action=view&amp;id=<?= $product->getId() ?>">
            <div class="cuadro_producto">
        			<img class="img-product" src="imgs/producto/<?=$product->getPhoto() ?>">
        			<p class = "precio"> <?=$product->getPrize() ?>€</p>
        			<p class = "titulo"> <?=$product->getTitle() ?></p>
        			<p class = "descripcion"> <?php echo substr($product->getDescription(),0,24); ?>...</p>
                <a class="btn_categoria" href="#">
                  <div class="categorias">

        			         <div class = "categoria"><i class="fa fa-tag"></i> <?=i18n($product->getCategory()) ?> </div>
                    </div>
                </a>
                <a class="btn_vendedor" href="index.php?controller=products&amp;action=viewMyProducts&amp;alias=<?=$product->getSeller()->getAlias() ?>">
                  <div class = "cuadro_vendedor">
                      <div class = "texto_vendedor">
                        <?php if ($product->getSeller()->getPhoto() == NULL){ ?>
                          <img class="img-seller" src = "imgs/perfil/predeterminado.jpg" >
                        <?php }else{ ?>
                          <img class="img-seller" src = "imgs/perfil/<?=$product->getSeller()->getPhoto() ?>">
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

      <?php endforeach; ?>

      </div>
    </article>

  </body>
  </html>
