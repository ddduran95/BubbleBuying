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
          <p><?=$product->getPhoto() ?></p>
        			<p class = "precio"> <?=$product->getPrize() ?>€</p>
        			<p class = "titulo"> <?=$product->getTitle() ?></p>
        			<p class = "descripcion"> <?php echo substr($product->getDescription(),0,24); ?>...</p>
        </div>


    		<?php
    		//show actions ONLY for the author of the post (if logged)

    		if (isset($currentuser) && $currentuser == $product->getAuthor()->getUsername()): ?>

    		  <?php
    		  // 'Delete Button': show it as a link, but do POST in order to preserve
    		  // the good semantic of HTTP
    		  ?>
        <?php endif; ?>

      </div>
    </article>

  </body>
  </html>
