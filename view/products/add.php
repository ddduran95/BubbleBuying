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
        <h1><?= i18n("New Product")?></h1>
        <form enctype = "multipart/form-data" action="index.php?controller=products&amp;action=add" method="POST" class="formulario">
          <input type="hidden" name="MAX_FILE_SIZE" value="1000000" class="input" />

    	    <?= i18n("Title") ?>: <?= isset($errors["title"])?$errors["title"]:"" ?>
          <input type="text" name="title" class="input-form">


    	    <?= i18n("Short Description") ?>: <?= isset($errors["description"])?$errors["description"]:"" ?>
    	    <textarea name="description" rows="2" cols="20"></textarea>


          <?= i18n("Prize") ?>: <?= isset($errors["prize"])?$errors["prize"]:"" ?>
          <input type="number" name="prize" class="input-form">


          <?= i18n("Photo") ?>: <?= isset($errors["photo"])?$errors["photo"]:"" ?>
          <input type="file" name="photo" class="input-form">


    	    <input type="submit" name="submit" value="<?= i18n("Upload Product") ?>" class="btn-registro">
        </form>
    </div>
  </div>
</article>
