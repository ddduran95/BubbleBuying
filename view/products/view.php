<?php
 //file: view/posts/index.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $product = $view->getVariable("product");
 $currentuser = $view->getVariable("currentusername");
 $view->setVariable("title", "Product");
?>

<html lang="en">
  <body>

    <article id = "maincontent">
      <div class = "main">

        <img class="view-photo" src="imgs/producto/<?=$product->getPhoto() ?>">
        <div class="view-info">
          <div class="product-info">
            <p class = "titulo view-tittle"> <?=$product->getTitle() ?></p>
          	<p class = "precio view-prize"> <?=$product->getPrize() ?>€</p>
          	<p class = "descripcion view-description"> <?=$product->getDescription() ?></p>
          </div>
          <div class="product-info seller-product">
            <a href="index.php?controller=products&amp;action=viewMyProducts&amp;alias=<?=$product->getSeller()->getAlias() ?>">
              <div class="view-seller">
                    <?php if ($product->getSeller()->getPhoto() == NULL){ ?>
                      <img class="seller-info" src = "imgs/perfil/predeterminado.jpg" >
                    <?php }else{ ?>
                      <img class="seller-info" src = "imgs/perfil/<?=$product->getSeller()->getPhoto() ?>">
                    <?php } ?>
                    <strong> <?=$product->getSeller()->getAlias() ?></strong>
              </div>
            </a>
            <form name = "searching" class = "bloque_header" action="index.php?controller=products&amp;action=index" method="POST">

              <input name="product" type="hidden" value="<?=$product->getId() ?>">
              <input name="vendedor" type="hidden" value="<?=$product->getSeller()->getAlias() ?>">
              <input name="comprador" type="hidden" value="<?=$currentusername ?>">
              <a onclick="searching.submit()">
                <div class="btn-chat">
                  <p><i class="fa fa-comments" aria-hidden="true"></i>Chat</p>
                </div>
              </a>
            </form>
          </div>
        </div>



      </div>
    </article>

  </body>
  </html>
