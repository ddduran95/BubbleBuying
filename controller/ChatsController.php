<?php
//file: controller/ChatController.php

require_once(__DIR__."/../model/Mensaje.php");
require_once(__DIR__."/../model/Chat.php");
require_once(__DIR__."/../model/ChatMapper.php");
require_once(__DIR__."/../model/User.php");

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

    // obtain the data from the database
    $chats = $this->chatMapper->findAll();
    //var_dump($chats);

    // puts the chat id to show by Default
    if(!isset($_GET["chat"])){
        $_GET["chat"] = reset($chats)->getId();
    }

    $chat = $this->chatMapper->findByIdWithMensajes($_GET["chat"]);

    // put the array containing Chat object to the view
    $this->view->setVariable("chats", $chats);

    // puts the chat id to show
    $this->view->setVariable("chat",$chat);

    // render the view (/view/chats/index.php)
    $this->view->render("chats", "index");


  }

}
