<?php
 //file: view/products/add.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $product = $view->getVariable("product");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "New Product");

?>
<article id = "maincontent">
  <div class = "main">
    <div class = "add-product">
        <h1><?= i18n("New product")?></h1>
        <form enctype = "multipart/form-data" action="index.php?controller=products&amp;action=add" method="POST" class="formulario">
          <input type="hidden" name="MAX_FILE_SIZE" value="1000000" class="input" />

    	    <?= i18n("Title") ?>: <input type="text" name="title" class="input-form">
    	    <?= isset($errors["title"])?$errors["title"]:"" ?>

    	    <?= i18n("Description") ?>: <br>
    	    <textarea name="description" rows="4" cols="50"></textarea>
    	    <?= isset($errors["description"])?$errors["description"]:"" ?>

          <?= i18n("Prize") ?>: <input type="number" name="prize" class="input-form">
    	    <?= isset($errors["prize"])?$errors["prize"]:"" ?>

          <?= i18n("Photo") ?>: <input type="file" name="photo" class="input-form">
    	    <?= isset($errors["photo"])?$errors["photo"]:"" ?>

    	    <input type="submit" name="submit" value="<?= i18n("Upload Product") ?>" class="btn-registro">
        </form>
    </div>
  </div>
</article>
