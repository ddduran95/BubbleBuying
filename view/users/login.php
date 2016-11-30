<?php
 //file: view/users/login.php

 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
 $view->setVariable("title", "Login");
 $errors = $view->getVariable("errors");
?>
<article id = "maincontent">
  <div class = "main">
    <div class="login">
        <h1><?= i18n("Login") ?></h1>
        <?= isset($errors["general"])?$errors["general"]:"" ?>

        <form action="index.php?controller=users&amp;action=login" method="POST" class="formulario">
        <?= i18n("Username")?>: <input type="text" name="username">
        <?= i18n("Password")?>: <input type="password" name="passwd">
        <input type="submit" value="<?= i18n("Login") ?>" class=btn-registro>
        </form>

        <p><?= i18n("Not user?")?> <a href="index.php?controller=users&amp;action=register"><?= i18n("Register here!")?></a></p>
        <?php $view->moveToFragment("css");?>
            <link rel="stylesheet" type="text/css" src="css/style2.css">
        <?php $view->moveToDefaultFragment(); ?>
    </div>
  </div>
</article>
