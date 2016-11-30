<?php
 //file: view/users/register.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $errors = $view->getVariable("errors");
 $user = $view->getVariable("user");
 $view->setVariable("title", "Register");
?>
<article id = "maincontent">
  <div class = "main">
    <div class="login">
      <h1><?= i18n("Sing up!")?></h1>
      <form action="index.php?controller=users&amp;action=register" method="POST" class="formulario">
            <?= i18n("Name")?>: <input type="text" name="name"
      			value="<?= $user->getName() ?>" >
            <?= isset($errors["name"])?$errors["name"]:"" ?>

            <?= i18n("Alias")?>: <input type="text" name="alias"
      			value="<?= $user->getAlias() ?>">
            <?= isset($errors["alias"])?$errors["alias"]:"" ?>

            <?= i18n("Password")?>: <input type="password" name="passwd"
      			value="">
            <?= isset($errors["passwd"])?$errors["passwd"]:"" ?>

            <?= i18n("Photo") ?>: <input type="file" name="photo">
      	    <?= isset($errors["photo"])?$errors["photo"]:"" ?>

            <input type="submit" value="<?= i18n("Register")?>" class=btn-registro>

      </form>
      <p><?= i18n("Already have an acount?")?> <a href="index.php?controller=users&amp;action=login"><?= i18n("Login here!")?></a></p>
    </div>
  </div>
</article>
