<?php
//file: controller/ChatController.php

require_once(__DIR__."/../model/Mensaje.php");
require_once(__DIR__."/../model/MensajeMapper.php");
require_once(__DIR__."/../model/Chat.php");
require_once(__DIR__."/../model/ChatMapper.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

/**
 * Class ChatsController
 *
 * Controller to make a CRUDL of Chats entities
 *
 * @author lipido <lipido@gmail.com>
 */
class ChatsController extends BaseController {

  /**
   * Reference to the ChatMapper to interact
   * with the database
   *
   * @var ChatMapper
   */
  private $chatMapper;

  public function __construct() {
    parent::__construct();

    $this->chatMapper = new ChatMapper();
    $this->mensajeMapper = new MensajeMapper();
  }

  /**
   * Action to list chats
   *
   * Loads all the chats from the database.
   * No HTTP parameters are needed.
   *
   * The views are:
   * <ul>
   * <li>chats/index (via include)</li>
   * </ul>
   */
  public function index() {
        $currentuser = $this->view->getVariable("currentuser");
        // obtain the data from the database
        $chats = $this->chatMapper->findAll($currentuser);

        if($chats!=NULL){
          // puts the chat id to show by Default
          if(!isset($_GET["chat"])){
              $_GET["chat"] = reset($chats)->getId();
          }

          $chat = $this->chatMapper->findByIdWithMensajes($_GET["chat"]);
          if($chat->getVendedor()->getAlias() != $currentuser->getAlias() && $chat->getComprador()->getAlias() != $currentuser->getAlias()){
              $this->view->setFlash(sprintf(i18n("No Access")));
              $this->view->redirect("chats","index");
          }
          // puts the chat id to show
          $this->view->setVariable("chat",$chat);
          // put the array containing Chat object to the view
          $this->view->setVariable("chats", $chats);
        }
        // render the view (/view/chats/index.php)
        $this->view->render("chats", "index");

  }

  public function add() {


      $this->userMapper = new UserMapper();
      $this->productMapper = new ProductMapper();
      $currentuser = $this->view->getVariable("currentuser");

      $chat = new Chat(NULL,
        $this->productMapper->findById($_POST["product_id"]),
          $currentuser,
        $this->userMapper->findByAlias($_POST["vendedor_alias"])
      );
      $id =$this->chatMapper->checkIfExist($chat);
      if($id== "no_existe")
        $id = $this->chatMapper->save($chat);
      echo $id;
      $this->view->redirect("chats","index","chat=".$id);
  }

  public function addMessage(){
      $currentuser = $this->view->getVariable("currentuser");
      $chat = $this->chatMapper->findById($_POST["chat_id"]);
      if($chat->getVendedor()->getAlias() != $currentuser->getAlias() && $chat->getComprador()->getAlias() != $currentuser->getAlias()){
          $this->view->setFlash(sprintf(i18n("No Access")));
          $this->view->redirect("chats","index");
      }
      if($currentuser->getAlias() == $chat->getComprador()->getAlias())
          $autor = true;
      else
          $autor = false;

      if(isset($_POST["mensaje"]) && $_POST["mensaje"] !='' ){
          $mensaje = new Mensaje(
              $autor,
              $chat,
              $_POST["mensaje"]);
          $this->mensajeMapper->save($mensaje);
      }
      $this->view->redirect("chats","index","chat=".$_POST["chat_id"]);
  }
}
