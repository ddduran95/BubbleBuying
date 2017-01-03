<?php
 //file: view/chats/index.php

 require_once(__DIR__."/../../core/ViewManager.php");

 $view = ViewManager::getInstance();

 $chats = $view->getVariable("chats");
 $chat = $view->getVariable("chat");

 $currentuser = $view->getVariable("currentusername");

 $view->setVariable("title", "Chats");
?>

<article id="maincontent">
  <div class ="chat">
    <div class ="lista">
    <?php
      if($chats==NULL):?>
        <div class="aviso">
          <h1> <?= i18n("You don't have open chats.") ?></h1>
        </div>
      <?php
      else:
        foreach ($chats as $aux):?>
        <a href  ="index.php?controller=chats&amp;action=index&amp;chat=<?= $aux->getId() ?>">
          <div class = "objeto_chat select">
            <img class="photo-product-chat" src = "imgs/producto/<?= $aux->getProduct()->getPhoto() ?>" >
              <div  id = "datos_chat">
                <strong> <?= $aux->getProduct()->getTitle() ?></strong>
              <div> <?= $aux->getOther($currentuser)->getAlias() ?> </div>
            </div>
          </div>
        </a>
      <?php
      endforeach;

      ?>
  </div>
  <div class="ventana_chat">

    <div class="cabecera_chat">
      <div class = "producto_chat">
        <img class="photo-product-chat" src = "imgs/producto/<?= $chat->getProduct()->getPhoto()?>">
        <div  id = "datos_producto">
          <strong> <?=$chat->getProduct()->getTitle() ?></strong>
          <div id = "precio_producto"> <?= $chat->getProduct()->getPrize()?>€ </div>
        </div>
      </div>
      <div class = "vendedor_chat">
        <img class="photo-seller-chat" src = "imgs/perfil/<?= $chat->getOther($currentuser)->getPhoto() ?>" >
        <div class="vendedor_chat_texto">
          <div> <strong> <?= $chat->getOther($currentuser)->getAlias() ?> </strong></div>
       </div>
     </div>
    </div>
    <div class="cuerpo_chat">
        <?php foreach ($chat->getMensajes() as $mensaje) {
            if($mensaje->getAutor()->getAlias() == $currentuser){
                ?> <div class="comentario right"> <?= $mensaje->getMensaje() ?></div> <?php
            }else{
                ?> <div class="comentario left"> <?= $mensaje->getMensaje() ?></div> <?php
            }
        } ?>

    </div>
    <form class="caja_texto_chat" id = "my_form" action = "index.php?controller=chats&amp;action=addMessage&amp;chat=<?= $aux->getId() ?>" method = "post">
        <div class = "input_chat">
            <input type="hidden" name= "chat_id" value="<?= $chat->getId()?>">
            <input type="text" name = "mensaje"class = "texto_chat" placeholder="Escribir mensaje" >
        </div>
        <div>
            <a class= "btn_enviar_texto" onclick="document.getElementById('my_form').submit();"><i class="fa fa-paper-plane" aria-hidden="false"></i></a>
      </div>
  </form>
  </div>
<?php endif;?>
</div>
</article>
