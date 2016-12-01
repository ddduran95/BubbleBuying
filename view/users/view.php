<?php
 //file: view/products/add.php
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();

 $user = $view->getVariable("user");
 $errors = $view->getVariable("errors");

 $view->setVariable("title", "My Profile");

?>
<article id = "maincontent">
  <div class = "main">
    <div class = "product-view ">
        <h1><?= i18n("My Profile")?></h1>

        <div class="view-form">
          <div class="user-data">
              <label><?= i18n("Name") ?>:</label>
              <p><?= $user->getName() ?></p>
              <label><?= i18n("Alias") ?>:</label>
              <p><?= $user->getAlias() ?></p>
          </div>
          <div class="user-data user-photo">
            <?php if ($user->getPhoto() == NULL){ ?>
              <img src = "imgs/perfil/predeterminado.jpg" height="200" width="200" >
            <?php }else{ ?>
              <img src = "imgs/perfil/<?=$user->getPhoto() ?>" height="200" width="200" style="border-radius: 100%; border: 1px solid white">
            <?php } ?>
            <form enctype = "multipart/form-data" action="index.php?controller=users&amp;action=view" method="POST" class="formulario ">
              <input type="hidden" name="MAX_FILE_SIZE" value="1000000" class="input" />

                <?= i18n("Upload a new profile photo") ?>: <input type="file" name="photo" value="imgs/perfil/<?=$user->getPhoto() ?>" class="input-form">
                <?= isset($errors["photo"])?$errors["photo"]:"" ?>
        	    <input type="submit" name="submit" value="<?= i18n("Save Photo") ?>" class="btn-registro">
            </form>

          </div>
        </div>

    </div>
  </div>
</article>
