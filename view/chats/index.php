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
    <?php foreach ($chats as $aux) {?>
      <div class = "objeto_chat select">
        <img src = "imgs/producto/<?= $aux->getProduct()->getPhoto() ?>" height="80" width="120" style="border-right: 1px solid grey">
        <div  id = "datos_chat">
          <strong> <?= $aux->getProduct()->getTitle() ?></strong>
          <div> <?= $aux->getOther($currentuser)->getAlias() ?> </div>
        </div>
      </div>
    <?php } ?>
  </div>
  <div class="ventana_chat">

    <div class="cabecera_chat">
      <div class = "producto_chat">
        <img src = "imgs/producto/<?= $chat->getProduct()->getPhoto()?>" height="80" width="120" style="border-right: 1px solid grey">
        <div  id = "datos_producto">
          <strong> <?=$chat->getProduct()->getTitle() ?></strong>
          <div id = "precio_producto"> <?= $chat->getProduct()->getPrize()?>€ </div>
        </div>
      </div>
      <div class = "vendedor_chat">
        <img src = "imgs/perfil/<?= $chat->getOther($currentuser)->getPhoto() ?>" height="40" width="40" style="border-radius: 100%; border: 1px solid black">
        <div class="vendedor_chat_texto">
          <div> <strong> <?= $chat->getOther($currentuser)->getAlias() ?> </strong></div>
          <div> 32 productos </div>
       </div>
     </div>
    </div>
    <div class="cuerpo_chat">
        <?php

        foreach ($chat->getMensajes() as $mensaje) {
            var_dump($mensaje->getAutor()->getAlias());
            var_dump($currentuser);
            if($mensaje->getAutor()->getAlias() == $currentuser){
                ?> <div class="comentario right"> <?= $mensaje->getMensaje() ?></div> <?php
            }else{
                ?> <div class="comentario left"> <?= $mensaje->getMensaje() ?></div> <?php
            }
        } ?>

    </div>
    <div class="caja_texto_chat">
        <div class = "input_chat">
            <input type="text" class = "texto_chat" placeholder="Escribir mensaje" >
        </div>
        <div>
            <a class= "btn_enviar_texto" href="#"><i class="fa fa-paper-plane" aria-hidden="false"></i></a>
      </div>
    </div>
  </div>
</div>
</article>
