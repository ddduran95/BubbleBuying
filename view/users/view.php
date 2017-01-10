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
          <div class=" user-photo">
            <?php if ($user->getPhoto() == NULL){ ?>
              <img class="img-profile" src = "imgs/perfil/predeterminado.jpg">
            <?php }else{ ?>
              <img class="img-profile" src = "imgs/perfil/<?=$user->getPhoto() ?>" >
            <?php } ?>
            <form enctype = "multipart/form-data" action="index.php?controller=users&amp;action=view" method="POST" class="formulario ">
              <input type="hidden" name="MAX_FILE_SIZE" value="1000000" class="input" />
                <?= i18n("Upload a new profile photo") ?>: <input type="file" name="photo" value="imgs/perfil/<?=$user->getPhoto() ?>" class="input-form" required="true">
                <?= isset($errors["photo"])?$errors["photo"]:"" ?>
        	    <input type="submit" name="submit" value="<?= i18n("Save Photo") ?>" class="btn-registro">
            </form>
          </div>
            <div class="user-photo">
                <form  action="index.php?controller=users&amp;action=view" method="POST" class="formulario ">
                    <?= i18n("Nueva contraseña") ?>: <input type="password" name="pass" class="input-form" required="true">
                    <?= isset($errors["pass"])?$errors["pass"]:"" ?>
                    <input type="submit" name="submit" value="<?= i18n("Cambiar") ?>" class="btn-registro">
                </form>
            </div>
          <div class="user-data">
            <div >
                <label><?= $user->getName() ?></label>
            </div>
            <div class="user-alias">
                <h2><?= $user->getAlias() ?></h2>
            </div>
          </div>
        </div>

    </div>
  </div>
</article>
