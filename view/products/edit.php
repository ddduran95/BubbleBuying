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
            <form enctype = "multipart/form-data" action="index.php?controller=products&amp;action=edit" method="POST" class="formulario">
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />

                <?= i18n("Title") ?>: <?= isset($errors["title"])?$errors["title"]:"" ?>
                <input type="text" name="title" class="input-form" value="<?=$product->getTitle()?>">


                <?= i18n("Short Description") ?>: <?= isset($errors["description"])?$errors["description"]:"" ?>
                <textarea name="description" rows="2" cols="20" class="input-form"><?=$product->getDescription()?></textarea>


                <?= i18n("Prize") ?>: <?= isset($errors["prize"])?$errors["prize"]:"" ?>
                <input type="number" name="prize" class="input-form" value="<?=$product->getPrize()?>">


                <?= i18n("Category") ?>:
                <select name="category" class="add-select input-form">
                    <option value="Tecnologia" <?php echo(($product->getCategory() == "Tecnologia")? "selected" :"");?>><?=i18n("Tecnology")?></option>
                    <option value="Libros"<?php echo (($product->getCategory() == "Libros") ? "selected":"");; ?>><?=i18n("Books")?></option>
                    <option value="Cosas de casa"<?php echo (($product->getCategory() == "Cosas de casa") ? "selected":""); ?>><?=i18n("Home")?></option>
                    <option value="Videojuegos"<?php echo (($product->getCategory() == "Videojuegos") ? "selected":""); ?>><?=i18n("Videogames")?></option>
                    <option value="Niños"<?php echo (($product->getCategory() == "Niños") ? "selected":""); ?>><?=i18n("Children")?></option>
                    <option value="Electrodomesticos"<?php echo (($product->getCategory() == "Electrodomesticos") ? "selected":""); ?>><?=i18n("Home Appliances")?></option>
                    <option value="Ropa"<?php echo (($product->getCategory() == "Ropa") ? "selected":""); ?>><?=i18n("Clothing")?></option>
                    <option value="Motor"<?php echo (($product->getCategory() == "Motor") ? "selected":""); ?>><?=i18n("Motor")?></option>
                    <option value="Deporte"<?php echo (($product->getCategory() == "Deporte") ? "selected":""); ?>><?=i18n("Sport")?></option>
                </select>
                <?= i18n("Photo") ?>: <?= isset($errors["photo"])?$errors["photo"]:"" ?>
                <input type="file" name="photo" class="input-form">
                <input type="hidden" name="product_id" value="<?=$product->getId()?>">
                <input type="submit" name="submit" value="<?= i18n("Save Changes") ?>" class="btn-registro">
            </form>
        </div>
    </div>
</article>
